<?php
session_start();
require_once '../init.php';
require '../check.php';

if (isset($_POST['filename'])) {
   $filename = $_POST['filename'];
      if (!unlink('../images/users/'.$filename))
         {
         echo ("Erro ao excluir $filename");
      }
   else
   {
   header('Location: index.php'); 
   }
}

$idUser = isset($_POST['idUser']) ? $_POST['idUser'] : null; 
$filename = null; // excluímos o nome do arquivo
$dataAlteracao = date("Y-m-d H:i:s"); // equivale à função now() em SQL
//$idUser = $_SESSION['user_id']; 

// atualiza o banco
$PDO = db_connect();
 
$sql = "UPDATE usuarios SET filename = :filename, dataAlteracao = :dataAlteracao 
    WHERE idUser = :idUser";

$stmt = $PDO->prepare($sql);

$stmt->bindParam(':filename', $filename);
$stmt->bindParam(':dataAlteracao', $dataAlteracao);
$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);

$_SESSION['user_avatar'] = $filename; // atualiza a constante de imagem a ser exibida no perfil
 
if ($stmt->execute())
{    
    header('Location: index.php');
}
else
{
    echo "Ocorreu um erro ao alterar.";
    print_r($stmt->errorInfo());
}