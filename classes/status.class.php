<?php 
class Status {

	public function getStatus() {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT * FROM status ORDER BY status ");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}
}