<?php 
class Representantes {

	public function getRepresentantes() {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT * FROM representantes");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function excluirRepresentante($id) {
		global $pdo;
		
		$sql = $pdo->prepare("DELETE FROM representantes WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
	}
}