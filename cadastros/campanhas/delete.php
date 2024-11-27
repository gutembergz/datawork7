<?php
require_once '../../init.php';
require '../../check.php';
require '../../classes/campanhas.class.php';
$c = new Campanhas();

if (isset($_GET['id']) && !empty($_GET['id'])) {
	$c->excluirCampanha($_GET['id']);
}

header("Location: index.php");
