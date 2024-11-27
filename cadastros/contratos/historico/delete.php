<?php
require_once '../../../init.php';
require '../../../check.php';
require '../../../classes/historicos.class.php';
$h = new Historicos();

if (isset($_GET['id']) && !empty($_GET['id'])) {
	$h->excluirHistorico($_GET['id']);
}

header("Location: ../form-edit.php?id=".$_GET['idContrato']);
