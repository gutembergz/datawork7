<?php 
class Clientes {

	public function buscaClientes($request) {

		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT id, empresa as text FROM clientes WHERE empresa LIKE CONCAT('%', :request, '%') ORDER BY empresa");
		$sql->bindValue(":request", $request);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();	
			
		}

		return ['results' => $array];	
	}

	public function getClientes() {
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT id, empresa FROM clientes ORDER BY empresa");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getTotalClientes() {
		global $pdo;
		
		$sql = $pdo->prepare("SELECT COUNT(*) AS c FROM clientes");
		$sql->execute();
		$row = $sql->fetch();

		return $row['c'];
	}

	public function getCliente($id) {
		$array = array();
		global $pdo;

		$sql = $pdo->prepare("SELECT *, 
			(SELECT usuarios.name FROM usuarios WHERE usuarios.id = clientes.idUser) AS nomeUsuario,
			(SELECT usuarios.name FROM usuarios WHERE usuarios.id = clientes.idUserAlteracao) AS userAlteracao
		 	FROM clientes WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
			$array['fotos'] = array();

			$sql = $pdo->prepare("SELECT id, url, titulo FROM clientesImagens WHERE idCliente = :idCliente");
			$sql->bindValue(":idCliente", $id);
			$sql->execute();

			if($sql->rowCount() > 0) {
				$array['fotos'] = $sql->fetchAll();
			}	
		}
		
		return $array;
	}

	public function addCliente($empresa, $razaoSocial, $autorizante, $anunciante, $endereco, $numero, $complemento, $cidade, $uf, $bairro, $cep, $telefone, $celular, $email, $website, $cnpj, $cpf, $tipoCliente, $obs, $dataRegistro, $idUser) {
		global $pdo;

		$sql = $pdo->prepare("INSERT INTO clientes SET empresa = :empresa, razaoSocial = :razaoSocial, autorizante = :autorizante, anunciante = :anunciante, endereco = :endereco, numero = :numero, complemento = :complemento, cidade = :cidade, uf = :uf, bairro = :bairro, cep = :cep, telefone = :telefone, celular = :celular, email = :email, website = :website, cnpj = :cnpj, cpf = :cpf, tipoCliente = :tipoCliente, obs = :obs, dataRegistro = :dataRegistro, idUser = :idUser");
		$sql->bindValue(':empresa', $empresa);
		$sql->bindValue(':razaoSocial', $razaoSocial);
		$sql->bindValue(':autorizante', $autorizante);
		$sql->bindValue(':anunciante', $anunciante);
		$sql->bindValue(':endereco', $endereco);
		$sql->bindValue(':numero', $numero);
		$sql->bindValue(':complemento', $complemento);
		$sql->bindValue(':cidade', $cidade);
		$sql->bindValue(':uf', $uf);
		$sql->bindValue(':bairro', $bairro);
		$sql->bindValue(':cep', $cep);
		$sql->bindValue(':telefone', $telefone);
		$sql->bindValue(':celular', $celular);
		$sql->bindValue(':email', $email);
		$sql->bindValue(':website', $website);
		$sql->bindValue(':cnpj', $cnpj);
		$sql->bindValue(':cpf', $cpf);
		$sql->bindValue(':tipoCliente', $tipoCliente);
		$sql->bindValue(':obs', $obs);
		$sql->bindValue(':dataRegistro', $dataRegistro);
		$sql->bindValue(':idUser', $idUser);
		$sql->execute();

		global $lastId; // salvo para abrir o último registro cadastrado
		$lastId = $pdo->lastInsertId();
	}

	public function editCliente($empresa, $razaoSocial, $autorizante, $anunciante, $endereco, $numero, $complemento, $cidade, $uf, $bairro, $cep, $telefone, $celular, $email, $website, $cnpj, $cpf, $tipoCliente, $obs, $apresentacao, $produtos, $areaAtuacao, $tipoEmpresa, $fraseDestaque, $diferencial, $video, $facebook, $whatsapp, $linkedin, $instagram, $twitter, $youtube, $palavrasChave, $dataAlteracao, $idUserAlteracao, $fotos, $id) {
		global $pdo;

		$sql = $pdo->prepare("UPDATE clientes SET empresa = :empresa, razaoSocial = :razaoSocial, autorizante = :autorizante, anunciante = :anunciante, endereco = :endereco, numero = :numero, complemento = :complemento, cidade = :cidade, uf = :uf, bairro = :bairro, cep = :cep, telefone = :telefone, celular = :celular, email = :email, website = :website, cnpj = :cnpj, cpf = :cpf, tipoCliente = :tipoCliente, obs = :obs, apresentacao = :apresentacao, produtos = :produtos, areaAtuacao = :areaAtuacao, tipoEmpresa = :tipoEmpresa, fraseDestaque = :fraseDestaque, diferencial = :diferencial, video = :video, facebook = :facebook, whatsapp = :whatsapp, linkedin = :linkedin, instagram = :instagram, twitter = :twitter, youtube = :youtube, palavrasChave = :palavrasChave, dataAlteracao = :dataAlteracao, idUserAlteracao = :idUserAlteracao WHERE id = :id");

		$sql->bindValue(':empresa', $empresa);
		$sql->bindValue(':razaoSocial', $razaoSocial);
		$sql->bindValue(':autorizante', $autorizante);
		$sql->bindValue(':anunciante', $anunciante);
		$sql->bindValue(':endereco', $endereco);
		$sql->bindValue(':numero', $numero);
		$sql->bindValue(':complemento', $complemento);
		$sql->bindValue(':cidade', $cidade);
		$sql->bindValue(':uf', $uf);
		$sql->bindValue(':bairro', $bairro);
		$sql->bindValue(':cep', $cep);
		$sql->bindValue(':telefone', $telefone);
		$sql->bindValue(':celular', $celular);
		$sql->bindValue(':email', $email);
		$sql->bindValue(':website', $website);
		$sql->bindValue(':cnpj', $cnpj);
		$sql->bindValue(':cpf', $cpf);
		$sql->bindValue(':tipoCliente', $tipoCliente);
		$sql->bindValue(':obs', $obs);
		$sql->bindValue(':apresentacao', $apresentacao);
		$sql->bindValue(':produtos', $produtos);
		$sql->bindValue(':areaAtuacao', $areaAtuacao);
		$sql->bindValue(':tipoEmpresa', $tipoEmpresa);
		$sql->bindValue(':fraseDestaque', $fraseDestaque);
		$sql->bindValue(':diferencial', $diferencial);
		$sql->bindValue(':video', $video);
		$sql->bindValue(':facebook', $facebook);
		$sql->bindValue(':whatsapp', $whatsapp);
		$sql->bindValue(':linkedin', $linkedin);
		$sql->bindValue(':instagram', $instagram);
		$sql->bindValue(':twitter', $twitter);
		$sql->bindValue(':youtube', $youtube);
		$sql->bindValue(':palavrasChave', $palavrasChave);
		$sql->bindValue(':dataAlteracao', $dataAlteracao);
		$sql->bindValue(':idUserAlteracao', $idUserAlteracao);
		$sql->bindValue(':id', $id);
		$sql->execute();

		if (count($fotos) > 0) {
			for ($q=0; $q<count($fotos['tmp_name']); $q++) {
				$tipo = $fotos['type'][$q];
				if(in_array($tipo, array('image/jpeg', 'image/png'))) {
					$tmpname = md5(time().rand(0,9999)).'.jpg';
					move_uploaded_file($fotos['tmp_name'][$q], '../../images/clientes/'.$tmpname);
				
					list($width_orig, $height_orig) = getimagesize('../../images/clientes/'.$tmpname);
					$ratio = $width_orig/$height_orig;

					$width = 500;
					$height = 500;

					if ($width/$height > $ratio) {
						$width = $height*$ratio;
					} else {
						$height = $width/$ratio;
					}

					$img = imagecreatetruecolor($width, $height);

					if($tipo == 'image/jpeg') {
						$origi = imagecreatefromjpeg('../../images/clientes/'.$tmpname);
					} elseif($tipo == 'image/png') {
						$origi = imagecreatefrompng('/../../images/clientes/'.$tmpname);
					}

					imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

					imagejpeg($img, '../../images/clientes/'.$tmpname, 80);

					$sql = $pdo-> prepare("INSERT INTO clientesImagens SET idCliente = :idCliente, url = :url");
					$sql->bindValue(":idCliente", $id);
					$sql->bindValue(":url", $tmpname);
					$sql->execute();		
		
				}
			}
		}
	}

	public function excluirCliente($id) {
		global $pdo;
		
		$sql = $pdo->prepare("DELETE FROM clientes WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
	}

	public function excluirImagem($id) {
		global $pdo;

		$idCliente = 0;

		$sql = $pdo->prepare("SELECT idCliente, url FROM clientesImagens WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$row = $sql->fetch();
			$idCliente = $row['idCliente'];
			$url = $row['url'];
			unlink('../../images/clientes/' . $url);

		}		

		$sql = $pdo->prepare("DELETE FROM clientesImagens WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		return $idCliente;
	}
}