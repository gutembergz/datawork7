<?php
session_start();
require_once '../../../init.php';
require '../../../check.php';
require '../../../classes/materiasCt.class.php';
$mc = new MateriasCt();

if (isset($_POST['urlFinal']) && !empty($_POST['urlVisualizacao'])) {

	if($_POST["operationAds"] == "Add")	{

	    $idMateriaContratada = addslashes($_POST['idMateriaContratadaAds']);
	    $urlFinal = addslashes($_POST['urlFinal']);
	    $urlVisualizacao = addslashes($_POST['urlVisualizacao']);	    
	    $titulo1 = addslashes($_POST['titulo1']);
	    $titulo2 = addslashes($_POST['titulo2']);
	    $titulo3 = addslashes($_POST['titulo3']);
	    $titulo4 = addslashes($_POST['titulo4']);
	    $titulo5 = addslashes($_POST['titulo5']);
	    $titulo6 = addslashes($_POST['titulo6']);
	    $titulo7 = addslashes($_POST['titulo7']);
	    $titulo8 = addslashes($_POST['titulo8']);
	    $titulo9 = addslashes($_POST['titulo9']);
	    $titulo10 = addslashes($_POST['titulo10']);
	    $titulo11 = addslashes($_POST['titulo11']);
	    $titulo12 = addslashes($_POST['titulo12']);
	    $titulo13 = addslashes($_POST['titulo13']);
	    $titulo14 = addslashes($_POST['titulo14']);
	    $titulo15 = addslashes($_POST['titulo15']);
	    $descricao1 = addslashes($_POST['descricao1']);
	    $descricao2 = addslashes($_POST['descricao2']);
	    $descricao3 = addslashes($_POST['descricao3']);
	    $descricao4 = addslashes($_POST['descricao4']);

	    $contaTitulos = addslashes($_POST['contaTitulos']);
	    $contaDescricoes = addslashes($_POST['contaDescricoes']);	    

		$mc->addMateriasContratadasGoogleAds($idMateriaContratada, $urlFinal, $urlVisualizacao, $titulo1, $titulo2, $titulo3, $titulo4, $titulo5, $titulo6, $titulo7, $titulo8, $titulo9, $titulo10, $titulo11, $titulo12, $titulo13, $titulo14, $titulo15, $descricao1, $descricao2, $descricao3, $descricao4, $contaTitulos, $contaDescricoes);
		
		}

	if($_POST["operationAds"] == "Edit") {

		$idMateriaContratada = addslashes($_POST['idMateriaContratadaAds']);
	    $urlFinal = addslashes($_POST['urlFinal']);
	    $urlVisualizacao = addslashes($_POST['urlVisualizacao']);
	    $titulo1 = addslashes($_POST['titulo1']);
	    $titulo2 = addslashes($_POST['titulo2']);
	    $titulo3 = addslashes($_POST['titulo3']);
	    $titulo4 = addslashes($_POST['titulo4']);
	    $titulo5 = addslashes($_POST['titulo5']);
	    $titulo6 = addslashes($_POST['titulo6']);
	    $titulo7 = addslashes($_POST['titulo7']);
	    $titulo8 = addslashes($_POST['titulo8']);
	    $titulo9 = addslashes($_POST['titulo9']);
	    $titulo10 = addslashes($_POST['titulo10']);
	    $titulo11 = addslashes($_POST['titulo11']);
	    $titulo12 = addslashes($_POST['titulo12']);
	    $titulo13 = addslashes($_POST['titulo13']);
	    $titulo14 = addslashes($_POST['titulo14']);
	    $titulo15 = addslashes($_POST['titulo15']);
	    $descricao1 = addslashes($_POST['descricao1']);
	    $descricao2 = addslashes($_POST['descricao2']);
	    $descricao3 = addslashes($_POST['descricao3']);
	    $descricao4 = addslashes($_POST['descricao4']);

	    $contaTitulos = addslashes($_POST['contaTitulos']);
	    $contaDescricoes = addslashes($_POST['contaDescricoes']);
	    
	    $id = addslashes($_POST['idAds']);

		$mc->editMateriasContratadasGoogleAds($idMateriaContratada, $urlFinal, $urlVisualizacao, $titulo1, $titulo2, $titulo3, $titulo4, $titulo5, $titulo6, $titulo7, $titulo8, $titulo9, $titulo10, $titulo11, $titulo12, $titulo13, $titulo14, $titulo15, $descricao1, $descricao2, $descricao3, $descricao4, $contaTitulos, $contaDescricoes, $id);
	}
}


?>
