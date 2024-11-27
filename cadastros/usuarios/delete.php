<?php
require_once '../../init.php';
require '../../check.php';
require '../../classes/usuarios.class.php';
$u = new Usuarios();

if (isset($_GET['id']) && !empty($_GET['id'])) {
	$u->excluirUsuario($_GET['id']);
}

header("Location: index.php");