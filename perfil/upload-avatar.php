<?php
session_start();
require_once '../init.php';
require '../check.php';

$arquivo = $_FILES['arquivo']; //arquivo único
$idUser = isset($_POST['idUser']) ? $_POST['idUser'] : null;
$filename = isset($_POST['filename']) ? $_POST['filename'] : null; // se o arquivo já existe e se já é salvo

if (isset($_POST['filename']) && empty($_POST['filename']) == false) { // se já tiver um arquivo, vamos excluir

	unlink('../images/users/'. $filename) or die("Falha ao <strong class='highlight'>excluir</strong> arquivo.");
	
}
//checando o envio único
if (isset($arquivo['tmp_name']) && empty($arquivo['tmp_name']) == false) {

	// pega extensão da imagem
	preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $arquivo["name"], $ext);

	// gera um nome de arquivo baseado no tempo e um número randômico, passando para MD5
	$filename = md5(time().rand(0,99)). "." . $ext[1];
	//$filename = $nContrato . "." . $ext[1];

	// move o arquivo temporário para a pasta configurada
	move_uploaded_file($arquivo['tmp_name'], '../images/users/'. $filename);
	
	// atualiza o banco
	$PDO = db_connect();
	$sql = "UPDATE usuarios SET filename = :filename WHERE idUser = :idUser";	
	$stmt = $PDO->prepare($sql);
	$stmt->bindParam(':filename', $filename);
	$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);

	$_SESSION['user_avatar'] = $filename; // atualiza a constante de imagem a ser exibida no perfil
 
	if ($stmt->execute())
	{
	    
	    header('Location: index.php'); // aqui voltamos para a página original do contrato. como voltar para a aba?

	}
	else
	{
	    echo "Ocorreu um erro ao alterar.";
	    print_r($stmt->errorInfo());
	}

}

?>

