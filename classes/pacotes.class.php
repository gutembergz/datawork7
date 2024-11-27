<?php 
class Pacotes {

	public function getPacotes() {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT * FROM pacotes WHERE idStatus = 1 ORDER BY ordem ASC");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getPacote($id) {
		$array = array();
		global $pdo;

		$sql = $pdo->prepare("SELECT *,
		(SELECT usuarios.name FROM usuarios WHERE usuarios.id = pacotes.idUser) AS nomeUsuario

		FROM pacotes WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();	
		}
		
		return $array;
	}

	public function	editPacote($pacote, $idStatus, $qtdPecas3Meses, $qtdPecas6Meses, $qtdPecas12Meses, $qtdClass3Meses, $qtdClass6Meses, $qtdClass12Meses, $tipoPacote, $dataAlteracao, $tiposMaterias, $id) {
		global $pdo;

		$sql = $pdo->prepare("UPDATE pacotes SET pacote = :pacote, idStatus = :idStatus, qtdPecas3Meses = :qtdPecas3Meses, qtdPecas6Meses = :qtdPecas6Meses, qtdPecas12Meses = :qtdPecas12Meses, qtdClass3Meses = :qtdClass3Meses, qtdClass6Meses = :qtdClass6Meses, qtdClass12Meses = :qtdClass12Meses, tipoPacote = :tipoPacote, dataAlteracao = :dataAlteracao, tiposMaterias = :tiposMaterias WHERE id = :id");

		$sql->bindValue(':pacote', $pacote);
		$sql->bindValue(':idStatus', $idStatus);		
		$sql->bindValue(':qtdPecas3Meses', $qtdPecas3Meses);
		$sql->bindValue(':qtdPecas6Meses', $qtdPecas6Meses);
		$sql->bindValue(':qtdPecas12Meses', $qtdPecas12Meses);
		$sql->bindValue(':qtdClass3Meses', $qtdClass3Meses);
		$sql->bindValue(':qtdClass6Meses', $qtdClass6Meses);
		$sql->bindValue(':qtdClass12Meses', $qtdClass12Meses);
		$sql->bindValue(':tipoPacote', $tipoPacote);
		$sql->bindValue(':dataAlteracao', $dataAlteracao);
		$sql->bindValue(':tiposMaterias', $tiposMaterias);
		$sql->bindValue(':id', $id);
		$sql->execute();

	}

	public function excluirPacote($id) {
		global $pdo;
		
		$sql = $pdo->prepare("DELETE FROM pacotes WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
	}	
}