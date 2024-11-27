<?php 
class EmailsTemplates {
	/**
 	* Esta função tem o objetivo de obter todos os templates de email nos selects.
 	*/
	public function getEmailsTemplates() {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT * FROM emailsTemplates WHERE idStatus = 1 ORDER BY tipoEmail ASC");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	/**
 	* Esta função tem o objetivo de obter todos os templates de email no cadastro inicial.
 	*/
	public function getEmailsTemplatesIndex() {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT * FROM emailsTemplates ORDER BY idStatus DESC,  tipoEmail ASC");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	/**
 	* Esta função tem o objetivo de adicionar um template de email.
 	*/
	public function addEmailTemplate($assunto, $texto, $texto2, $tipoEmail, $incluiMaterias, $tiposMaterias, $tiposStatus, $idStatus, $dataRegistro, $idUser) { 
		global $pdo;

		$sql = $pdo->prepare("INSERT INTO emailsTemplates SET assunto = :assunto, texto = :texto, texto2 = :texto2, tipoEmail = :tipoEmail, incluiMaterias = :incluiMaterias, tiposMaterias = :tiposMaterias, tiposStatus = :tiposStatus, idStatus = :idStatus, 


			dataRegistro = :dataRegistro, idUser = :idUser");
		
		$sql->bindParam(':assunto', $assunto);
		$sql->bindParam(':texto', $texto);
		$sql->bindParam(':texto2', $texto2);
		$sql->bindParam(':tipoEmail', $tipoEmail);
		$sql->bindParam(':incluiMaterias', $incluiMaterias);
		$sql->bindParam(':tiposMaterias', $tiposMaterias);
		$sql->bindParam(':tiposStatus', $tiposStatus);
		$sql->bindParam(':idStatus', $idStatus);
		$sql->bindValue(':dataRegistro', $dataRegistro);
		$sql->bindValue(':idUser', $idUser);
		$sql->execute();

		global $lastId; // salvo para abrir o último registro cadastrado
		$lastId = $pdo->lastInsertId();
	}

	/**
 	* Esta função tem o objetivo de editar o template de email.
 	*/
	public function editEmailTemplate($assunto, $texto, $texto2, $tipoEmail, $incluiMaterias, $tiposMaterias, $tiposStatus, $idStatus, $dataAlteracao, $id) {
		global $pdo;

		$sql = $pdo->prepare("UPDATE emailsTemplates SET assunto = :assunto, texto = :texto, texto2 = :texto2, tipoEmail = :tipoEmail, incluiMaterias = :incluiMaterias, tiposMaterias = :tiposMaterias, tiposStatus = :tiposStatus, idStatus = :idStatus, dataAlteracao = :dataAlteracao WHERE id = :id");

		$sql->bindParam(':assunto', $assunto);
		$sql->bindParam(':texto', $texto);
		$sql->bindParam(':texto2', $texto2);
		$sql->bindParam(':tipoEmail', $tipoEmail);
		$sql->bindParam(':incluiMaterias', $incluiMaterias);
		$sql->bindParam(':tiposMaterias', $tiposMaterias);
		$sql->bindParam(':tiposStatus', $tiposStatus);
		$sql->bindParam(':idStatus', $idStatus);
		//$sql->bindParam(':idUser', $idUser);
		$sql->bindValue(':dataAlteracao', $dataAlteracao);
		$sql->bindValue(':id', $id);
		$sql->execute();
	}

	/**
 	* Esta função tem o objetivo de obter apenas um template de email específico.
 	*/
	public function getEmailTemplate($idEmailTemplate){
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT *,
		(SELECT usuarios.name FROM usuarios WHERE usuarios.id = emailsTemplates.idUser) AS nomeUsuario
		FROM emailsTemplates WHERE id = $idEmailTemplate");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}
	
	/**
 	* Esta função tem o objetivo de obter todas as materias para o email referente ao contrato especificado.
 	*/
	public function getEmailsMaterias($tiposMaterias, $tiposStatus, $idContrato) {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT *,		
		(SELECT publicacoes.publicacao FROM publicacoes WHERE materiasContratadas.idPublicacao = publicacoes.id) AS publicacao,
		(SELECT materias.materia FROM materias WHERE materiasContratadas.idMateria = materias.id) AS materia
		FROM materiasContratadas
		WHERE materiasContratadas.idMateria IN ($tiposMaterias) AND materiasContratadas.idStatus IN ($tiposStatus) AND idContrato = $idContrato");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	/**
 	* Esta função tem o objetivo de excluir um template de email.
 	*/
	public function excluirTemplateEmail($id) {
		global $pdo;
		
		$sql = $pdo->prepare("DELETE FROM emailsTemplates WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
	}
		
}