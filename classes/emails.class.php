<?php

/**
 * Esta classe refere-se aos e-mails enviados aos clientes, referentes aos contratos fechados.
 */

class Emails {

	public function getTotalEmailsEnviados() {
		global $pdo;
		
		$sql = $pdo->prepare("SELECT COUNT(*) AS c FROM emailsEnviados");
		$sql->execute();
		$row = $sql->fetch();

		return $row['c'];
	}

	public function addEmailEnviado($idContrato, $idUser, $idTipoEmail, $dataEnvio, $destinatario) {
		global $pdo;

		$sql = $pdo->prepare("INSERT INTO emailsEnviados SET idContrato = :idContrato, idUser = :idUser, idTipoEmail = :idTipoEmail, dataEnvio = :dataEnvio, destinatario = :destinatario");

		$sql->bindValue(':idContrato', $idContrato);
		$sql->bindValue(':idUser', $idUser);
		$sql->bindValue(':idTipoEmail', $idTipoEmail);
		$sql->bindValue(':dataEnvio', $dataEnvio);
		$sql->bindValue(':destinatario', $destinatario);		
		$sql->execute();		
	}
				 

	public function getEmailsEnviados() {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT *,
		(SELECT usuarios.name FROM usuarios WHERE usuarios.id = emailsEnviados.idUser) AS nomeUsuario,
		(SELECT emailsTemplates.assunto FROM emailsTemplates WHERE emailsTemplates.id = emailsEnviados.idTipoEmail) AS assunto
		FROM emailsEnviados 
		ORDER BY ID DESC LIMIT 100");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getEmailsContrato($id) {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT *,
		(SELECT usuarios.name FROM usuarios WHERE usuarios.id = emailsEnviados.idUser) AS nomeUsuario,
		(SELECT emailsTemplates.assunto FROM emailsTemplates WHERE emailsTemplates.id = emailsEnviados.idTipoEmail) AS assunto
		FROM emailsEnviados WHERE idContrato = $id");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}
}