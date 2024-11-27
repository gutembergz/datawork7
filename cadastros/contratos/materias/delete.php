<?php
require_once '../../../init.php';
require '../../../check.php';
require '../../../classes/materiasCt.class.php';
$mc = new MateriasCt();

if (isset($_GET['id']) && !empty($_GET['id'])) {
	$mc->excluirMateriaContratada($_GET['id']);
}

header("Location: ../form-edit.php?id=".$_GET['idContrato']);
