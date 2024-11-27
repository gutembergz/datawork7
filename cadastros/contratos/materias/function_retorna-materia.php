<?php

// esta função captura as informações sobre as matérias selecionadas e efetua a contagem e data do último registro
// VAMOS OBTER DO _GET -- para teste do JSON:
//http://localhost/appName/cadastros/materias/function_retorna-materia.php?idContrato=1&idMateria=4 (4 por ser a matéria de peça de mídia)

session_start();
require_once '../../../init.php';
require '../../../check.php';
require '../../../classes/materiasCt.class.php';

function retornaMateriasCt($idContrato, $idMateria){

if (!isset($_GET['idContrato']) || !isset($_GET['idMateria'])) {
	$idContrato = 0;
	$idMateria = 0;

	} else {

		$idContrato = $_GET['idContrato'];
		$idMateria = $_GET['idMateria'];
 		$mc = new MateriasCt();

		$totalMateriaContratada = $mc->getTotalMateriasContratadas($idContrato, $idMateria);

		// as variáveis abaixo referem-se aos dados a serem convertidos para JSON
 		$txtFinal['resultado'] = $totalMateriaContratada['c'];
 		$txtFinal['ultimoRegistro'] = $totalMateriaContratada['ultimoRegistro'];

 		echo json_encode(utf8ize($txtFinal)); 		
 	}

}

//se tudo der certo, a função "retornaMateriasCt" executa com o id de contrato e materia
if(isset($_GET['idContrato']) && isset($_GET['idMateria'])){	
	retornaMateriasCt($_GET['idContrato'], $_GET['idMateria']);
}