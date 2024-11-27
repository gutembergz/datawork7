<?php
session_start();
require_once '../../init.php';
require '../../check.php';
require '../../classes/contratos.class.php';
$ct = new Contratos();
$pageTitle = 'Redigir E-mail';

// aqui recebemos o id do contrato através do POST - para adição do novo email.
// os 3 GETS precisam estar ativos, senão não abrem os dados preenchidos.

if (isset($_GET["idContrato"]) && isset($_GET["nContrato"]) && isset($_GET["empresa"]) ) {
	    
	$idContrato = $_GET["idContrato"];
    $nContrato = $_GET["nContrato"];
    $empresa = $_GET["empresa"];
    $contrato = $ct->getContrato($idContrato);

    $parentPage = 'Contrato '. $nContrato . ' - ' . $empresa; // breadcrumb
    $parentLink = '../contratos/form-edit.php?id=' . $idContrato; // breadcrumb
	    
	} else {
		$idContrato = 0;
		$nContrato = 0;
		$contrato = null;
	}

include (HEADER_TEMPLATE); 
?>

<script type="text/javascript"> // ativador do tinyMCE
	tinymce.init({
		selector: '#mensagem',
		language: 'pt_BR',
		branding: false // remove o rodapé do tinyMCE
	});

</script>

<div class="container-fluid">

	<?php require 'redigir-email_phpmailer.php'; ?>

	<?php if (empty($msg)) : ?>
		<form enctype="multipart/form-data" method="POST" autocomplete="off">
			
			<?php if ($idContrato==0):?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<i class='fa fa-question-circle'></i> Não há e-mails previamente preenchidos nesta opção. Para enviar e-mail para clientes, acesse <a href='../contratos/'><strong>contratos</strong></a> e selecione o cliente desejado.
			        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			        <span aria-hidden="true">&times;</span>
			        </button>
			    </div>

			<?php else: ?>

				<div class="form-group">
					<label for="selEmail">Tipo de E-mail</label>
					<select class="form-control" name="selEmail" id="selEmail" required>
						<option value="10">Selecione um Tipo de E-mail</option>
							<?php 
	                        require '../../classes/emailsTemplates.class.php';
	                        $et = new EmailsTemplates();
	                        $emailsTemplates = $et->getEmailsTemplates();

	                        foreach($emailsTemplates as $emailTemplate) {
								$grupos[$emailTemplate['tipoEmail']][$emailTemplate['id']]  = $emailTemplate['assunto'];
							}

							foreach($grupos as $rotulo => $opcao): ?>
								<optgroup label="<?php echo $rotulo; ?>">
									<?php foreach ($opcao as $id => $nome) : ?>
										<option value="<?php echo $id; ?>"><?php echo $nome; ?></option>
									<?php endforeach;?>
								</optgroup> 
	                        <?php endforeach;?>
					</select>	
				</div>

			<?php endif; ?>

            <div class="form-row">
                <div class="form-group col-md-6"> 
                    <label for="assunto">Assunto</label>
                    <input class="form-control" type="text" name="assunto" id="assunto" required>
                </div>

                <div class="form-group col-md-6"> 
                    <label for="destinatario">Destinatário(s)</label>
                    <input class="form-control" type="email" name="destinatario" id="destinatario" value="<?php echo $contrato['email']; ?>" required>
                </div>
            </div>

            <div class="custom-file"> 
				<?php if (empty($msg)) : ?>				    
					<input type="hidden" name="MAX_FILE_SIZE" value="1000000"> <!-- tamanho limite do arquivo a ser enviado -->
					<input class="form-control-file" name="userfile[]" type="file" accept=".jpg, .jpeg, .pdf" multiple="multiple">
					<small id="filesize" class="form-text text-muted">Tamanho máximo permitido de arquivo: 1 MB</small>
								    
				<?php else: ?>
				<?php echo $msg; ?>
				<?php endif ?>
			</div>
			
			<div class="d-flex justify-content-center">
				<div class="spinner-border text-primary" style="position:absolute;top:630px;z-index:1000;display:none;" role="status">  
		  			<span class="sr-only">Loading...</span>
				</div>
			</div>
			<div class="form-group">	
				<label for="mensagem">Mensagem</label>
				<textarea class="form-control" rows="15" cols="50" name="mensagem" id="mensagem" placeholder="Redija sua mensagem..."></textarea>
			</div>

			<div class="form-group">
				<button class="btn float bg-primary text-white" data-toggle="tooltip" data-placement="top" title="Enviar E-mail" type="submit" value="Submit"><i class="fa fa-paper-plane"></i></button>
				<input class="form-control" type="hidden" name="empresa" id="empresa" value="<?php echo $contrato['empresa'];?>" readonly>
				<input class="form-control" type="hidden" name="autorizante" id="autorizante" value="<?php  echo $contrato['autorizante'];?>" readonly>
				<input class="form-control" type="hidden" name="nContrato" id="nContrato" value="<?php echo $contrato['nContrato'];?>" readonly>
				<input class="form-control" type="hidden" name="idCampanha" id="idCampanha" value="<?php echo $contrato['idCampanha'];?>" readonly>
				<input class="form-control" type="hidden" name="idContrato" id="idContrato" value="<?php echo $idContrato; ?>" readonly>
				<input class="form-control" type="hidden" name="idTipoEmail" id="idTipoEmail" value="0" readonly>			
			</div>
		<form>
		<?php else: ?>
	    <?php echo $msg; ?>
	    <?php endif ?>		  
</div>

<?php include (FOOTER_TEMPLATE);?>

<script> // função JS para capturar textos dos emails
$(document).ready(function(){
	$("select[name='selEmail']").change(function(){

		var autorizante = $("#autorizante").get(0);
		var empresa = $("#empresa").get(0);
		var nContrato = $("#nContrato").get(0);
		var idCampanha = $("#idCampanha").get(0);
		var idContrato = $("#idContrato").get(0);
		var idEmailTemplate = $(this).val();

		var $assunto = $("input[name='assunto']");
		var $idTipoEmail = $("input[name='idTipoEmail']");

		var infosHeader = 
		"<p><strong>Empresa: "+ empresa.value +"</strong><br>" + 
		"<strong>Contrato "+ nContrato.value +" | Campanha "+ idCampanha.value +"</strong></p>" + 
		"<p>Prezado(a) Sr(a) "+ autorizante.value +"</p>"; 

		console.log(idEmailTemplate);

		$(".spinner-border").show();

		$.getJSON('function_retorna-emails.php', {

			idEmailTemplate: $(this).val(),  idContrato: idContrato.value
			// estas são as variáveis que fazem o filtro no arquivo function_retorna-emails.php?idEmailTemplate=1&idContrato=1
		}, function (json){
			// carregando JSON...
			$assunto.val(json.assunto + " - " +nContrato.value); // preenche o campo assunto
			$idTipoEmail.val(idEmailTemplate); // capturando do campo idEmailTemplate
			//$materias.val(json.materias); // capturando do json

			// função para preencher no tinyMCE
			tinymce.get('mensagem').setContent(infosHeader + json.mensagem + json.materias + json.mensagem2); 
			$(".spinner-border").hide();
		});
		
	});
});
</script>