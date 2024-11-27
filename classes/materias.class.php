<?php 
class Materias {

	public function getMaterias() {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT * FROM materias ORDER BY materia ASC");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getMateria($id) {
		$array = array();
		global $pdo;

		$sql = $pdo->prepare("SELECT * FROM materias WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();	
		}
		
		return $array;
	}

	public function getMateriasPortal() {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT * FROM materias WHERE id IN (1, 2, 3) ORDER BY materia ASC");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function excluirMateria($id) {
		global $pdo;
		
		$sql = $pdo->prepare("DELETE FROM materias WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
	}	
}