<?php
session_start();
require_once '../../../init.php';
require '../../../check.php';
require '../../../classes/materiasCt.class.php';
$mc = new MateriasCt();

if (isset($_POST['urlFinalChamada']) && !empty($_POST['urlVisualizacaoChamada'])) {

	if($_POST["operationAdsChamada"] == "Add")	{

	    $idMateriaContratada = addslashes($_POST['idMateriaContratadaAdsChamada']);
	    $urlFinalChamada = addslashes($_POST['urlFinalChamada']);
	    $urlVisualizacaoChamada = addslashes($_POST['urlVisualizacaoChamada']);	    
	    $titulo1Chamada = addslashes($_POST['titulo1Chamada']);
	    $titulo2Chamada = addslashes($_POST['titulo2Chamada']);
	    $descricao1Chamada = addslashes($_POST['descricao1Chamada']);
	    $descricao2Chamada = addslashes($_POST['descricao2Chamada']);
	    $contaTitulosChamada = addslashes($_POST['contaTitulosChamada']);
	    $contaDescricoesChamada = addslashes($_POST['contaDescricoesChamada']);
	    $nomeEmpresa = addslashes($_POST['nomeEmpresa']);
	    $numeroTel = addslashes($_POST['numeroTel']);   

		$mc->addMateriasContratadasGoogleAdsChamadas($idMateriaContratada, $urlFinalChamada, $urlVisualizacaoChamada, $titulo1Chamada, $titulo2Chamada, $descricao1Chamada, $descricao2Chamada, $contaTitulosChamada, $contaDescricoesChamada, $nomeEmpresa, $numeroTel);
		
		}

	if($_POST["operationAdsChamada"] == "Edit") {

		$idMateriaContratada = addslashes($_POST['idMateriaContratadaAdsChamada']);
	    $urlFinalChamada = addslashes($_POST['urlFinalChamada']);
	    $urlVisualizacaoChamada = addslashes($_POST['urlVisualizacaoChamada']);
	    $titulo1Chamada = addslashes($_POST['titulo1Chamada']);
	    $titulo2Chamada = addslashes($_POST['titulo2Chamada']);
	    $descricao1Chamada = addslashes($_POST['descricao1Chamada']);
	    $descricao2Chamada = addslashes($_POST['descricao2Chamada']);
	    $contaTitulosChamada = addslashes($_POST['contaTitulosChamada']);
	    $contaDescricoesChamada = addslashes($_POST['contaDescricoesChamada']);
	    $nomeEmpresa = addslashes($_POST['nomeEmpresa']);
	    $numeroTel = addslashes($_POST['numeroTel']);   
	    $id = addslashes($_POST['idAdsChamada']);

		$mc->editMateriasContratadasGoogleAdsChamadas($idMateriaContratada, $urlFinalChamada, $urlVisualizacaoChamada, $titulo1Chamada, $titulo2Chamada, $descricao1Chamada, $descricao2Chamada, $contaTitulosChamada, $contaDescricoesChamada, $nomeEmpresa, $numeroTel, $id);
	}
}


?>
