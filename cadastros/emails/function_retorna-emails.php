<?php

// esta função captura os textos dos e-mails previamente salvos e preenche o campo de mensagem.
// VAMOS OBTER DO _POST -- para teste do JSON:
//http://localhost/appName/cadastros/emails/function_retorna-emails.php?idContrato=1&idEmailTemplate=1

session_start();
require_once '../../init.php';
require '../../check.php';
require '../../classes/emailsTemplates.class.php';

function retornaEmails($id){ // idEmailTemplate
	
	if (!isset($_GET["idEmailTemplate"]) || !isset($_GET["idContrato"])) {
		$idContrato = 0;
		$idEmailTemplate = 0;

		} else {

		$idEmailTemplate = $_GET["idEmailTemplate"];
		$idContrato = $_GET["idContrato"];
		$et = new EmailsTemplates();

		$emailTemplate = $et->getEmailTemplate($idEmailTemplate);

		// obtemos os tipos de matérias e status
		$tiposMaterias = $emailTemplate['tiposMaterias'];
		$tiposStatus = $emailTemplate['tiposStatus'];
		
		// capturamos as matérias baseadas no template
		$emailsTemplatesMaterias = $et->getEmailsMaterias($tiposMaterias, $tiposStatus, $idContrato);
		
		// array vazio
		$matContratadas = ''; 

		// capturamos as matérias
		foreach ($emailsTemplatesMaterias as $emailTemplateMateria): 
			$matContratadas .= '<li>';
			$matContratadas .= '<strong>' . $emailTemplateMateria['materia'] .'</strong><br>'; 
			$matContratadas .= 'Publicação: ' . $emailTemplateMateria['publicacao'].'<br>';
			$matContratadas .= 'Período: <strong>' . dateConvert($emailTemplateMateria['dataLimite']) . ' a ' . dateConvert($emailTemplateMateria['dataExpiracao']) . '</strong><br>';
			$matContratadas .= '</li>';
			//$matContratadas .= 'Link: ' . $emailTemplateMateria['link'] . '<br></li>';
			//$matContratadas .= 'STATUS: ' . $emailTemplateMateria['idStatus'] . '<br></li>';
		endforeach;

		// as variáveis abaixo referem-se aos dados a serem convertidos para JSON
		$txtFinal['assunto'] = $emailTemplate['assunto'];
		$txtFinal['mensagem'] = '<p>' . $emailTemplate['texto'] . '</p>'; 
		$txtFinal['mensagem2'] = '<p>' . $emailTemplate['texto2'] . '</p>';

		if ($emailTemplate['incluiMaterias'] == true) { // se o template de email não incluir matérias...
			$txtFinal['materias'] = $matContratadas; // incluímos as matérias contratadas aqui
		} else {
			$txtFinal['materias'] = ''; // ou as matérias seguem vazias
		}

		return json_encode($txtFinal);
		echo $txtFinal;

	}
	
}

// se tudo der certo, a função "retornaEmails" executa com o id do email requerido.
if(isset($_GET['idEmailTemplate'])){
	echo retornaEmails($_GET['idEmailTemplate']);
}