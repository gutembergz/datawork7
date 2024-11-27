<?php
session_start();
require_once '../../../init.php';
require '../../../check.php';
require '../../../classes/contratos.class.php';
$pageTitle = 'Adicionar Postagens em Lote (Cliente)';

$ct = new Contratos();
$contrato = $ct->getContrato($_POST['idContrato']);

// aqui recebemos o id do contrato através do POST - para adição da nova matéria
if (isset($_POST['idContrato'])) {
    
    $parentPage = 'Contrato '. $contrato['nContrato'] . ' - ' . $contrato['empresa']; // breadcrumb
    $parentLink = '../form-edit.php?id=' . $contrato['id']; // breadcrumb

} else {
    header("Location: ../index.php");
    exit;
}
    
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : null;
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : null;
$diasSemana = isset($_POST['diasSemana']) ? $_POST['diasSemana'] : array(); // se não estiver preenchido, será criado um array vazio
$idMateriaContratada = isset($_POST['idMateriaContratada']) ? $_POST['idMateriaContratada'] : null;

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
        <i class="fa fa-info-circle"></i> Cadastre aqui postagens múltiplas, <strong>semanais,</strong> para publicação nas redes sociais do cliente. Selecione as datas, dias da semana e clique em Gerar Calendário. 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

	<form method='POST'>		
		<div class="form-row">
			<div class="form-group col-sm-6">
				<label for="start_date">Data Inicial</label>
				<input class="form-control" type='date' name='start_date' id='start_date' value="<?php echo $start_date; ?>" required>
			</div>
			<div class="form-group col-sm-6">
				<label for="end_date">Data Final</label>
	  			<input class="form-control" type='date' name='end_date' id='end_date' value="<?php echo $end_date; ?>" required>
	  		</div>
		</div>
		<div class="form-row">
			<div class="form-group col">
				<label for="diasSemana">Selecione os dias da semana a programar</label>
				<select class="custom-select" name="diasSemana[]" id="diasSemana" multiple="multiple" size='7' required>
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
		<div class="form-group">
			<input type="hidden" name="idContrato" value="<?php echo $contrato['id']; ?>">
			<input type="hidden" name="idMateriaContratada" value="<?php echo $idMateriaContratada; ?>">
	  		<input class="btn btn-primary" type='submit' name='submit' value="Gerar Calendário">
	  	</div>
	</form>	

	<?php
	
		if(isset($_POST['submit'])) {

			$startDate = $start_date;
			$endDate = $end_date;

			// Convert to UNIX timestamps
			$currentTime = strtotime($startDate);
			$endTime = strtotime($endDate) + 12*60*60;	// acrescentamos mais 12 horas para capturar o último dia. será por conta do horário de verão?		
			$empresa = $contrato['empresa'];

			echo "<strong>Empresa:</strong> " . $empresa .'<br>';
			echo "<strong>Data Inicial:</strong> ".utf8_encode(strftime('%A, %d de %B de %Y', $currentTime)).'<br>';
			echo "<strong>Data Final:</strong> ".utf8_encode(strftime('%A, %d de %B de %Y', $endTime)).'<br>';

			// verifica a diferença em segundos entre as duas datas e divide pelo número de segundos que um dia possui
			$qtdDias = ($endTime - $currentTime) /86400;

			//$qtdDias = $qtdDias+1; // adiciona mais um dia para calcular dias inteiros

			// caso a data 2 seja menor que a data 1
			if($qtdDias < 0) {
				$endTime = $endTime * -1;
			}
			
			echo "<strong>Dias Selecionados:</strong> " . round($qtdDias) . " dias.<br><br>";
			
			// efetua o loop até atingir o último dia
			$result = array();

			while ($currentTime <= $endTime) {

				// se alguma das datas conferir com o array do select, adiciona ao array
				if (date('N', $currentTime) == $diasSemana0 || (date('N', $currentTime) == $diasSemana1) || (date('N', $currentTime) == $diasSemana2) || (date('N', $currentTime) == $diasSemana3) || (date('N', $currentTime) == $diasSemana4)  || (date('N', $currentTime) == $diasSemana5) ||  (date('N', $currentTime) == $diasSemana6)) {
			    	
			    	// adiciona ao array
					$result[] = array (array(date('Y-m-d', $currentTime), utf8_encode(strftime('%d/%m/%Y (%A)', $currentTime))));
				}

				$currentTime = strtotime('+1 day', $currentTime);				
			}

			// Mostra o resultado
			$arrlength = count($result);


			echo '<ul class="list-group">';

				for($x = 0; $x < $arrlength; $x++) {
					//echo ($x+1) . "ª Publicação: " . $result[$x][0][1] . "<br>";
					echo '<li class="list-group-item">' . ($x+1) . "ª Publicação: " . $result[$x][0][1] . '</li>';	
				} 

			echo '</ul>';

			?>


			<div class="form-group mt-3">
				<p><strong>Total de Itens: </strong><?php echo $arrlength; ?></p>
	  		</div>

			<?php 
			// aqui começa a segunda parte:
			// no submit de Cadastrar Postagens, enviar para uma segunda página;
			// para cada foreach criado na data, fazer um addMateriasContratadasPostagens
			?>
	  		<div class="form-group">
				<form method="POST" action="form-posts-cliente-lote-results.php">
					<input class="form-control" type='hidden' name='idMateriaContratada' value="<?php echo $idMateriaContratada; ?>">
					<input class="form-control" type='hidden' name='idContrato' value="<?php echo $contrato['id']; ?>">
					<input class="form-control" type='hidden' name='empresa' value="<?php echo $empresa; ?>"> 
					<input class="form-control" type='hidden' name='diasSelecionados' value="<?php for($x = 0; $x < $arrlength; $x++) {echo $result[$x][0][0] . "||";}?>">
					<input class="btn btn-danger" type='submit' name='submit' value="Cadastrar Postagens" <?php echo ($arrlength == '0') ? 'disabled' : '' ?> onclick="return confirm('Tem certeza de que deseja cadastrar estas postagens? Você será redirecionado para a matéria em seguida.');">
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
	        placeholder: "Selecione os dias",
            allowClear: true,
	        });
	});
</script>