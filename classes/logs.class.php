<?php 
Class Logs {

	public function registrarLog($acao) {
		global $pdo;

		$sql = $pdo->prepare("INSERT INTO logs SET ip = :ip, idUser = :idUser, dataRegistro = :dataRegistro, acao = :acao");

		$ip = $_SERVER['REMOTE_ADDR'];
		$idUser = $_SESSION['user_id'];
		$dataRegistro = date("Y-m-d H:i:s"); 

		$sql->bindValue(':ip', $ip);
		$sql->bindValue(':idUser', $idUser);
		$sql->bindValue(':dataRegistro', $dataRegistro);
		$sql->bindValue(':acao', $acao);		
		$sql->execute();		
	}
}

?>