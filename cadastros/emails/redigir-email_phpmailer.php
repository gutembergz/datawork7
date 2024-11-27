<?php

require '../../lib/PHPMailer/src/Exception.php';
require '../../lib/PHPMailer/src/PHPMailer.php';
require '../../lib/PHPMailer/src/SMTP.php';

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    if (array_key_exists('destinatario', $_POST)) {
    	$err = false;
	    $msg = '';

	    //Apply some basic validation and filtering to the subject
	    if (array_key_exists('assunto', $_POST)) {
	        $assunto = ($_POST['assunto']);
	    } else {
	        $assunto = 'Sem assunto digitado.';
	    }

	    if (array_key_exists('idContrato', $_POST)) {
            $idContrato = ($_POST['idContrato']);
        } else {
        	$idContrato = 0; // ao redigir email sem contrato
        }

       	if (array_key_exists('idTipoEmail', $_POST)) {
            $idTipoEmail = ($_POST['idTipoEmail']);
        } else {
        	$idTipoEmail = 'Sem idTipoEmail definido.'; // VERIFICAR ao redigir email sem contrato
        }

	    //Apply some basic validation and filtering to the query
	    if (array_key_exists('mensagem', $_POST)) {
	        $mensagemHtml = ($_POST['mensagem']);
	        $mensagemTxt = substr(strip_tags($_POST['mensagem']), 0, 16384); //Limit length and strip HTML tags
	    } else {
	        $mensagem = '';
	        $msg = 'Sem mensagem digitada.';
	        $err = true;
	    }

		if (array_key_exists('destinatario', $_POST)) {
			$destinatario = $_POST['destinatario'];
			
		} else {
			$destinatario = "";
			$msg = 'Sem destinatário digitado.';
	        $err = true;
		}		

		if(isset($_FILES['userfile']) && !$_FILES['userfile']['error'] == UPLOAD_ERR_NO_FILE ) { // aqui o erro é checado. porque FILES sempre gera um array?
		
			//Attach multiple files one by one
		    for ($ct = 0; $ct < count($_FILES['userfile']['tmp_name']); $ct++) {

		        $uploadfile = tempnam(sys_get_temp_dir(), hash('sha256', $_FILES['userfile']['name'][$ct]));
		        $filename = $_FILES['userfile']['name'][$ct];

		        if (move_uploaded_file($_FILES['userfile']['tmp_name'][$ct], $uploadfile)) {
		            $mail->addAttachment($uploadfile, $filename);
		            
		        } else {
		            $msg .= 'Falha ao mover arquivo para ' . $uploadfile . '<br>';
		        }
		    }
		
		} 


	    if (!$err) { // se não deu erro

			try {

				$template = file_get_contents('template_email.php'); // obtendo o template do email
			    $template = str_replace('%messagebody%', $mensagemHtml, $template);  // onde substituir a mensagem

		        // configurações do servidor
		        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
		        $mail->SetLanguage("pt_br", 'includes/PHPMailer/language/');

				$mail->isSMTP();                                            // Send using SMTP
		        $mail->Host       = MAILER_HOST;                            // Set the SMTP server to send through
		        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		        $mail->Username   = MAILER_USERNAME;                        // SMTP username
		        $mail->Password   = MAILER_PASSWORD;                        // SMTP password
		        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		        $mail->Port       = 587;                                    // TCP port to connect to

		        // destinatários
		        $mail->setFrom(MAILER_FROMMAIL, MAILER_FROMNAME);
		        $mail->addAddress($destinatario, ($_POST['autorizante']));  // Add a recipient
		        $mail->addReplyTo('editorial@portaldenegocios.com', 'Editorial');
		        
		        // conteúdo
		        $mail->isHTML(true); 			// Set email format to HTML
		        $mail->Subject = $assunto;
		        $mail->Body    = $template; 	// mensagem com template html
		        $mail->AltBody = $mensagemTxt; 	// sem html
		        $mail->CharSet = 'UTF-8'; 
				$mail->send();

				require '../../classes/emails.class.php';
				$e = new Emails();

				if (isset($_POST['idContrato']) && !empty($_POST['idContrato'])) {

			    	// aqui adicionamos o registro de email enviado
					$idContrato = $idContrato; 
					$idUser = $_SESSION['user_id'];
				    $idTipoEmail = $idTipoEmail; 
				    $dataEnvio = date("Y-m-d H:i:s");
				    $destinatario = $destinatario;
				    $e->addEmailEnviado($idContrato, $idUser, $idTipoEmail, $dataEnvio, $destinatario);

				    ?>
		            <div class="alert alert-success">
		                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
						A mensagem foi enviada com sucesso! Retornando ao contrato...
						<script type="text/javascript">
                    	setTimeout(function(){
                    	window.location.href ='../contratos/form-edit.php?id=<?php echo $idContrato;?>';
                    	}, 3000)
                    	</script>
					</div>
		        <?php 

				}

			} catch (Exception $e) { ?>
			        
	        	<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<?php echo "A mensagem não pode ser enviada. Erro do Mailer: {$mail->ErrorInfo}"; ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
	
			<?php 
		}
	}
} 

?>