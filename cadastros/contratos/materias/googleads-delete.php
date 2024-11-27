<?php
session_start();
require_once '../../../init.php';
require '../../../check.php';
require '../../../classes/materiasCt.class.php';
$mc = new MateriasCt();

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $mc->excluirMateriaContratadasGoogleAds($_GET['id']);    
}

?>