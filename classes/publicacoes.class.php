<?php 
class Publicacoes {

	public function getPublicacoes() {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT * FROM publicacoes ORDER BY publicacao");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}
}