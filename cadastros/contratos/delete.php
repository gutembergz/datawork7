<?php
require_once '../../init.php';
require '../../check.php';
require '../../classes/contratos.class.php';
$ct = new Contratos();

if (isset($_GET['id']) && !empty($_GET['id'])) {
	$ct->excluirContrato($_GET['id']);
}

header("Location: index.php");