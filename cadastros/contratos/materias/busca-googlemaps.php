<?php
//busca clientes no combobox

session_start();
require_once '../../../init.php';
require '../../../check.php';
require '../../../classes/materiasCt.class.php';
header('Content-Type: application/json');

if (isset($_GET['id'])) {

	$id = $_GET['id'];
	$mt = new MateriasCt();
	$materias = $mt->getMateriaContratadaMaps($id);
	
	echo json_encode($materias);
} 