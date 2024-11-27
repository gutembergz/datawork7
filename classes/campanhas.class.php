<?php 
class Campanhas {

	public function getCampanhas() {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT * FROM campanhas ORDER BY anoCampanha DESC");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getCampanha($id) {
		$array = array();
		global $pdo;

		$sql = $pdo->prepare("SELECT *, 
			(SELECT usuarios.name FROM usuarios WHERE usuarios.id = campanhas.idUser) AS nomeUsuario
		 	FROM campanhas WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();	
		}
		
		return $array;
	}

	public function addCampanha($campanha, $descCampanha, $anoCampanha, $dataRegistro, $idUser) { 
		global $pdo;

		$sql = $pdo->prepare("INSERT INTO campanhas SET campanha = :campanha, descCampanha = :descCampanha, anoCampanha = :anoCampanha, dataRegistro = :dataRegistro, idUser = :idUser");
		$sql->bindValue(':campanha', $campanha);
		$sql->bindValue(':descCampanha', $descCampanha);
		$sql->bindValue(':anoCampanha', $anoCampanha);
		$sql->bindValue(':dataRegistro', $dataRegistro);
		$sql->bindValue(':idUser', $idUser);
		$sql->execute();

		global $lastId; // salvo para abrir o último registro cadastrado
		$lastId = $pdo->lastInsertId();
	}

	public function editCampanha($campanha, $descCampanha, $anoCampanha, $dataAlteracao, $id) {
		global $pdo;

		$sql = $pdo->prepare("UPDATE campanhas SET campanha = :campanha, descCampanha = :descCampanha, anoCampanha = :anoCampanha, dataAlteracao = :dataAlteracao WHERE id = :id");

		$sql->bindValue(':campanha', $campanha);
		$sql->bindValue(':descCampanha', $descCampanha);
		$sql->bindValue(':anoCampanha', $anoCampanha);
		$sql->bindValue(':dataAlteracao', $dataAlteracao);
		//$sql->bindValue(':idUser', $idUser);
		$sql->bindValue(':id', $id);
		$sql->execute();
	}

	public function excluirCampanha($id) {
		global $pdo;
		
		$sql = $pdo->prepare("DELETE FROM campanhas WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
	}
}