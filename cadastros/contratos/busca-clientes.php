<?php
//busca clientes no combobox

session_start();
require_once '../../init.php';
require '../../check.php';
require '../../classes/clientes.class.php';
header('Content-Type: application/json');

if (isset($_GET['term'])) {

	$request = $_GET['term'];
	$c = new Clientes();
	$clientes = $c->buscaClientes($request);
	
	echo json_encode($clientes);
} 