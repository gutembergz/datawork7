<?php
require_once '../../../init.php';
require '../../../check.php';

if (isset($_POST["selCliente"])) {
		$idCliente = $_POST["selCliente"];
	} else {
		$idCliente = "1";
	}


// abre a conexão
$PDO = db_connect();
 
// SQL para selecionar os registros
$sql = "SELECT idCliente, empresa, email, autorizante, anunciante FROM clientes WHERE idCliente = $idCliente ORDER BY empresa ASC";
 
// seleciona os registros
$stmt = $PDO->prepare($sql);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

$empresa = $user['empresa'];
$autorizante = $user['autorizante'];

	if (isset($_POST["tipoEmail"])) {
		$tipoemail = $_POST["tipoEmail"];
	} else {
		$tipoemail = "contato";
	}

	if (isset($_POST["texto"])) {
		$texto = $_POST["texto"];
	} else {
		$texto = "Não Especificado";
	}

	if (isset($_POST["dataagenda"])) {
		$dataagenda = $_POST["dataagenda"];
	} else {
		$dataagenda = "Não Especificado";
	}

	if (isset($_POST["horario"])) {
		$horario = $_POST["horario"];
	} else {
		$horario = "Não Especificado";
	}

	if (isset($_POST["representante"])) {
		$representante = $_POST["representante"];
	} else {
		$representante = "Não Especificado";
	}

	if (isset($_POST["local"])) {
		$local = $_POST["local"];
	} else {
		$local = "Não Especificado";
	}

	if (isset($_POST["mensagem"])) {
		$mensagem = $_POST["mensagem"];
	} else {
		$mensagem = "Não Especificado";
	}

	$assinatura_espaco1 = "<table width='585px' border='0'>

                            <tr>
                                <td height='5'></td>
                            </tr>

                            <tr>
                                <td width='195'>
                                    <a href='https://portaldenegocios.com' target='_blank'><img src='https://portaldenegocios.com/images/hotlink-ok/2019/emails_assinaturas/logo_portal_178x61.png' alt='Portal de Negócios' style='border: 0;'' /></a>
                                </td>

                                <td width='390'>
                                    <span style='font-family: Roboto, Arial, Sans-serif; font-size: 15px; color: #666666;'>";
                                    	
   	$assinatura_espaco2 = "</span>
                                </td>

                            </tr>
	                        </table>";


	$assinaturaComercial = "<strong>Setor Comercial</strong><br/>
			                Portal de Negócios | EDKE Marketing Digital<br/>
			                (21) 3439-5647<br/>
			                comercial@portaldenegocios.com";

   	$assinaturaFinanceiro = "<strong>Setor Financeiro</strong><br/>
    						Portal de Negócios | EDKE Marketing Digital<br/>
						    (21) 3439-5647<br/>
						    cobranca@portaldenegocios.com";

	$assinaturaMarketing = "<strong>Setor de Marketing</strong><br/>
							Portal de Negócios | EDKE Marketing Digital<br/>
							(21) 3439-5647<br/>
							marketing@portaldenegocios.com";

		$assinaturaEdila = "<strong>Edila Arantes</strong><br/>
							Setor de Cobrança | Portal de Negócios<br/>
							(21) 3439-5647<br/>
							edila@portaldenegocios.com";

		  $assinaturaMia = "<strong>Mia Carolina</strong><br/>
							Setor Comercial | Portal de Negócios<br/>
							(21) 97980-1342<br/>
							miacarolina@portaldenegocios.com";

	
	$filepath = "https://portaldenegocios.com/images/hotlink-ok/2019/";

	$anoAtual = date("Y");

	$dadosContrato = "<strong>Contrato 00000 | Campanha " .$anoAtual. "</strong></p>";


	switch ($tipoemail) {

		case 'proposta-redes-sociais':
				$titlemail = "A Importância das Redes Sociais para a sua Empresa";
				$filename = $filepath . "emails_headers/banner_emails_redes_sociais.jpg";
				$bodymail = "body/body_proposta-comercial-redes-sociais.php";
				$assinatura = $assinatura_espaco1.$assinaturaMia.$assinatura_espaco2;
				
				$dadosContrato = "";	
		break;

		case 'redes-sociais':
				$titlemail = "A Importância das Redes Sociais para a sua Empresa";
				$filename = $filepath . "emails_headers/banner_emails_redes_sociais.jpg";
				$bodymail = "body/body_redes-sociais.php";
				$assinatura = $assinatura_espaco1.$assinaturaMia.$assinatura_espaco2;
				
				$dadosContrato = "";	
		break;

		case 'coronavirus':
				$titlemail = "Campanha Coronavírus";
				$filename = $filepath . "emails_headers/banner_emails_coronavirus.jpg";
				$bodymail = "body/body_coronavirus.php";
				$assinatura = $assinatura_espaco1.$assinaturaComercial.$assinatura_espaco2;
				
				$dadosContrato = "";	
		break;

		case 'proposta':
				$titlemail = "Proposta Comercial";
				$filename = $filepath . "emails_headers/banners_emails_portal-170.jpg";
				$bodymail = "body/body_proposta-comercial.php";
				$assinatura = $assinatura_espaco1.$assinaturaMia.$assinatura_espaco2;
				
				$dadosContrato = "";	
		break;

		case 'proposta2':
				$titlemail = "Proposta Comercial";
				$filename = $filepath . "emails_headers/banners_emails_portal-170.jpg";
				$bodymail = "body/body_proposta-comercial_bkp.php";
				$assinatura = $assinatura_espaco1.$assinaturaComercial.$assinatura_espaco2;
				
				$dadosContrato = "";	
		break;

		case 'classificados':
				$titlemail = "Bem Vindo aos Classificados";
				$filename = $filepath . "emails_headers/banners_emails_portal-04.jpg";
				$bodymail = "body/body_bem-vindo_classificados.php";
				$assinatura = $assinatura_espaco1.$assinaturaMarketing.$assinatura_espaco2;

		break;

		case 'rede':
				$titlemail = "Bem Vindo à Rede de Negócios";
				$filename = $filepath . "emails_headers/banners_emails_portal-05.jpg";
				$bodymail = "body/body_bem-vindo_rede.php";
				$assinatura = $assinatura_espaco1.$assinaturaMarketing.$assinatura_espaco2;
		break;

		case 'visita':
				$titlemail = "Confirmação de Visita";
				$filename = $filepath . "emails_headers/banners_emails_portal-00.jpg";
				$bodymail = "body/body_confirmacao_visita.php";
				$assinatura = $assinatura_espaco1.$assinaturaComercial.$assinatura_espaco2;
				$dadosContrato = "";
		break;

		case 'registro':
				$titlemail = "Registre-se no Portal de Negócios";
				$filename = $filepath . "emails_headers/banners_emails_portal-03.jpg";
				$bodymail = "body/body_registre_portal.php";
				$assinatura = $assinatura_espaco1.$assinaturaMarketing.$assinatura_espaco2;
		break;

		case 'grupo-vip':
				$titlemail = "Faça Parte do Grupo VIP do Portal de Negócios";
				$filename = $filepath . "emails_headers/banners_emails_portal-17-grupo-vip.jpg";
				$bodymail = "body/body_grupo-vip.php";
				//$assinatura = $assinaturaMarketing;
				$assinatura = "";
		break;

		case 'aumente-possibilidades':
				$titlemail = "Aumente Suas Possibilidades de Venda";
				$filename = $filepath . "emails_headers/banners_emails_portal-16-aumente-possibilidades.jpg";
				$bodymail = "body/body_aumente-possibilidades-venda.php";
				$assinatura = "";
		break;

		case 'apresentacao':
				$titlemail = "Apresentação do Portal de Negócios";
				$filename = $filepath . "emails_headers/banners_emails_portal-00.jpg";
				$bodymail = "body/body_apresentacao_portal.php";
				$assinatura = $assinatura_espaco1.$assinaturaComercial.$assinatura_espaco2;
				$dadosContrato = "";	
		break;

		default: 
				$titlemail = "E-mail de Contato";
				$filename = $filepath . "emails_headers/banners_emails_portal-00.jpg";
				$bodymail = "body/body_contato.php";
				$assinatura = $assinatura_espaco1.$assinaturaFinanceiro.$assinatura_espaco2;
			
		break;
	}	



?>