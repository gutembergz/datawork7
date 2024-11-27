<?php
session_start();
require_once '../../../init.php';
require '../../../check.php';
require '../../../classes/contratos.class.php';
require '../../../classes/materias.class.php';
$pageTitle = 'Adicionar Postagens em Lote (Portal)';

$ct = new Contratos();
//$mt = new Materias();
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
$idMateriaContratada = isset($_POST['idMateriaContratada']) ? $_POST['idMateriaContratada'] : null;

include (HEADER_TEMPLATE);?>

<div class="container-fluid">
	<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-info-circle"></i> Cadastre aqui postagens múltiplas, <strong>trimestrais,</strong> para publicação nas redes sociais do portal. 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

	<form method='POST'>		
		<div class="form-row">
			<div class="form-group col-lg-6 ">
				<label for="start_date">Data Inicial</label>
				<input class="form-control" type='date' name='start_date' value="<?php echo $start_date; ?>" required>
				<small id="empresaHelp" class="form-text text-muted">A data acima é baseada na data da matéria. Se precisar alterar a data do primeiro post, basta alterar a mesma.</small>
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
			$empresa = $contrato['empresa'];
			$arrlength = 0;	
			$idMateria = 5; // Postagens em Redes Sociais (Portal)
			//$materia = $mt->getMateria($idMateria);
			$prazoCt = $contrato['prazo'];			

			$y = 0;			
			//$dataLimite = date('Y-m-d', strtotime($startDate. ' + ' . $materia['prazo'] . ' days'));
			//$dataLimite = date('Y-m-d', strtotime($contrato['dataRegistro']. ' + ' . $materia['prazo'] . ' days'));
			//$dataExpiracao = date('Y-m-d', strtotime($dataLimite. ' + '.$prazoCt .' days'));

			echo "<strong>Empresa:</strong> " . $empresa .'<br>';

			switch ($prazoCt) {
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

				$datas = '';

				for($xyz = 1; $xyz <= $qtdPosts; $xyz++) {

					$y++;
					$diasPost = ($y - 1) * 90;
					$dataPublicacao = date('Y-m-d', strtotime($startDate . ' + ' . $diasPost . ' days'));
					$dataPublicacao2 = date('d/m/Y', strtotime($startDate . ' + ' . $diasPost . ' days'));					

					$datas.= $dataPublicacao;
					$datas.= '||';

					echo '<li class="list-group-item">' . $xyz . 'ª Publicação: ' . $dataPublicacao2 . '</li>';
				}

			echo '</ul>';			

			?>

			<div class="form-group mt-3">
				<p><strong>Total de Itens: </strong><?php echo $qtdPosts; ?></p>
	  		</div>

			<?php 
			// aqui começa a segunda parte:
			// no submit de Cadastrar Postagens, enviar para uma segunda página;
			// para cada foreach criado na data, fazer um addMateriasContratadasPostagens
			?>
	  		<div class="form-group">
				<form method="POST" action="form-posts-portal-lote-results.php">
					<input class="form-control" type='hidden' name='idMateriaContratada' value="<?php echo $idMateriaContratada; ?>">
					<input class="form-control" type='hidden' name='idContrato' value="<?php echo $contrato['id']; ?>">
					<input class="form-control" type='hidden' name='empresa' value="<?php echo $empresa; ?>">
					<input class="form-control" type='hidden' name='diasSelecionados' value="<?php echo $datas;?>"> 					

					<input class="btn btn-danger" type='submit' name='submit' value="Cadastrar Postagens" <?php echo ($qtdPosts == '0') ? 'disabled' : '' ?> onclick="return confirm('Tem certeza de que deseja cadastrar estas postagens? Você será redirecionado para a matéria em seguida.');">
				</form>	  			
	  		</div>
			<?php  
		}
	?>

</div>

<?php include (FOOTER_TEMPLATE);?>