<?php 
class Permissoes {

	public function getPermissoes() {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT * FROM permissoes");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}
}