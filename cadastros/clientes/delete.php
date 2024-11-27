<?php
require_once '../../init.php';
require '../../check.php';
require '../../classes/clientes.class.php';
$c = new Clientes();

if (isset($_GET['id']) && !empty($_GET['id'])) {
	$c->excluirCliente($_GET['id']);
}

header("Location: index.php");