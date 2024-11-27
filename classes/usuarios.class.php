<?php 
class Usuarios {

	public function getUsuarios() {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT *,
		(SELECT permissoes.role FROM permissoes WHERE usuarios.idRole = permissoes.id) AS role
		FROM usuarios ORDER BY name");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getUsuariosByRole() {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT * FROM usuarios WHERE idRole IN (2,3) AND idStatus = 1 ORDER BY name"); // role = Gerenciador, idStatus = Ativo
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getTotalUsuarios() {
		global $pdo;

		$sql = $pdo->query("SELECT COUNT(*) AS c FROM usuarios");
		$row = $sql->fetch();

		return $row['c'];
	}

	public function getUsuario($id) {
		$array = array(); // um array vazio
		global $pdo;

		$sql = $pdo->prepare("SELECT *, 
			(SELECT permissoes.role FROM permissoes WHERE usuarios.idRole = permissoes.id) AS role
		 	FROM usuarios WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();	// preenche o array
		}
		
		return $array; // retorna o array
	}

	public function addUsuario($name, $email, $password, $idStatus, $idRole, $gender, $dataRegistro) {
		global $pdo;

		$sql = $pdo->prepare("INSERT INTO usuarios SET name = :name, email = :email, password = :password, idStatus = :idStatus, idRole = :idRole, gender = :gender, dataRegistro = :dataRegistro");
		$sql->bindValue(':name', $name);
		$sql->bindValue(':email', $email);
		$sql->bindValue(':password', $password);
		$sql->bindValue(':idStatus', $idStatus);
		$sql->bindValue(':idRole', $idRole);
		$sql->bindValue(':gender', $gender);
		$sql->bindValue(':dataRegistro', $dataRegistro);
		$sql->execute();

		global $lastId; // salvo para abrir o último registro cadastrado
		$lastId = $pdo->lastInsertId();
	}

	public function editUsuario($name, $email, $password, $idStatus, $idRole, $gender, $dataAlteracao, $id) {
		global $pdo;

		$sql = $pdo->prepare("UPDATE usuarios SET name = :name, email = :email, password = :password, idStatus = :idStatus, idRole = :idRole, gender = :gender, dataAlteracao = :dataAlteracao WHERE id = :id");

		$sql->bindValue(':name', $name);
		$sql->bindValue(':email', $email);
		$sql->bindValue(':password', $password);	
		$sql->bindValue(':idStatus', $idStatus);
		$sql->bindValue(':idRole', $idRole);
		$sql->bindValue(':gender', $gender);
		$sql->bindValue(':dataAlteracao', $dataAlteracao);
		$sql->bindValue(':id', $id);
		$sql->execute();
	}
	
	public function excluirUsuario($id) {
		global $pdo;
		
		$sql = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
	}

	public function login ($email, $password) {
		global $pdo;		

		$sql = $pdo->prepare("SELECT id, idRole, idStatus, name, filename, gender FROM usuarios WHERE email = :email AND password = :password AND idStatus = 1");
		$sql->bindValue(":email", $email);
		$sql->bindValue(":password", make_hash($password));
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$user = $sql->fetch();
			
			$_SESSION['logged_in'] = true;
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['user_role'] = $user['idRole'];
			$_SESSION['user_name'] = $user['name'];
			$_SESSION['user_avatar'] = $user['filename'];
			$_SESSION['user_gender'] = $user['gender'];			

			return true;
			
		} else {
			return false;
		}
	}

	public function editPerfilUsuario($name, $email, $password, $dataAlteracao, $id) {
		global $pdo;

		$sql = $pdo->prepare("UPDATE usuarios SET name = :name, email = :email, password = :password, dataAlteracao = :dataAlteracao WHERE id = :id");

		$sql->bindValue(':name', $name);
		$sql->bindValue(':email', $email);
		$sql->bindValue(':password', $password);	
		$sql->bindValue(':dataAlteracao', $dataAlteracao);
		$sql->bindValue(':id', $id);
		$sql->execute();
	}
}
