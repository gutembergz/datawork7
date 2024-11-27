<?php
session_start();
require_once '../../../init.php';
require '../../../check.php';
require '../../../classes/materiasCt.class.php';
$mc = new MateriasCt();

if(isset($_GET['id']) && !empty($_GET['id'])) {

    $materiasContratadas_postagens = $mc->getMateriaContratadaPostagens($_GET['id']);

    foreach($materiasContratadas_postagens as $row)
	{
		$output["titulo"] = $row["titulo"];
		$output["dataPublicacao"] = $row["dataPublicacao"];
		$output["idStatus"] = $row["idStatus"];
		$output["urlFacebook"] = $row["urlFacebook"];
		$output["urlInstagram"] = $row["urlInstagram"];
		$output["urlLinkedin"] = $row["urlLinkedin"];
		$output["urlTwitter"] = $row["urlTwitter"];
		$output["urlFacebook_bitly"] = $row["urlFacebook_bitly"];
		$output["urlInstagram_bitly"] = $row["urlInstagram_bitly"];
		$output["urlLinkedin_bitly"] = $row["urlLinkedin_bitly"];
		$output["urlTwitter_bitly"] = $row["urlTwitter_bitly"];
	}
    
    echo json_encode($output);
}

?>