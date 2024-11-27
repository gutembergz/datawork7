<?php
session_start();
require_once '../../../init.php';
require '../../../check.php';
require '../../../classes/materiasCt.class.php';
$mc = new MateriasCt();

if (isset($_POST['titulo']) && !empty($_POST['titulo'])) {

	if($_POST["operation"] == "Add")	{

	    $idMateriaContratada = addslashes($_POST['idMateriaContratada']);
	    $titulo = addslashes($_POST['titulo']);
	    $dataPublicacao = addslashes($_POST['dataPublicacao']);
	    $idStatus = addslashes($_POST['idStatusPosts']);	    
	    $urlFacebook = addslashes($_POST['urlFacebook']);
	    $urlInstagram = addslashes($_POST['urlInstagram']);
	    $urlLinkedin = addslashes($_POST['urlLinkedin']);
	    $urlTwitter = addslashes($_POST['urlTwitter']);
	    $urlFacebook_bitly = addslashes($_POST['urlFacebook_bitly']);
	    $urlInstagram_bitly = addslashes($_POST['urlInstagram_bitly']);
	    $urlLinkedin_bitly = addslashes($_POST['urlLinkedin_bitly']);
	    $urlTwitter_bitly = addslashes($_POST['urlTwitter_bitly']);

		$mc->addMateriasContratadasPostagens($idMateriaContratada, $titulo, $dataPublicacao, $idStatus, $urlFacebook, $urlInstagram, $urlLinkedin, $urlTwitter, $urlFacebook_bitly, $urlInstagram_bitly, $urlLinkedin_bitly, $urlTwitter_bitly);
		
		}

	if($_POST["operation"] == "Edit") {

		$idMateriaContratada = addslashes($_POST['idMateriaContratada']);
	    $titulo = addslashes($_POST['titulo']);
	    $dataPublicacao = addslashes($_POST['dataPublicacao']);
	    $idStatus = addslashes($_POST['idStatusPosts']);	
	    $urlFacebook = addslashes($_POST['urlFacebook']);
	    $urlInstagram = addslashes($_POST['urlInstagram']);
	    $urlLinkedin = addslashes($_POST['urlLinkedin']);
	    $urlTwitter = addslashes($_POST['urlTwitter']);
	    $urlFacebook_bitly = addslashes($_POST['urlFacebook_bitly']);
	    $urlInstagram_bitly = addslashes($_POST['urlInstagram_bitly']);
	    $urlLinkedin_bitly = addslashes($_POST['urlLinkedin_bitly']);
	    $urlTwitter_bitly = addslashes($_POST['urlTwitter_bitly']);
	    $id = addslashes($_POST['id']);

		$mc->editMateriasContratadasPostagens($idMateriaContratada, $titulo, $dataPublicacao, $idStatus, $urlFacebook, $urlInstagram, $urlLinkedin, $urlTwitter, $urlFacebook_bitly, $urlInstagram_bitly, $urlLinkedin_bitly, $urlTwitter_bitly, $id);
	}
}

?>