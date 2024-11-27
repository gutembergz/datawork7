<?php

class MateriasCt {

	public function addMateriaContratada($idContrato, $idMateria, $idPublicacao, $idStatus, $idUserProducao, $idUserAprovacao, $idPacote, $prazo, $empresa, $obs, $dataProducao, $dataLimite, $dataExpiracao, $dataRegistro, $idUser) {
		global $pdo;

		$sql = $pdo->prepare("INSERT INTO materiasContratadas SET idContrato = :idContrato, idMateria = :idMateria, idPublicacao = :idPublicacao, idStatus = :idStatus, idUserProducao = :idUserProducao, idUserAprovacao = :idUserAprovacao, idPacote = :idPacote, prazo = :prazo, empresa = :empresa, obs = :obs, dataProducao = :dataProducao, dataLimite = :dataLimite, dataExpiracao = :dataExpiracao, dataRegistro = :dataRegistro, idUser = :idUser");

		$sql->bindValue(':idContrato', $idContrato);
		$sql->bindValue(':idMateria', $idMateria);
		$sql->bindValue(':idPublicacao', $idPublicacao);
		$sql->bindValue(':idStatus', $idStatus);
		$sql->bindValue(':idUserProducao', $idUserProducao);
		$sql->bindValue(':idUserAprovacao', $idUserAprovacao);
		$sql->bindValue(':idPacote', $idPacote);		
		$sql->bindValue(':prazo', $prazo);		
		$sql->bindValue(':empresa', $empresa);	
		$sql->bindValue(':obs', $obs);	
		$sql->bindValue(':dataProducao', $dataProducao);
		$sql->bindValue(':dataLimite', $dataLimite);
		$sql->bindValue(':dataExpiracao', $dataExpiracao);
		$sql->bindValue(':dataRegistro', $dataRegistro);		
		$sql->bindValue(':idUser', $idUser);
		$sql->execute();

		global $lastId; // salvo para abrir o último registro cadastrado
		$lastId = $pdo->lastInsertId();
	}

	public function editMateriaContratada($idContrato, $idMateria, $idPublicacao, $idStatus, $idUserProducao, $idUserAprovacao, $idPacote, $prazo, $empresa, $obs, $dataProducao, $dataLimite, $dataExpiracao, $dataAlteracao, $idUserAlteracao, $idCategoria, $frasedestaque, $descricao, $produtos, $palavraschave, $metadescricao,$telefone, $celular, $email, $website, $facebook, $whatsapp, $linkedin, $instagram, $twitter, $youtube, $linkVideo, $dataInicio, $dataTermino, $orcamento, $locais, $diasSemana, $horarioInicial, $horarioFinal, $caracteristicas,$pesqEndereco, $endereco, $numero, $complemento, $bairro, $cidade, $uf, $cep, $latitude, $longitude, $fotos, $id) {

		global $pdo;

		$sql = $pdo->prepare("UPDATE materiasContratadas SET idContrato = :idContrato, idMateria = :idMateria, idPublicacao = :idPublicacao, idStatus = :idStatus, idUserProducao = :idUserProducao, idUserAprovacao = :idUserAprovacao, idPacote = :idPacote, prazo = :prazo, empresa = :empresa, obs = :obs, dataProducao = :dataProducao, dataLimite = :dataLimite, dataExpiracao = :dataExpiracao, dataAlteracao = :dataAlteracao, idUserAlteracao = :idUserAlteracao, idCategoria = :idCategoria, frasedestaque = :frasedestaque, descricao = :descricao, produtos = :produtos, palavraschave = :palavraschave, metadescricao = :metadescricao, telefone = :telefone, celular = :celular, email = :email, website = :website, facebook = :facebook, whatsapp = :whatsapp, linkedin = :linkedin, instagram = :instagram, twitter = :twitter, youtube = :youtube, linkVideo = :linkVideo, dataInicio = :dataInicio, dataTermino = :dataTermino, orcamento = :orcamento, locais = :locais, diasSemana = :diasSemana, horarioInicial = :horarioInicial, horarioFinal = :horarioFinal, caracteristicas = :caracteristicas, pesqEndereco = :pesqEndereco, endereco = :endereco, numero = :numero, complemento = :complemento, bairro = :bairro, cidade = :cidade, uf = :uf, cep = :cep, latitude = :latitude, longitude = :longitude WHERE id = :id");

		$sql->bindValue(':idContrato', $idContrato);
		$sql->bindValue(':idMateria', $idMateria);
		$sql->bindValue(':idPublicacao', $idPublicacao);
		$sql->bindValue(':idStatus', $idStatus);
		$sql->bindValue(':idUserProducao', $idUserProducao);
		$sql->bindValue(':idUserAprovacao', $idUserAprovacao);
		$sql->bindValue(':idPacote', $idPacote);
		$sql->bindValue(':prazo', $prazo);
		$sql->bindValue(':empresa', $empresa);
		$sql->bindValue(':obs', $obs);
		$sql->bindValue(':dataProducao', $dataProducao);
		$sql->bindValue(':dataLimite', $dataLimite);
		$sql->bindValue(':dataExpiracao', $dataExpiracao);
		$sql->bindValue(':dataAlteracao', $dataAlteracao);
		$sql->bindValue(':idUserAlteracao', $idUserAlteracao);

		$sql->bindValue(':idCategoria', $idCategoria);
		$sql->bindValue(':frasedestaque', $frasedestaque);
		$sql->bindValue(':descricao', $descricao);
		$sql->bindValue(':produtos', $produtos);
		$sql->bindValue(':palavraschave', $palavraschave);
		$sql->bindValue(':metadescricao', $metadescricao);

		$sql->bindValue(':telefone', $telefone);
		$sql->bindValue(':celular', $celular);
		$sql->bindValue(':email', $email);
		$sql->bindValue(':website', $website);

		$sql->bindValue(':facebook', $facebook);
		$sql->bindValue(':whatsapp', $whatsapp);
		$sql->bindValue(':linkedin', $linkedin);
		$sql->bindValue(':instagram', $instagram);
		$sql->bindValue(':twitter', $twitter);
		$sql->bindValue(':youtube', $youtube);

		$sql->bindValue(':linkVideo', $linkVideo);		

		$sql->bindValue(':dataInicio', $dataInicio);
		$sql->bindValue(':dataTermino', $dataTermino);
		$sql->bindValue(':orcamento', $orcamento);
		$sql->bindValue(':locais', $locais);
		$sql->bindValue(':diasSemana', $diasSemana);
		$sql->bindValue(':horarioInicial', $horarioInicial);
		$sql->bindValue(':horarioFinal', $horarioFinal);

		$sql->bindValue(':caracteristicas', $caracteristicas);

		$sql->bindValue(':pesqEndereco', $pesqEndereco);
		$sql->bindValue(':endereco', $endereco);
		$sql->bindValue(':numero', $numero);
		$sql->bindValue(':complemento', $complemento);
		$sql->bindValue(':bairro', $bairro);
		$sql->bindValue(':cidade', $cidade);
		$sql->bindValue(':uf', $uf);
		$sql->bindValue(':cep', $cep);
		$sql->bindValue(':latitude', $latitude);
		$sql->bindValue(':longitude', $longitude);

		$sql->bindValue(':id', $id);
		$sql->execute();

		if (count($fotos) > 0) {
			for ($q=0; $q<count($fotos['tmp_name']); $q++) {
				$tipo = $fotos['type'][$q];
				if(in_array($tipo, array('image/jpeg', 'image/png'))) {
					$tmpname = md5(time().rand(0,9999)).'.jpg';
					move_uploaded_file($fotos['tmp_name'][$q], '../../../images/materias/'.$tmpname);
				
					list($width_orig, $height_orig) = getimagesize('../../../images/materias/'.$tmpname);
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
						$origi = imagecreatefromjpeg('../../../images/materias/'.$tmpname);
					} elseif($tipo == 'image/png') {
						$origi = imagecreatefrompng('../../../images/materias/'.$tmpname);
					}

					imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

					imagejpeg($img, '../../../images/materias/'.$tmpname, 80);

					$sql = $pdo-> prepare("INSERT INTO materiasContratadas_imagens SET idMateriaContratada = :idMateriaContratada, url = :url");
					$sql->bindValue(":idMateriaContratada", $id);
					$sql->bindValue(":url", $tmpname);
					$sql->execute();		
		
				}
			}
		}
	}

	public function excluirMateriaContratada($id) {
		global $pdo;
		
		$sql = $pdo->prepare("DELETE FROM materiasContratadas_imagens WHERE idMateriaContratada = :idMateriaContratada");
		$sql->bindValue(":idMateriaContratada", $id);
		$sql->execute();

		$sql = $pdo->prepare("DELETE FROM materiasContratadas_googleAds WHERE idMateriaContratada = :idMateriaContratada");
		$sql->bindValue(":idMateriaContratada", $id);
		$sql->execute();

		$sql = $pdo->prepare("DELETE FROM materiasContratadas_postagens WHERE idMateriaContratada = :idMateriaContratada");
		$sql->bindValue(":idMateriaContratada", $id);
		$sql->execute();

		$sql = $pdo->prepare("DELETE FROM materiasContratadas WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
	}

	public function getMateriaContratada($id) {
		$array = array();
		global $pdo;

		$sql = $pdo->prepare("SELECT *,
		(SELECT usuarios.name FROM usuarios WHERE usuarios.id = materiasContratadas.idUser) AS nomeUsuario,
		(SELECT usuarios.name FROM usuarios WHERE usuarios.id = materiasContratadas.idUserAlteracao) AS userAlteracao,
		(SELECT contratos.nContrato FROM contratos WHERE contratos.id = materiasContratadas.idContrato) AS nContrato,
		(SELECT contratos.idCliente FROM contratos WHERE contratos.id = materiasContratadas.idContrato) AS idCliente,			
		(SELECT contratos.dataRegistro FROM contratos WHERE contratos.id = materiasContratadas.idContrato) AS dataCt,
		(SELECT contratos.prazo FROM contratos WHERE contratos.id = materiasContratadas.idContrato) AS prazoCt,
		(SELECT clientes.empresa FROM clientes WHERE clientes.id = idCliente) AS empresaCt
		FROM materiasContratadas WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
			$array['fotos'] = array();

			$sql = $pdo->prepare("SELECT id, url, titulo FROM materiasContratadas_imagens WHERE idMateriaContratada = :idMateriaContratada");
			$sql->bindValue(":idMateriaContratada", $id);
			$sql->execute();

			if($sql->rowCount() > 0) {
				$array['fotos'] = $sql->fetchAll();
			}	
		}
		
		return $array;
	}

	public function excluirImagem($id) {
		global $pdo;

		$idMateriaContratada = 0;

		$sql = $pdo->prepare("SELECT idMateriaContratada, url FROM materiasContratadas_imagens WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$row = $sql->fetch();
			$idMateriaContratada = $row['idMateriaContratada'];
			$url = $row['url'];
			unlink('../../../images/materias/' . $url);

		}		

		$sql = $pdo->prepare("DELETE FROM materiasContratadas_imagens WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		return $idMateriaContratada;
	}
	
	public function getMateriaContratadaMaps($id) {

		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT latitude, longitude FROM materiasContratadas WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();	
			
		}

		return $array;	
	}

	// abaixo, são as funções relacionadas às postagens das matérias de redes sociais

	// obtém todos os posts da matéria
	public function getMateriasContratadasPostagens($id) { 
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT * FROM materiasContratadas_postagens WHERE idMateriaContratada = :idMateriaContratada");
		$sql->bindValue(":idMateriaContratada", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	// obtém um post específico
	public function getMateriaContratadaPostagens($id) {

		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT * FROM materiasContratadas_postagens WHERE id = :id LIMIT 1");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();	
			
		}

		return $array;	
	}

	public function addMateriasContratadasPostagens($idMateriaContratada, $titulo, $dataPublicacao, $idStatus, $urlFacebook, $urlInstagram, $urlLinkedin, $urlTwitter, $urlFacebook_bitly, $urlInstagram_bitly, $urlLinkedin_bitly, $urlTwitter_bitly) {
		global $pdo;

		$sql = $pdo->prepare("INSERT INTO materiasContratadas_postagens SET idMateriaContratada = :idMateriaContratada, titulo = :titulo, dataPublicacao = :dataPublicacao, idStatus = :idStatus, urlFacebook = :urlFacebook, urlInstagram = :urlInstagram, urlLinkedin = :urlLinkedin, urlTwitter = :urlTwitter, urlFacebook_bitly = :urlFacebook_bitly, urlInstagram_bitly = :urlInstagram_bitly, urlLinkedin_bitly = :urlLinkedin_bitly, urlTwitter_bitly = :urlTwitter_bitly");

		$sql->bindValue(':idMateriaContratada', $idMateriaContratada);
		$sql->bindValue(':titulo', $titulo);
		$sql->bindValue(':dataPublicacao', $dataPublicacao);
		$sql->bindValue(':idStatus', $idStatus);
		$sql->bindValue(':urlFacebook', $urlFacebook);
		$sql->bindValue(':urlInstagram', $urlInstagram);
		$sql->bindValue(':urlLinkedin', $urlLinkedin);
		$sql->bindValue(':urlTwitter', $urlTwitter);
		$sql->bindValue(':urlFacebook_bitly', $urlFacebook_bitly);
		$sql->bindValue(':urlInstagram_bitly', $urlInstagram_bitly);
		$sql->bindValue(':urlLinkedin_bitly', $urlLinkedin_bitly);
		$sql->bindValue(':urlTwitter_bitly', $urlTwitter_bitly);
		$sql->execute();
	}

	public function editMateriasContratadasPostagens($idMateriaContratada, $titulo, $dataPublicacao, $idStatus, $urlFacebook, $urlInstagram, $urlLinkedin, $urlTwitter, $urlFacebook_bitly, $urlInstagram_bitly, $urlLinkedin_bitly, $urlTwitter_bitly, $id) {
		global $pdo;

		$sql = $pdo->prepare("UPDATE materiasContratadas_postagens SET idMateriaContratada = :idMateriaContratada, titulo = :titulo, dataPublicacao = :dataPublicacao, idStatus = :idStatus, urlFacebook = :urlFacebook, urlInstagram = :urlInstagram, urlLinkedin = :urlLinkedin, urlTwitter = :urlTwitter, urlFacebook_bitly = :urlFacebook_bitly, urlInstagram_bitly = :urlInstagram_bitly, urlLinkedin_bitly = :urlLinkedin_bitly, urlTwitter_bitly = :urlTwitter_bitly WHERE id = :id");

		$sql->bindValue(':idMateriaContratada', $idMateriaContratada);
		$sql->bindValue(':titulo', $titulo);
		$sql->bindValue(':dataPublicacao', $dataPublicacao);
		$sql->bindValue(':idStatus', $idStatus);
		$sql->bindValue(':urlFacebook', $urlFacebook);
		$sql->bindValue(':urlInstagram', $urlInstagram);
		$sql->bindValue(':urlLinkedin', $urlLinkedin);
		$sql->bindValue(':urlTwitter', $urlTwitter);
		$sql->bindValue(':urlFacebook_bitly', $urlFacebook_bitly);
		$sql->bindValue(':urlInstagram_bitly', $urlInstagram_bitly);
		$sql->bindValue(':urlLinkedin_bitly', $urlLinkedin_bitly);
		$sql->bindValue(':urlTwitter_bitly', $urlTwitter_bitly);
		$sql->bindValue(':id', $id);
		$sql->execute();
	}

	public function excluirMateriaContratadasPostagens($id) {
		global $pdo;

		$sql = $pdo->prepare("DELETE FROM materiasContratadas_postagens WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
	}

	// relacionadas aos posts múltiplos de Portal
	public function addMateriasContratadasPostagensPortal($idMateriaContratada, $titulo, $dataPublicacao, $idStatus) {
		global $pdo;

		$sql = $pdo->prepare("INSERT INTO materiasContratadas_postagens SET idMateriaContratada = :idMateriaContratada, titulo = :titulo, dataPublicacao = :dataPublicacao, idStatus = :idStatus");

		$sql->bindValue(':idMateriaContratada', $idMateriaContratada);
		$sql->bindValue(':titulo', $titulo);
		$sql->bindValue(':dataPublicacao', $dataPublicacao);
		$sql->bindValue(':idStatus', $idStatus);		
		$sql->execute();
	}

	// funções relacionadas aos anúncios Google Ads

	// obtém todos os Google Ads da matéria
	public function getMateriasContratadasGoogleAds($id) { 
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT * FROM materiasContratadas_googleAds WHERE idMateriaContratada = :idMateriaContratada");
		$sql->bindValue(":idMateriaContratada", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	// obtém um Google Ads específico
	public function getMateriaContratadaGoogleAds($id) {

		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT * FROM materiasContratadas_googleAds WHERE id = :id LIMIT 1");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();	
			
		}

		return $array;	
	}

	public function addMateriasContratadasGoogleAds($idMateriaContratada, $urlFinal, $urlVisualizacao, $titulo1, $titulo2, $titulo3, $titulo4, $titulo5, $titulo6, $titulo7, $titulo8, $titulo9, $titulo10, $titulo11, $titulo12, $titulo13, $titulo14, $titulo15, $descricao1, $descricao2, $descricao3, $descricao4, $contaTitulos, $contaDescricoes) {
		global $pdo;

		$sql = $pdo->prepare("INSERT INTO materiasContratadas_googleAds SET idMateriaContratada = :idMateriaContratada, urlFinal = :urlFinal, urlVisualizacao = :urlVisualizacao, titulo1 = :titulo1, titulo2 = :titulo2, titulo3 = :titulo3, titulo4 = :titulo4, titulo5 = :titulo5, titulo6 = :titulo6, titulo7 = :titulo7, titulo8 = :titulo8, titulo9 = :titulo9, titulo10 = :titulo10, titulo11 = :titulo11, titulo12 = :titulo12, titulo13 = :titulo13, titulo14 = :titulo14, titulo15 = :titulo15, descricao1 = :descricao1, descricao2 = :descricao2, descricao3 = :descricao3, descricao4 = :descricao4, contaTitulos = :contaTitulos, contaDescricoes = :contaDescricoes");

		$sql->bindValue(':idMateriaContratada', $idMateriaContratada);
		$sql->bindValue(':urlFinal', $urlFinal);
		$sql->bindValue(':urlVisualizacao', $urlVisualizacao);
		$sql->bindValue(':titulo1', $titulo1);
		$sql->bindValue(':titulo2', $titulo2);
		$sql->bindValue(':titulo3', $titulo3);
		$sql->bindValue(':titulo4', $titulo4);
		$sql->bindValue(':titulo5', $titulo5);
		$sql->bindValue(':titulo6', $titulo6);
		$sql->bindValue(':titulo7', $titulo7);
		$sql->bindValue(':titulo8', $titulo8);
		$sql->bindValue(':titulo9', $titulo9);
		$sql->bindValue(':titulo10', $titulo10);
		$sql->bindValue(':titulo11', $titulo11);
		$sql->bindValue(':titulo12', $titulo12);
		$sql->bindValue(':titulo13', $titulo13);
		$sql->bindValue(':titulo14', $titulo14);
		$sql->bindValue(':titulo15', $titulo15);
		$sql->bindValue(':descricao1', $descricao1);
		$sql->bindValue(':descricao2', $descricao2);
		$sql->bindValue(':descricao3', $descricao3);
		$sql->bindValue(':descricao4', $descricao4);
		$sql->bindValue(':contaTitulos', $contaTitulos);
		$sql->bindValue(':contaDescricoes', $contaDescricoes);

		$sql->execute();
	}

	public function editMateriasContratadasGoogleAds($idMateriaContratada, $urlFinal, $urlVisualizacao, $titulo1, $titulo2, $titulo3, $titulo4, $titulo5, $titulo6, $titulo7, $titulo8, $titulo9, $titulo10, $titulo11, $titulo12, $titulo13, $titulo14, $titulo15, $descricao1, $descricao2, $descricao3, $descricao4, $contaTitulos, $contaDescricoes, $id) {
		global $pdo;

		$sql = $pdo->prepare("UPDATE materiasContratadas_googleAds SET idMateriaContratada = :idMateriaContratada, urlFinal = :urlFinal, urlVisualizacao = :urlVisualizacao, titulo1 = :titulo1, titulo2 = :titulo2, titulo3 = :titulo3, titulo4 = :titulo4, titulo5 = :titulo5, titulo6 = :titulo6, titulo7 = :titulo7, titulo8 = :titulo8, titulo9 = :titulo9, titulo10 = :titulo10, titulo11 = :titulo11, titulo12 = :titulo12, titulo13 = :titulo13, titulo14 = :titulo14, titulo15 = :titulo15, descricao1 = :descricao1, descricao2 = :descricao2, descricao3 = :descricao3, descricao4 = :descricao4, contaTitulos = :contaTitulos, contaDescricoes = :contaDescricoes WHERE id = :id");

		$sql->bindValue(':idMateriaContratada', $idMateriaContratada);
		$sql->bindValue(':urlFinal', $urlFinal);
		$sql->bindValue(':urlVisualizacao', $urlVisualizacao);
		$sql->bindValue(':titulo1', $titulo1);
		$sql->bindValue(':titulo2', $titulo2);
		$sql->bindValue(':titulo3', $titulo3);
		$sql->bindValue(':titulo4', $titulo4);
		$sql->bindValue(':titulo5', $titulo5);
		$sql->bindValue(':titulo6', $titulo6);
		$sql->bindValue(':titulo7', $titulo7);
		$sql->bindValue(':titulo8', $titulo8);
		$sql->bindValue(':titulo9', $titulo9);
		$sql->bindValue(':titulo10', $titulo10);
		$sql->bindValue(':titulo11', $titulo11);
		$sql->bindValue(':titulo12', $titulo12);
		$sql->bindValue(':titulo13', $titulo13);
		$sql->bindValue(':titulo14', $titulo14);
		$sql->bindValue(':titulo15', $titulo15);
		$sql->bindValue(':descricao1', $descricao1);
		$sql->bindValue(':descricao2', $descricao2);
		$sql->bindValue(':descricao3', $descricao3);
		$sql->bindValue(':descricao4', $descricao4);
		$sql->bindValue(':contaTitulos', $contaTitulos);
		$sql->bindValue(':contaDescricoes', $contaDescricoes);
		
		$sql->bindValue(':id', $id);
		$sql->execute();
	}

	public function excluirMateriaContratadasGoogleAds($id) {
		global $pdo;

		$sql = $pdo->prepare("DELETE FROM materiasContratadas_googleAds WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
	}
	

	// funções relacionadas aos anúncios Google Ads Chamadas

	// obtém todos os Google Ads Chamada da matéria
	public function getMateriasContratadasGoogleAdsChamadas($id) { 
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT * FROM materiasContratadas_googleAdsChamada WHERE idMateriaContratada = :idMateriaContratada");
		$sql->bindValue(":idMateriaContratada", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	// obtém um Google Ads Chamadas específico
	public function getMateriaContratadaGoogleAdsChamadas($id) {

		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT * FROM materiasContratadas_googleAdsChamadas WHERE id = :id LIMIT 1");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();	
			
		}

		return $array;	
	}

	public function addMateriasContratadasGoogleAdsChamadas($idMateriaContratada, $urlFinalChamada, $urlVisualizacaoChamada, $titulo1Chamada, $titulo2Chamada, $descricao1Chamada, $descricao2Chamada, $contaTitulosChamada, $contaDescricoesChamada, $nomeEmpresa, $numeroTel) {
		global $pdo;

		$sql = $pdo->prepare("INSERT INTO materiasContratadas_googleAdsChamadas SET idMateriaContratada = :idMateriaContratada, urlFinalChamada = :urlFinalChamada, urlVisualizacaoChamada = :urlVisualizacaoChamada, titulo1Chamada = :titulo1Chamada, titulo2Chamada = :titulo2Chamada,  descricao1Chamada = :descricao1Chamada, descricao2Chamada = :descricao2Chamada, contaTitulosChamada = :contaTitulosChamada, contaDescricoesChamada = :contaDescricoesChamada, nomeEmpresa = :nomeEmpresa, numeroTel = :numeroTel");

		$sql->bindValue(':idMateriaContratada', $idMateriaContratada);
		$sql->bindValue(':urlFinalChamada', $urlFinalChamada);
		$sql->bindValue(':urlVisualizacaoChamada', $urlVisualizacaoChamada);
		$sql->bindValue(':titulo1Chamada', $titulo1Chamada);
		$sql->bindValue(':titulo2Chamada', $titulo2Chamada);		
		$sql->bindValue(':descricao1Chamada', $descricao1Chamada);
		$sql->bindValue(':descricao2Chamada', $descricao2Chamada);		
		$sql->bindValue(':contaTitulosChamada', $contaTitulosChamada);
		$sql->bindValue(':contaDescricoesChamada', $contaDescricoesChamada);
		$sql->bindValue(':nomeEmpresa', $nomeEmpresa);
		$sql->bindValue(':numeroTel', $numeroTel);

		$sql->execute();
	}

	public function editMateriasContratadasGoogleAdsChamadas($idMateriaContratada, $urlFinalChamada, $urlVisualizacaoChamada, $titulo1Chamada, $titulo2Chamada, $descricao1Chamada, $descricao2Chamada, $contaTitulosChamada, $contaDescricoesChamada, $nomeEmpresa, $numeroTel, $id) {
		global $pdo;

		$sql = $pdo->prepare("UPDATE materiasContratadas_googleAdsChamadas SET idMateriaContratada = :idMateriaContratada, urlFinalChamada = :urlFinalChamada, urlVisualizacaoChamada = :urlVisualizacaoChamada, titulo1Chamada = :titulo1Chamada, titulo2Chamada = :titulo2Chamada,  descricao1Chamada = :descricao1Chamada, descricao2Chamada = :descricao2Chamada, contaTitulosChamada = :contaTitulosChamada, contaDescricoesChamada = :contaDescricoesChamada, nomeEmpresa = :nomeEmpresa, numeroTel = :numeroTel WHERE id = :id");

		$sql->bindValue(':idMateriaContratada', $idMateriaContratada);
		$sql->bindValue(':urlFinalChamada', $urlFinalChamada);
		$sql->bindValue(':urlVisualizacaoChamada', $urlVisualizacaoChamada);
		$sql->bindValue(':titulo1Chamada', $titulo1Chamada);
		$sql->bindValue(':titulo2Chamada', $titulo2Chamada);		
		$sql->bindValue(':descricao1Chamada', $descricao1Chamada);
		$sql->bindValue(':descricao2Chamada', $descricao2Chamada);		
		$sql->bindValue(':contaTitulosChamada', $contaTitulosChamada);
		$sql->bindValue(':contaDescricoesChamada', $contaDescricoesChamada);
		$sql->bindValue(':nomeEmpresa', $nomeEmpresa);
		$sql->bindValue(':numeroTel', $numeroTel);
		
		$sql->bindValue(':id', $id);
		$sql->execute();
	}

	public function excluirMateriaContratadasGoogleAdsChamadas($id) {
		global $pdo;

		$sql = $pdo->prepare("DELETE FROM materiasContratadas_googleAdsChamadas WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
	}

	// obtemos a contagem de materias específicas + a data de registro da última matéria selecionada
	public function getTotalMateriasContratadas($idContrato, $idMateria) {
		
		global $pdo;
		$array = array();
		$sql = $pdo->prepare("SELECT COUNT(id) AS c, max(dataLimite) AS ultimoRegistro FROM materiasContratadas WHERE idContrato = :idContrato AND idMateria = :idMateria LIMIT 1");
		$sql->bindValue(":idContrato", $idContrato);
		$sql->bindValue(":idMateria", $idMateria);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();	
			
		}

		return $array;


	}		
	
}