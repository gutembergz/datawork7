<?php
require_once '../../init.php';
require '../../check.php';
require '../../classes/clientes.class.php';
$c = new Clientes();

if (isset($_GET['id']) && !empty($_GET['id'])) {
	$idCliente = $c->excluirImagem($_GET['id']);
}

if(isset($idCliente)) {
	header("Location: form-edit.php?id=".$idCliente);
} else {
	header("Location: index.php");
}