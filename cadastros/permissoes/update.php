<?php
session_start();
require_once '../../init.php';
require '../../check.php';
// pega o ID da URL
$idAcesso = isset($_POST['idAcesso']) ? $_POST['idAcesso'] : null;

if (isset($_POST['consultar'])) {
	$selVar = ":consultar";
	$selVar2 = "consultar";
	$selVal = $_POST['consultar'] == 'true' ? 1 : 0;
}
elseif (isset($_POST['incluir']) ) {
	$selVar = ":incluir";
	$selVar2 = "incluir";
	$selVal = $_POST['incluir'] == 'true' ? 1 : 0;
}
elseif (isset($_POST['editar'])) {
	$selVar = ":editar";
	$selVar2 = "editar";
	$selVal = $_POST['editar'] == 'true' ? 1 : 0;
}
elseif (isset($_POST['excluir'])) {
	$selVar = ":excluir";
	$selVar2 = "excluir";
	$selVal = $_POST['excluir'] == 'true' ? 1 : 0;
}
else
{
//echo "nothing set";
}

if (isset($_POST["idAcesso"])) {

	$PDO = db_connect();
	$sql = "UPDATE paginasAcessos SET $selVar2 = $selVar WHERE idAcesso = :idAcesso ";
	$stmt = $PDO->prepare($sql);
	$stmt->bindParam($selVar, $selVal);
	$stmt->bindParam(':idAcesso', $idAcesso, PDO::PARAM_INT);

	if (!$stmt->execute()) {
	    echo "Ocorreu um erro ao excluir.";
	    print_r($stmt->errorInfo());

	} 
}

?>