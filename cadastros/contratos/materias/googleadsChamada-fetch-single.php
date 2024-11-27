<?php
session_start();
require_once '../../../init.php';
require '../../../check.php';
require '../../../classes/materiasCt.class.php';
$mc = new MateriasCt();

if(isset($_GET['id']) && !empty($_GET['id'])) {

    $materiasContratadas_googleAdsChamada = $mc->getMateriaContratadaGoogleAdsChamadas($_GET['id']);

    foreach($materiasContratadas_googleAdsChamada as $row)
	{
		$output["urlFinalChamada"] = $row["urlFinalChamada"];
		$output["urlVisualizacaoChamada"] = $row["urlVisualizacaoChamada"];
		$output["titulo1Chamada"] = $row["titulo1Chamada"];
		$output["titulo2Chamada"] = $row["titulo2Chamada"];		
		$output["descricao1Chamada"] = $row["descricao1Chamada"];
		$output["descricao2Chamada"] = $row["descricao2Chamada"];
		$output["nomeEmpresa"] = $row["nomeEmpresa"];
		$output["numeroTel"] = $row["numeroTel"];			
		
	}
    
    echo json_encode($output);
}

?>