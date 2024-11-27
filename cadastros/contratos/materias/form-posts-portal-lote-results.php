<?php
session_start();
require_once '../../../init.php';
require '../../../check.php';
require '../../../classes/materiasCt.class.php';
$pageTitle = 'Adicionar Postagens em Lote (Portal)';

$mc = new MateriasCt(); 

$idMateriaContratada = isset($_POST['idMateriaContratada']) ? $_POST['idMateriaContratada'] : null;
$idContrato = isset($_POST['idContrato']) ? $_POST['idContrato'] : null;
$idStatus = 1; // aguardando
$urlFacebook = '';
$urlInstagram = '';
$urlLinkedin = '';
$urlTwitter = '';
$urlFacebook_bitly = '';
$urlInstagram_bitly = '';
$urlLinkedin_bitly = '';
$urlTwitter_bitly = '';

$dias = $_POST['diasSelecionados'];
$datas = explode('||', $dias);

// excluindo o último item do array
$removed = array_pop($datas);

// conta o comprimento do array
$arrlength = count($datas);

for($x = 0; $x < $arrlength; $x++) {	
	$dataPublicacao = $datas[$x]; // é o item do array com a data a adicionar na função
	$titulo = 'POST ' . ((int)$x + 1) . '/' . $arrlength; // adicionamos um título de post com o contador e o total
  	$mc->addMateriasContratadasPostagens($idMateriaContratada, $titulo, $dataPublicacao, $idStatus, $urlFacebook, $urlInstagram, $urlLinkedin, $urlTwitter, $urlFacebook_bitly, $urlInstagram_bitly, $urlLinkedin_bitly, $urlTwitter_bitly);
}

// voltamos para a página de edição do contrato
include (HEADER_TEMPLATE); ?>

<div class="container-fluid">
	<div class="alert alert-success">
	    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
	   Posts adicionados com sucesso! Redirecionando para a matéria...
	    <script type="text/javascript">
	        setTimeout(function(){
	        window.location.href ='form-edit.php?id='+<?php echo $idMateriaContratada; ?>;
	        //redireciona para a o novo registro, gera o breadcrumb através do POST                  
	        }, 3000);
	    </script>
	</div>
</div>