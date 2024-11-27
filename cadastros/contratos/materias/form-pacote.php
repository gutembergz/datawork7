<?php
session_start();
require_once '../../../init.php';
require '../../../check.php';
require '../../../classes/contratos.class.php';
require '../../../classes/pacotes.class.php';
require '../../../classes/materias.class.php';
$pageTitle = 'Adicionar Pacote ao Contrato';

$ct = new Contratos();
$pc = new Pacotes();
$mt = new Materias();

$contrato = $ct->getContrato($_POST['idContrato']);
$pacotes = $pc->getPacotes();

// aqui recebemos o id do contrato através do POST - para adição da nova matéria
if (isset($_POST['idContrato'])) {
    
    $parentPage = 'Contrato '. $contrato['nContrato'] . ' - ' . $contrato['empresa']; // breadcrumb
    $parentLink = '../form-edit.php?id=' . $contrato['id']; // breadcrumb

} else {
    header("Location: ../index.php");
    exit;
}

$id = isset($_POST['selectPacote']) ? $_POST['selectPacote'] : null; // id do Pacote
$idUserProducao = isset($_POST['idUserProducao']) ? $_POST['idUserProducao'] : null;
$idUserAprovacao = isset($_POST['idUserAprovacao']) ? $_POST['idUserAprovacao'] : null;
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : null;
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : null;
$diasSemana = isset($_POST['diasSemana']) ? $_POST['diasSemana'] : array(); // se não estiver preenchido, será criado um array vazio
$idMateriaContratada = isset($_POST['idMateriaContratada']) ? $_POST['idMateriaContratada'] : null;
$idPublicacaoSel = isset($_POST['idPublicacao']) ? $_POST['idPublicacao'] : array();

if (isset($_POST['idPublicacao'])) {
    $idPublicacao = '';
    foreach ($_POST['idPublicacao'] as $value) {
        if ($idPublicacao!='') $idPublicacao.=' | ';
        $idPublicacao.= $value;
        } 
} else {
    $idPublicacao = null;
}            

$arrlengthPosts = '';

// captura o array da seleção de dias a programar
$diasSemana0 = isset($diasSemana[0]) ? $diasSemana[0] : null;
$diasSemana1 = isset($diasSemana[1]) ? $diasSemana[1] : null;
$diasSemana2 = isset($diasSemana[2]) ? $diasSemana[2] : null;
$diasSemana3 = isset($diasSemana[3]) ? $diasSemana[3] : null;
$diasSemana4 = isset($diasSemana[4]) ? $diasSemana[4] : null;
$diasSemana5 = isset($diasSemana[5]) ? $diasSemana[5] : null;
$diasSemana6 = isset($diasSemana[6]) ? $diasSemana[6] : null;

include (HEADER_TEMPLATE);?>

<div class="container-fluid">
	<div class="alert alert-primary alert-dismissible fade show" role="alert">
        <i class="fa fa-info-circle"></i> Cadastre aqui pacotes de matérias para o contrato atual. 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>    

	<form method='POST'>

		<div class="form-row">
			<div class="form-group col">
				<label for="selectPacote">Selecione o Pacote a Adicionar</label>				
				<select class="form-control" name="selectPacote" id="selectPacote" onchange="alteraPacote(this)" required>
					<option value="">Selecione um Pacote</option>
					<?php foreach ($pacotes as $pacote): ?>
						<option value="<?php echo ($pacote['id'])?>"<?php echo ($pacote['id']==$id)?'selected':''; ?> data-tipopacote="<?php echo $pacote['tipoPacote'];?>"><?php echo $pacote['pacote'];?></option>
					<?php endforeach; ?>					
				</select>
			</div>			
		</div>

		<div class="form-row">
			<div class="form-group col-lg-6 col-md-12">
                <label for="idUserProducao">Atribuir Usuário de Produção <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Usuário atribuído à produção desta matéria."></i></label>
                <select class="form-control" name="idUserProducao" id="idUserProducao" required>
                    <option value="">Selecione Usuário</option>
                    <?php 
                    require '../../../classes/usuarios.class.php';
                    $u = new Usuarios();
                    $usuarios = $u->getUsuariosByRole();

                    foreach($usuarios as $usuario): ?>
                        <option value="<?php echo $usuario['id'];?>"<?php echo ($usuario['id']==$idUserProducao)?'selected':''; ?>><?php echo $usuario['name'];?></option>
                    <?php endforeach;?>

                </select>
            </div>

            <div class="form-group col-lg-6 col-md-12">
                <label for="idUserAprovacao">Atribuir Usuário de Aprovação <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Usuário atribuído à aprovação desta matéria."></i></label>
                <select class="form-control" name="idUserAprovacao" id="idUserAprovacao" required>
                    <option value="">Selecione Usuário</option>
                    <?php 
                    
                    foreach($usuarios as $usuario): ?>
                        <option value="<?php echo $usuario['id'];?>"<?php echo ($usuario['id']==$idUserAprovacao)?'selected':''; ?>><?php echo $usuario['name'];?></option>
                    <?php endforeach;?>

                </select>
            </div>                
		</div>

		<div class="form-row">			
            <div class="form-group col-lg-12 col-md-12">
                <label for="idPublicacao">Publicação</label>
                <select class="form-control publicacao-select2" name="idPublicacao[]" id="idPublicacao" multiple="multiple" required>                                            
                    <?php 
                        require '../../../classes/publicacoes.class.php';
                        $p = new Publicacoes();
                        $publicacoes = $p->getPublicacoes();
                        foreach($publicacoes as $publicacao): ?>
                            
                            <option value="<?php echo $publicacao['id'];?>"<?php echo in_array($publicacao['id'], $idPublicacaoSel) ? "selected":"" ?>><?php echo $publicacao['publicacao']; ?></option>
                    <?php endforeach;?>                                   
                </select>
            </div>                                    
        </div>        

		<div id="postsPacote" style="display: none">

			<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="start_date">Data Inicial</label>
					<input class="form-control" type='date' name='start_date' id='start_date' value="<?php echo $start_date; ?>" required disabled>
				</div>
				<div class="form-group col-sm-6">
					<label for="end_date">Data Final</label>
		  			<input class="form-control" type='date' name='end_date' id='end_date' value="<?php echo $end_date; ?>" required disabled>
		  		</div>
			</div>

			<div class="form-row">
				<div class="form-group col">
					<label for="diasSemana">Selecione os dias da semana a programar</label>
					<select class="custom-select" name="diasSemana[]" id="diasSemana" multiple="multiple" size='7' required disabled>
						<option value="7" <?php echo in_array("7", $diasSemana) ? "selected":"";?>>Domingo</option>
						<option value="1" <?php echo in_array("1", $diasSemana) ? "selected":"";?>>Segunda-feira</option>
						<option value="2" <?php echo in_array("2", $diasSemana) ? "selected":"";?>>Terça-feira</option>
						<option value="3" <?php echo in_array("3", $diasSemana) ? "selected":"";?>>Quarta-feira</option>
						<option value="4" <?php echo in_array("4", $diasSemana) ? "selected":"";?>>Quinta-feira</option>
						<option value="5" <?php echo in_array("5", $diasSemana) ? "selected":"";?>>Sexta-feira</option>
						<option value="6" <?php echo in_array("6", $diasSemana) ? "selected":"";?>>Sábado</option>	
					</select>
				</div>
			</div>

		</div>

		<div class="form-group">
			<input type="hidden" name="idContrato" value="<?php echo $contrato['id']; ?>">
	  		<input class="btn btn-primary" type='submit' name='submit' value="Prévia das Matérias">
	  	</div>

	</form>	

	<?php
	
		if(isset($_POST['submit'])) {
				
			$empresa = $contrato['empresa'];
			$prazo = $contrato['prazo'];
			$dataRegistro = strtotime($contrato['dataRegistro']);

			echo "<strong>Empresa:</strong> " . $empresa .'<br>';
			echo "<strong>Prazo do Contrato:</strong> " . $prazo .' dias<br>';
			echo "<strong>Data do Contrato:</strong> " . date('d/m/Y',$dataRegistro) .'<br><br>';

			//obtemos o id do pacote
			$pacotesSel = $pc->getPacote($id);
			
			// capturamos os tipos de matérias contidas no mesmo
			$tiposMaterias = $pacotesSel['tiposMaterias'];

			if ($tiposMaterias !== null) {

				$tipoMateria = $tiposMaterias;
				$idsMaterias = explode(', ', $tipoMateria);

				// checar o prazo e definir a quantidade de peças: 30, 60, 90, 180 dias ou 365?
				switch ($prazo) {
					case '30':
					case '60':
					case '90':
						$qtdPecas = $pacotesSel['qtdPecas3Meses'];
						// adiciona ao array a quantidade de peças extras do pacote
						for($x = 1; $x < $qtdPecas; $x++) {
							$idsMaterias[] = 4;
						}					
						
						$qtdClass = $pacotesSel['qtdClass3Meses'];
						// adiciona ao array a quantidade de classificados do pacote
						for($x = 1; $x < $qtdClass; $x++) {
							$idsMaterias[] = 19;
						}

						break;

					case '180':
						$qtdPecas = $pacotesSel['qtdPecas6Meses'];
						for($x = 1; $x < $qtdPecas; $x++) {
							$idsMaterias[] = 4;
						}

						$qtdClass = $pacotesSel['qtdClass6Meses'];
						for($x = 1; $x < $qtdClass; $x++) {
							$idsMaterias[] = 19;
						}

						break;						

					case '365':
						$qtdPecas = $pacotesSel['qtdPecas12Meses'];					
						for($x = 1; $x < $qtdPecas; $x++) {
							$idsMaterias[] = 4;
						}

						$qtdClass = $pacotesSel['qtdClass12Meses'];
						for($x = 1; $x < $qtdClass; $x++) {
							$idsMaterias[] = 19;
						}

						break;
					
					default:
						$qtdPecas = $pacotesSel['qtdPecas3Meses'];
						for($x = 1; $x < $qtdPecas; $x++) {
							$idsMaterias[] = 4;
						}

						$qtdClass = $pacotesSel['qtdClass3Meses'];
						for($x = 1; $x < $qtdClass; $x++) {
							$idsMaterias[] = 19;
						}

						break;
				}
				
				// ordena o array
				sort ($idsMaterias);

				echo '<h3>Matérias a Adicionar:</h3>';

				echo '<ul class="list-group">';

					$y = 0;
					$z = 0;

					foreach ($idsMaterias as $idMateria) {
						// obtemos a matéria específica para exibir o nome da mesma
						$materia = $mt->getMateria($idMateria);

						echo '<li class="list-group-item"><strong>'. $materia['materia'] . '</strong> - Prazo para Produção: ' . $materia['prazo'] . ' dias - ';
						
						switch ($idMateria) {

							case 4: // Peças de Mídia Social
								$y++;
								$diasPeca = ($y - 1) * 90 + $materia['prazo'];
								$dataLimite = date('d/m/Y', strtotime($contrato['dataRegistro']. ' + ' . $diasPeca . ' days'));								
								echo $dataLimite;
							break;

							case 19: // Anúncio Classificado
								$z++;
								$diasClass = ($z - 1) * 90 + $materia['prazo'];
								$dataLimite = date('d/m/Y', strtotime($contrato['dataRegistro']. ' + ' . $diasClass . ' days'));								
								echo $dataLimite;
							break;

							default:
								echo date('d/m/Y', strtotime($contrato['dataRegistro']. ' + ' . $materia['prazo'] . ' days'));
							break;

						}
						
							switch ($idMateria) {

								case 5: // Postagens em Redes Sociais (Portal)

									$y = 0;			
									$dataLimite = date('Y-m-d', strtotime($contrato['dataRegistro']. ' + ' . $materia['prazo'] . ' days'));
									$dataExpiracao = date('Y-m-d', strtotime($dataLimite. ' + '.$prazo .' days'));

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

									echo '<ul class="list-group mt-2">';

										for($xyz = 1; $xyz <= $qtdPosts; $xyz++) {
											$y++;
											$diasPost = ($y - 1) * 90 + $materia['prazo'];
											$dataPublicacao = date('d/m/Y', strtotime($contrato['dataRegistro'] . ' + ' . $diasPost . ' days'));

											echo '<li class="list-group-item">' . $xyz . 'ª Publicação: ' . $dataPublicacao . '</li>';	
										}

									echo '</ul>';

								break;

								case 20: // Postagens em Redes Sociais (Cliente)

									$startDate = $start_date;
									$endDate = $end_date;

									// Convert to UNIX timestamps
									$currentTime = strtotime($startDate);
									$endTime = strtotime($endDate) + 12*60*60;	// acrescentamos mais 12 horas para capturar o último dia. será por conta do horário de verão?		

									echo "<br><strong><small>Data Inicial:</strong> ".utf8_encode(strftime('%A, %d de %B de %Y', $currentTime)).'</small><br>';
									echo "<strong><small>Data Final:</strong> ".utf8_encode(strftime('%A, %d de %B de %Y', $endTime)).'</small><br>';

									// verifica a diferença em segundos entre as duas datas e divide pelo número de segundos que um dia possui
									$qtdDias = ($endTime - $currentTime) /86400;

									//$qtdDias = $qtdDias+1; // adiciona mais um dia para calcular dias inteiros

									// caso a data 2 seja menor que a data 1
									if($qtdDias < 0) {
										$endTime = $endTime * -1;
									}
									
									echo "<strong><small>Dias Selecionados:</strong> " . round($qtdDias) . " dias</small><br>";
									
									// efetua o loop até atingir o último dia
									$result = array();
									
									echo '<ul class="list-group mt-2">';

										while ($currentTime <= $endTime) {

											// se alguma das datas conferir com o array do select, adiciona ao array
											if (date('N', $currentTime) == $diasSemana0 || (date('N', $currentTime) == $diasSemana1) || (date('N', $currentTime) == $diasSemana2) || (date('N', $currentTime) == $diasSemana3) || (date('N', $currentTime) == $diasSemana4)  || (date('N', $currentTime) == $diasSemana5) ||  (date('N', $currentTime) == $diasSemana6)) {
										    	
										    	// adiciona ao array
												$result[] = array (array(date('Y-m-d', $currentTime), utf8_encode(strftime('%d/%m/%Y (%A)', $currentTime))));
											}

											$currentTime = strtotime('+1 day', $currentTime);				
										}

										// Mostra o resultado
										$arrlengthPosts = count($result);									

										for($x = 0; $x < $arrlengthPosts; $x++) {

											echo '<li class="list-group-item">' . ($x+1) . "ª Publicação: " . $result[$x][0][1] . '</li>';	
										} 

									echo '</ul>';									

								break;
							}

						echo '</li>';
					} 

				echo '</ul>';
				
				$arrlength = count($idsMaterias); // Conta o resultado
				
			} else {

				$arrlength = 0;
				echo "Não há matérias definidas para este pacote.";
			}

			?>
				<div class="form-group mt-3">
					<p><strong>Total de Matérias: </strong><?php echo $arrlength; ?></p>
		  		</div>		  		

			<?php 
			// aqui começa a segunda parte:
			// no submit de Cadastrar Postagens, enviar para uma segunda página;
			// para cada foreach criado na data, fazer um addMateriasContratadasPostagens
			?>

			<?php $idContrato = $contrato['id']; ?>

	  		<div class="form-group">
				
				<form method="POST" action="form-pacote-results.php">
				<!-- <form method="POST" action="form-pacote-results.php" target="pacotes_popup" onsubmit="window.open('about:blank','pacotes_popup','width=1000,height=800');"> -->
					<input class="form-control" type='hidden' name='idPacote' value="<?php echo $id; ?>">
					<input class="form-control" type='hidden' name='idContrato' value="<?php echo $idContrato; ?>">
					<input class="form-control" type='hidden' name='empresa' value="<?php echo $empresa; ?>">
					<input class="form-control" type='hidden' name='idsMaterias' value="<?php print join(', ', $idsMaterias); // reunifico o array, adicionando as peças de mídia social extras ?>">
					<input class="form-control" type='hidden' name='idPublicacao' value="<?php echo $idPublicacao; ?>">
					<input class="form-control" type='hidden' name='diasSelecionados' value="<?php for($x = 0; $x < $arrlengthPosts; $x++) {echo $result[$x][0][0] . "||";}?>">
					<input class="form-control" type='hidden' name='idUserProducao' value="<?php echo $idUserProducao; ?>">
					<input class="form-control" type='hidden' name='idUserAprovacao' value="<?php echo $idUserAprovacao; ?>">
					<input class="form-control" type='hidden' name='dataRegistro' value="<?php echo date('Y-m-d',$dataRegistro); ?>">
					<input class="form-control" type='hidden' name='prazoContrato' value="<?php echo $prazo; ?>">
					<input class="btn btn-danger" type='submit' name='submit' value="Cadastrar Matérias" <?php echo ($arrlength == '0') ? 'disabled' : '' ?> onclick="return confirm('Tem certeza de que deseja cadastrar estas matérias? Você será redirecionado para o contrato em seguida.');">
				</form>	  			
	  		</div>
			<?php  
		}
	?>

</div>

<?php include (FOOTER_TEMPLATE);?>

<script>	
	$(document).ready(function() { // transforma os select em select2
	    $('.custom-select').select2({ 
	        width: '100%',  
	        language: "pt-BR",
	        theme: 'bootstrap4',
	        placeholder: "Selecione os Dias",
            allowClear: true,
	        });
	});
</script>

<script>    
    $(document).ready(function() { // transforma os select em select2
        $('.publicacao-select2').select2({ 
            width: '100%',
            language: "pt-BR",
            theme: 'bootstrap4',
            placeholder: "Selecione Publicações",
            tags: true,
            allowClear: true,
            tokenSeparators: [',']
        });
    });
</script>