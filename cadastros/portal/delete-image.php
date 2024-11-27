<?php
require_once '../../init.php';
require '../../check.php';
require '../../classes/materiasCt.class.php';
    $mc = new MateriasCt();

if (isset($_GET['id']) && !empty($_GET['id'])) {
	$idMateriaContratada = $mc->excluirImagem($_GET['id']);
}

if(isset($idMateriaContratada)) {
	header("Location: form-edit.php?id=".$idMateriaContratada);
} else {
	header("Location: index.php");
}