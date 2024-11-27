<?php
session_start();
require_once '../../../init.php';
require '../../../check.php';
require '../../../classes/materiasCt.class.php';
$mc = new MateriasCt();

if(isset($_GET['id']) && !empty($_GET['id'])) {

    $materiasContratadas_googleAds = $mc->getMateriaContratadaGoogleAds($_GET['id']);

    foreach($materiasContratadas_googleAds as $row)
	{
		$output["urlFinal"] = $row["urlFinal"];
		$output["urlVisualizacao"] = $row["urlVisualizacao"];
		$output["titulo1"] = $row["titulo1"];
		$output["titulo2"] = $row["titulo2"];
		$output["titulo3"] = $row["titulo3"];
		$output["titulo4"] = $row["titulo4"];
		$output["titulo5"] = $row["titulo5"];
		$output["titulo6"] = $row["titulo6"];
		$output["titulo7"] = $row["titulo7"];
		$output["titulo8"] = $row["titulo8"];
		$output["titulo9"] = $row["titulo9"];
		$output["titulo10"] = $row["titulo10"];
		$output["titulo11"] = $row["titulo11"];
		$output["titulo12"] = $row["titulo12"];
		$output["titulo13"] = $row["titulo13"];
		$output["titulo14"] = $row["titulo14"];
		$output["titulo15"] = $row["titulo15"];
		$output["descricao1"] = $row["descricao1"];
		$output["descricao2"] = $row["descricao2"];
		$output["descricao3"] = $row["descricao3"];
		$output["descricao4"] = $row["descricao4"];		
	}
    
    echo json_encode($output);
}

?>