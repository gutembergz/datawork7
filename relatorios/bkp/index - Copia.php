<?php
session_start();
require_once '../init.php';
require '../check.php';
$pageTitle = 'Relatórios';

require '../classes/campanhas.class.php';
require '../classes/materias.class.php';
require '../classes/publicacoes.class.php';
$c = new Campanhas();
$mt = new Materias();
$p = new Publicacoes();
$campanhas = $c->getCampanhas();
$materias = $mt->getMaterias();
$publicacoes = $p->getPublicacoes();

?>

<?php include (HEADER_TEMPLATE);?>

<div class="container-fluid"> 
	<form method="get" action="relatorio.php"> 

		<div class="form-row">
			<div class="form-group col-md-12">
			    <label for="idCampanha">Campanha</label>	            
	            <select class="form-control" name="idCampanha">
	                <option value="">Selecionar Campanha</option>
	                <?php foreach ($campanhas as $campanha): ?>
	                	<option value="<?php echo $campanha['id']?>"> <?php echo $campanha['campanha']; ?></option>
	                <?php endforeach; ?>	                
	            </select>
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-4">
			    
			</div>
			<div class="form-group col-md-4">
			    <label for="idStatus">Status</label>
	            <select class="form-control" name="idStatus">
	                <option value="">Selecionar Status</option>
	                <option value="1">Vigente</option>
	                <option value="2">Expirado</option>
	            </select>
			</div>

			<div class="form-group col-md-4">
			    <label for="idPublicacao">Publicação</label>
	            <select class="form-control" name="idPublicacao">
	                <option value="">Selecionar Publicação</option>
	                <?php foreach ($publicacoes as $publicacao): ?>
	                	<option value="<?php echo $publicacao['id']?>"> <?php echo $publicacao['publicacao']; ?></option>
	                <?php endforeach; ?>
	            </select>
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="dataInicial">Data Inicial</label>
				<input class="form-control" type="date" name="dataInicial" id="dataInicial">
			</div>

			<div class="form-group col-md-3">
				<label for="dataFinal">Data Final</label>
				<input class="form-control" type="date" name="dataFinal" id="dataFinal">
			</div>

			<div class="form-group col-md-3">
				<label for="contratoInicial">Contrato Inicial <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Defina o intervalo inicial da numeração de contratos."></i></label>
				<input class="form-control" type="number" placeholder="2000001" name="contratoInicial" id="contratoInicial">
			</div>

			<div class="form-group col-md-3">
				<label for="contratoFinal">Contrato Final <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Defina o intervalo final da numeração de contratos."></i></label>
				<input class="form-control" type="number" placeholder="2001999" name="contratoFinal" id="contratoFinal">
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-4">
			    <label for="idMateria">Matéria</label>
	            <select class="form-control" name="idMateria" id="idMateria">
	                <option value="">Selecione Matéria</option>
	                    <?php 

	                    foreach ($materias as $materia) {
	                        $groups[$materia['tipoMateria']][$materia['id']] = $materia['materia'];
	                    }
	                        foreach($groups as $label => $opt): ?>
	                            <optgroup label="<?php echo $label; ?>">
	                        <?php foreach ($opt as $id => $name): ?>
	                            <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
	                        <?php endforeach; ?>
	                            </optgroup>
	                        <?php endforeach;?>
	            </select>
			</div>
			<div class="form-group col-md-4">
			    <label for="idStatus">Status</label>
	            <select class="form-control" name="idStatus">
	                <option value="">Selecionar Status</option>
	                <option value="1">Vigente</option>
	                <option value="2">Expirado</option>
	            </select>
			</div>

			<div class="form-group col-md-4">
			   
			</div>
		</div>
      
		<div class="form-row">
			<div class="form-group">
				<!-- botões -->
				<input class="btn btn-primary" type="submit" value="Gerar Relatório">
			</div>
		</div>

	</form>        
</div>

<?php include (FOOTER_TEMPLATE);?>