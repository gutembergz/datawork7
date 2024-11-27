<?php
session_start();
require_once '../../../init.php';
require '../../../check.php';
require '../../../classes/materiasCt.class.php';
require '../../../classes/materias.class.php';
$mc = new MateriasCt();
$mt = new Materias();
$pageTitle = 'Adicionar Pacote ao Contrato';
$idMateriaContratada = isset($_POST['idMateriaContratada']) ? $_POST['idMateriaContratada'] : null;

include (HEADER_TEMPLATE); ?>

<div class="container">

	<?php

		$diasSelecionados = isset($_POST['diasSelecionados']) ? addslashes($_POST['diasSelecionados']) : null;

		$idsMaterias = isset($_POST['idsMaterias']) ? addslashes($_POST['idsMaterias']) : null;
		// fazemos um explode no campo para eliminar as vírgulas
		$tipoMateria = explode(', ', $idsMaterias);
		// ordena o array
		sort ($tipoMateria);
		// conta o comprimento do array
		$arrlength = count($tipoMateria);

		$y = 0;
		$z = 0;

	for($x = 0; $x < $arrlength; $x++) {	
		
		$idMateria = $tipoMateria[$x];	
		$materia = $mt->getMateria($idMateria);	
		$prazo = isset($_POST['prazoContrato']) ? addslashes($_POST['prazoContrato']) : null;
		$idContrato = isset($_POST['idContrato']) ? addslashes($_POST['idContrato']) : null;
		$idUserProducao = isset($_POST['idUserProducao']) ? addslashes($_POST['idUserProducao']) : null;
		$idUserAprovacao = isset($_POST['idUserAprovacao']) ? addslashes($_POST['idUserAprovacao']) : null;
		$idPacote = isset($_POST['idPacote']) ? addslashes($_POST['idPacote']) : null; 
		$empresa = isset($_POST['empresa']) ? addslashes($_POST['empresa']) : null; 
		$obs = 'Matéria adicionada em lote.';
		$dataRegistroCt = isset($_POST['dataRegistro']) ? addslashes($_POST['dataRegistro']) : null;
		$dataRegistro = date("Y-m-d H:i:s"); // equivale à função now() em SQL 
		$idUser = isset($_SESSION['user_id']) ? addslashes($_SESSION['user_id']) : null; // usuário que ADICIONA
		$titulo = 'MATÉRIA ' . ((int)$x + 1) . '/' . $arrlength; // adicionamos um título de post com o contador e o total

		$urlFacebook = '';
		$urlInstagram = '';
		$urlLinkedin = '';
		$urlTwitter = '';
		$urlFacebook_bitly = '';
		$urlInstagram_bitly = '';
		$urlLinkedin_bitly = '';
		$urlTwitter_bitly = '';

		// Adicionar o selecionador de publicãções
		$idPublicacao = isset($_POST['idPublicacao']) ? addslashes($_POST['idPublicacao']) : null;;
		
		echo '<h3>Título: ' . $titulo . '</h3>';

			switch ($idMateria) {

				case 4: // Peça Mídia Social
					
					$y++;
					$diasPeca = ($y - 1) * 90 + $materia['prazo'];
					$dataLimite = date('Y-m-d', strtotime($dataRegistroCt. ' + ' . $diasPeca . ' days'));
					$dataExpiracao = '';
					$prazo = 0;

					echo "<strong>" . $y . "ª Matéria Peça Mídia Social</strong><br>";
					echo "<strong> Dias para Peça: " . $diasPeca . "</strong><br><br>";
					break;

				case 5: // Postagens em Redes Sociais (Portal)

					$y = 0;			
					$dataLimite = date('Y-m-d', strtotime($dataRegistroCt. ' + ' . $materia['prazo'] . ' days'));
					$dataExpiracao = date('Y-m-d', strtotime($dataLimite. ' + '.$prazo .' days'));	
					
					echo '<strong>Postagens em Redes Sociais (Portal)</strong><br>';
					echo 'Somar em ' . $dataLimite  . '<br>';	
					echo 'Prazo Contrato: ' . $prazo . '<br>';

					switch ($prazo) {
						case '30':				 	
						case '60':					
						case '90':
							$qtdPosts = 1;	
							break;						
						case '180':
							$qtdPosts = 2;
							break;						
						case '365':
							$qtdPosts = 4;
							break;
					}

					for($xyz = 1; $xyz <= $qtdPosts; $xyz++) {
						
						$y++;
						$diasPost = ($y - 1) * 90 + $materia['prazo'];
						$titulo = 'POST  '. $xyz . '/'. $qtdPosts;
						//$dataPublicacao = date('Y-m-d', strtotime($dataLimite . ' + ' . $diasPost . ' days'));
						$dataPublicacao = date('Y-m-d', strtotime($dataRegistroCt . ' + ' . $diasPost . ' days'));
						$idStatus = 1; // aguardando
						$idMateriaContratada = $lastId + 1;

						echo '<hr>Post '. $xyz . '<br>';
						echo $dataPublicacao . ' ---> ' . $diasPost . ' dias<br>';
						echo 'tituloPost: ' . $titulo. '<br>';
						echo 'dataPublicacao: ' . $dataPublicacao. '<br>';
						echo 'idStatus: ' . $idStatus. '<br>';
						echo 'idMateriaContratada: ' . $idMateriaContratada . ' - OBTER ÚLTIMO POST!! LASTID OK' . '<br><hr>';

						//$mc->addMateriasContratadasPostagensPortal($idMateriaContratada, $titulo, $dataPublicacao, $idStatus);
					}

					break;

				case 18: // Cartão Virtual			
					
					$dataExpiracao = '';
					$prazo = 0;
					
					break;

				case 19: // Anúncio Classificado

					$z++;				

					if ($z >= 2 ) {
						$diasClass = ($z - 1) * 90 + $materia['prazo'];			
					} else {
						$diasClass = $materia['prazo'];
					}

					$dataLimite = date('Y-m-d', strtotime($dataRegistroCt. ' + ' . $diasClass . ' days'));
					$dataExpiracao = date('Y-m-d', strtotime($dataLimite. ' + 90 days'));
					$prazo = 90;

					echo "<strong>" . $z . "ª Matéria Classificado</strong><br>";
					echo "<strong> Dias para Classificado: " . $diasClass . "</strong><br><br>";			

					break;

				case 20: // Postagens em Redes Sociais (Cliente)	
					
					echo "<strong>VAMOS ADICIONAR POSTS CLIENTE</strong><br>";
					echo $diasSelecionados . '<br>';

					$dias = $_POST['diasSelecionados'];
					$datas = explode('||', $dias);					
					$removed = array_pop($datas); // excluindo o último item do array					
					$arrlengthPosts = count($datas);// conta o comprimento do array

					$dataLimite = date('Y-m-d', strtotime($dataRegistroCt. ' + '.$materia['prazo'] .' days'));
					$dataExpiracao = date('Y-m-d', strtotime($dataLimite. ' + '.$prazo .' days'));

					echo $arrlengthPosts . '<br>';					

					for($xp = 0; $xp < $arrlengthPosts; $xp++) {	
						$titulo = 'POST ' . ((int)$xp + 1) . '/' . $arrlengthPosts; // adicionamos um título de post com o contador e o total
						$dataPublicacao = $datas[$xp]; // é o item do array com a data a adicionar na função						
						$idStatus = 1; // aguardando
						$idMateriaContratada = $lastId + 1;

						echo $dataPublicacao . '<br>';
						echo $titulo . '<br>';
						echo $idStatus . '<br>';
						echo 'idMateriaContratada: ' . $idMateriaContratada . ' - OBTER ÚLTIMO POST!! LASTID OK' . '<br><hr>';
						
					//$mc->addMateriasContratadasPostagens($idMateriaContratada, $titulo, $dataPublicacao, $idStatus, $urlFacebook, $urlInstagram, $urlLinkedin, $urlTwitter, $urlFacebook_bitly, $urlInstagram_bitly, $urlLinkedin_bitly, $urlTwitter_bitly);
					}					

					break;

				default:

					$dataLimite = date('Y-m-d', strtotime($dataRegistroCt. ' + '.$materia['prazo'] .' days'));
					$dataExpiracao = date('Y-m-d', strtotime($dataLimite. ' + '.$prazo .' days'));

					break;
			}
		
		$idStatus = 2; // em produção
		$dataProducao = date('Y-m-d', strtotime($dataLimite. ' - 2 days'));	

		echo 'Matéria: '. $materia['materia']. '<br>';
		echo 'idMateria: ' . $idMateria . '<br>'; // é o item do array com a data a adicionar na função
		echo 'Prazo: '. $materia['prazo']. ' dias<br>';
		echo '<strong>Prazo Vigência: '. $prazo. ' dias</strong><br>';	
		echo 'dataProducao: ' . $dataProducao . '<br>';
		echo 'dataLimite: ' . $dataLimite . '<br>';
		echo 'dataExpiracao: ' . $dataExpiracao . '<br>';	
		
		echo "<small><br>DADOS FIXOS: <br>";
		echo 'idContrato: ' . $idContrato. '<br>';
		echo 'dataRegistroCt: ' . $dataRegistroCt. '<br>';
		echo 'dataRegistro: ' . $dataRegistro. '<br>';
		echo 'idPacote: ' . $idPacote. '<br>';
		echo 'empresa: ' . $empresa. '<br>';
		echo 'idUser: ' . $idUser. '<br>';
		echo 'idStatus: ' . $idStatus. '<br>';
		echo 'idUserProducao: ' . $idUserProducao. '<br>';
		echo 'idUserAprovacao: ' . $idUserAprovacao. '<br></small>';
		echo '<hr>'; 

	  	//$mc->addMateriaContratada($idContrato, $idMateria, $idPublicacao, $idStatus, $idUserProducao, $idUserAprovacao, $idPacote, $prazo, $empresa, $obs, $dataProducao, $dataLimite, $dataExpiracao, $dataRegistro, $idUser);
	}
	
	?>

</div>

<div class="container-fluid">
	<div class="alert alert-success">
	    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
		As matérias do pacote foram adicionadas ao contrato da empresa <?php echo $empresa; ?>. Redirecionando para o contrato...
	    <script type="text/javascript">
	        setTimeout(function(){
	        //window.location.href ='../form-edit.php?id='+<?php echo $idContrato; ?>;
	        }, 3000);
	    </script>
	</div>
</div>