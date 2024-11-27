<?php 
class Historicos {

	public function getHistoricos() {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT * FROM historico");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function excluirHistorico($id) {
		global $pdo;
		
		$sql = $pdo->prepare("DELETE FROM historico WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
	}

	public function getHistorico($id) {
		$array = array();
		global $pdo;

		$sql = $pdo->prepare("SELECT *, 
		(SELECT usuarios.name FROM usuarios WHERE usuarios.id = historico.idUser) AS nomeUsuario,
		(SELECT usuarios.name FROM usuarios WHERE usuarios.id = historico.idUserAlteracao) AS userAlteracao,
		(SELECT contratos.idCliente FROM contratos WHERE contratos.id = historico.idContrato) AS idCliente,
		(SELECT contratos.nContrato FROM contratos WHERE contratos.id = historico.idContrato) AS nContrato, 
		(SELECT clientes.empresa FROM clientes WHERE clientes.id = idCliente) AS empresa
		FROM historico WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();	
		}
		
		return $array;
	}

	public function addHistorico($idContrato, $infoHistorico, $dataRegistro, $idUser) {
		global $pdo;

		$sql = $pdo->prepare("INSERT INTO historico SET idContrato = :idContrato, infoHistorico = :infoHistorico, dataRegistro = :dataRegistro, idUser = :idUser");

		$sql->bindValue(':idContrato', $idContrato);
		$sql->bindValue(':infoHistorico', $infoHistorico);
		$sql->bindValue(':dataRegistro', $dataRegistro);
		$sql->bindValue(':idUser', $idUser);
		$sql->execute();

		global $lastId; // salvo para abrir o último registro cadastrado
		$lastId = $pdo->lastInsertId();
	}

	public function editHistorico($idContrato, $infoHistorico, $dataAlteracao, $idUserAlteracao, $id) {
		global $pdo;

		$sql = $pdo->prepare("UPDATE historico SET idContrato = :idContrato, infoHistorico = :infoHistorico, dataAlteracao = :dataAlteracao, idUserAlteracao = :idUserAlteracao WHERE id = :id");

		$sql->bindValue(':idContrato', $idContrato);
		$sql->bindValue(':infoHistorico', $infoHistorico);
		$sql->bindValue(':dataAlteracao', $dataAlteracao);
		$sql->bindValue(':idUserAlteracao', $idUserAlteracao);
		$sql->bindValue(':id', $id);
		$sql->execute();
	}
	
}