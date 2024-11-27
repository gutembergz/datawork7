<?php 
class Contratos {

	public function getContratos() {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT *,
		(SELECT campanhas.campanha FROM campanhas WHERE contratos.idCampanha = campanhas.id) AS campanha,
		(SELECT clientes.empresa FROM clientes WHERE contratos.idCliente = clientes.id) AS empresa,
		(SELECT usuarios.name FROM usuarios WHERE contratos.idUser = usuarios.id) AS nomeUsuario
		FROM contratos");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getTotalContratos() {
		global $pdo;
		
		$sql = $pdo->prepare("SELECT COUNT(*) AS c FROM contratos WHERE idStatus IN(1,2,3,5,7,8,10,12)");
		$sql->execute();
		$row = $sql->fetch();

		return $row['c'];
	}

	public function getContrato($id) {
		$array = array();
		global $pdo;

		$sql = $pdo->prepare("SELECT *, 
		(SELECT usuarios.name FROM usuarios WHERE usuarios.id = contratos.idUser) AS nomeUsuario,
		(SELECT usuarios.name FROM usuarios WHERE usuarios.id = contratos.idUserAlteracao) AS userAlteracao,
		(SELECT status.status FROM status WHERE status.id = contratos.idStatus) AS status,
		(SELECT clientes.empresa FROM clientes WHERE contratos.idCliente = clientes.id) AS empresa,
		(SELECT clientes.email FROM clientes WHERE clientes.id = contratos.idCliente) AS email,
		(SELECT clientes.autorizante FROM clientes WHERE clientes.id = contratos.idCliente) AS autorizante
		FROM contratos WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();	
		}
		
		return $array;
	}
	
	public function addContrato($idCliente, $idRepresentante, $idCampanha, $idStatus, $nContrato, $prazo, $valor, $obs, $dataExpiracao, $dataRegistro, $idUser) {
		global $pdo;

		$sql = $pdo->prepare("INSERT INTO contratos SET idCliente = :idCliente, idRepresentante = :idRepresentante, idCampanha = :idCampanha, idStatus = :idStatus, nContrato = :nContrato, prazo = :prazo, valor = :valor, obs = :obs, dataExpiracao = :dataExpiracao, dataRegistro = :dataRegistro, idUser = :idUser");
		$sql->bindValue(':idCliente', $idCliente);
		$sql->bindValue(':idRepresentante', $idRepresentante);
		$sql->bindValue(':idCampanha', $idCampanha);
		$sql->bindValue(':idStatus', $idStatus);
		$sql->bindValue(':nContrato', $nContrato);
		$sql->bindValue(':prazo', $prazo);
		$sql->bindValue(':valor', $valor);
		$sql->bindValue(':obs', $obs);
		$sql->bindValue(':dataExpiracao', $dataExpiracao);
		$sql->bindValue(':dataRegistro', $dataRegistro);
		$sql->bindValue(':idUser', $idUser);
		$sql->execute();

		global $lastId; // salvo para abrir o último registro cadastrado
		$lastId = $pdo->lastInsertId();
	}
	
	public function editContrato($idCliente, $idRepresentante, $idCampanha, $idStatus, $nContrato, $prazo, $valor, $obs, $dataExpiracao, $dataRegistro, $dataAlteracao, $idUserAlteracao, $id) {
		global $pdo;

		$sql = $pdo->prepare("UPDATE contratos SET idCliente = :idCliente, idRepresentante = :idRepresentante, idCampanha = :idCampanha, idStatus = :idStatus, nContrato = :nContrato, prazo = :prazo, valor = :valor, obs = :obs, dataExpiracao = :dataExpiracao, dataRegistro = :dataRegistro, dataAlteracao = :dataAlteracao, idUserAlteracao = :idUserAlteracao WHERE id = :id");

		$sql->bindValue(':idCliente', $idCliente);
		$sql->bindValue(':idRepresentante', $idRepresentante);
		$sql->bindValue(':idCampanha', $idCampanha);
		$sql->bindValue(':idStatus', $idStatus);		
		$sql->bindValue(':nContrato', $nContrato);
		$sql->bindValue(':prazo', $prazo);
		$sql->bindValue(':valor', $valor);
		$sql->bindValue(':obs', $obs);
		$sql->bindValue(':dataExpiracao', $dataExpiracao);
		$sql->bindValue(':dataRegistro', $dataRegistro);
		$sql->bindValue(':dataAlteracao', $dataAlteracao);
		$sql->bindValue(':idUserAlteracao', $idUserAlteracao);
		$sql->bindValue(':id', $id);
		$sql->execute();
	}

	public function excluirContrato($id) {
		global $pdo;

		// é preciso excluir outros registros, como: emailsEnviados, historico, outras materias Contratadas

		$sql = $pdo->prepare("DELETE FROM materiasContratadas WHERE idContrato = :idContrato");
		$sql->bindValue(":idContrato", $id);
		$sql->execute();

		$sql = $pdo->prepare("DELETE FROM materiasContratadas_imagens WHERE idContrato = :idContrato");
		$sql->bindValue(":idContrato", $id);
		$sql->execute();

		$sql = $pdo->prepare("DELETE FROM materiasContratadas_googleAds WHERE idContrato = :idContrato");
		$sql->bindValue(":idContrato", $id);
		$sql->execute();

		$sql = $pdo->prepare("DELETE FROM materiasContratadas_postagens WHERE idContrato = :idContrato");
		$sql->bindValue(":idContrato", $id);
		$sql->execute();

		$sql = $pdo->prepare("DELETE FROM contratos WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
	}

	public function getContratosCliente($idCliente) {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT *,
		(SELECT campanhas.campanha FROM campanhas WHERE contratos.idCampanha = campanhas.id) AS campanha,
		(SELECT status.status FROM status WHERE status.id = contratos.idStatus) AS status
		FROM contratos WHERE idCliente = $idCliente
		ORDER BY dataRegistro DESC");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getMateriasContrato($id) {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT *,
		(SELECT materias.materia FROM materias WHERE materiasContratadas.idMateria = materias.id) AS materia,
		(SELECT contratos.idCliente FROM contratos WHERE contratos.id = materiasContratadas.idContrato) AS idCliente,
		(SELECT contratos.nContrato FROM contratos WHERE contratos.id = materiasContratadas.idContrato) AS nContrato, 
		(SELECT clientes.empresa FROM clientes WHERE clientes.id = idCliente) AS empresa,
		(SELECT publicacoes.publicacao FROM publicacoes WHERE materiasContratadas.idPublicacao = publicacoes.id) AS publicacao
		FROM materiasContratadas WHERE idContrato = $id");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getHistoricosContrato($id) {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT *,
		(SELECT usuarios.name FROM usuarios WHERE usuarios.id = historico.idUser) AS nomeUsuario,
		(SELECT contratos.idCliente FROM contratos WHERE contratos.id = historico.idContrato) AS idCliente,
		(SELECT contratos.nContrato FROM contratos WHERE contratos.id = historico.idContrato) AS nContrato, 
		(SELECT clientes.empresa FROM clientes WHERE clientes.id = idCliente) AS empresa
		FROM historico WHERE idContrato = $id");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getContratosExpirados() {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT id, dataExpiracao FROM contratos WHERE idStatus = 10 AND dataExpiracao <= CURDATE()");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function updateContratosExpirados() {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("UPDATE contratos SET idStatus = 11 WHERE idStatus = 10 AND dataExpiracao <= CURDATE()");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

}