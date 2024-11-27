<?php
require_once '../../init.php';
require '../../check.php';
require '../../classes/pacotes.class.php';
$pc = new Pacotes();

if (isset($_GET['id']) && !empty($_GET['id'])) {
	$pc->excluirPacote($_GET['id']);
}

header("Location: index.php");
