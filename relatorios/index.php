<?php
session_start();
require '../init.php';
require '../check.php';
$pageTitle = 'Relatórios';

require '../classes/campanhas.class.php';
require '../classes/materias.class.php';
require '../classes/publicacoes.class.php';
require '../classes/status.class.php';
$c = new Campanhas();
$mt = new Materias();
$p = new Publicacoes();
$st = new Status();
$campanhas = $c->getCampanhas();
$materias = $mt->getMaterias();
$publicacoes = $p->getPublicacoes();
$statuses = $st->getStatus();

?>

<?php include (HEADER_TEMPLATE);?>

<div class="container-fluid">

	<ul class="nav nav-tabs mb-3" id="tabDadosCliente" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="contratos-tab" data-toggle="tab" href="#contratos" role="tab" aria-controls="contratos" aria-selected="true">Relatório de Contratos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" id="clientes-tab" data-toggle="tab" href="#clientes" role="tab" aria-controls="clientes" aria-selected="false">Relatório de Clientes</a>
        </li>        
    </ul>

    <div class="tab-content" id="tabDadosContratoConteudo">
    	<div class="tab-pane fade show active" id="contratos" role="tabpanel" aria-labelledby="contratos-tab">    		
			<form method="POST" action="contratos.php" target="print_popup" onsubmit="window.open('about:blank','print_popup','width=1000,height=800');"> 
				<div id="accordion">
					<div class="card mb-2">
						<div class="card-header" id="headingOne">
							<h5 class="mb-0">Dados Gerais</h5>
						</div>
						<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" >
							<div class="card-body">
						    	<div class="form-row">
								<div class="form-group col-md-6">
								    <label for="idCampanha">Campanha</label>	            
						            <select class="form-control campanha-select2" name="idCampanha[]" multiple="multiple">
						                <option value="">Selecionar Campanha</option>
						                <?php foreach ($campanhas as $campanha): ?>
						                	<option value="<?php echo $campanha['id']?>"> <?php echo $campanha['campanha']; ?></option>
						                <?php endforeach; ?>	                
						            </select>
								</div>
								
								<div class="form-group col-md-6">
								    <label for="idStatus">Status de Contrato</label>
						            <select class="form-control status-select2" name="idStatus[]" multiple="multiple">
										<option value="">Selecione Status</option>
					                    <?php foreach($statuses as $status): ?>
					                        <option value="<?php echo $status['id'];?>"> <?php echo $status['status'];?></option>
					                    <?php endforeach;?>
					                </select>
								</div>			
							</div>

							<div class="form-row">
								<div class="form-group col-md-3">
									<label for="dataInicial">Data Inicial <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Data inicial do cadastro dos contratos."></i></label>
									<input class="form-control" type="date" name="dataInicial" id="dataInicial">
								</div>

								<div class="form-group col-md-3">
									<label for="dataFinal">Data Final <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Data final do cadastro dos contratos."></i></label>
									<input class="form-control" type="date" name="dataFinal" id="dataFinal">
								</div>

								<div class="form-group col-md-3">
									<label for="contratoInicial">Contrato Inicial <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Defina o intervalo inicial da numeração de contratos."></i></label>
									<input class="form-control" type="number" placeholder="0000001" name="contratoInicial" id="contratoInicial">
								</div>

								<div class="form-group col-md-3">
									<label for="contratoFinal">Contrato Final <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Defina o intervalo final da numeração de contratos."></i></label>
									<input class="form-control" type="number" placeholder="0001999" name="contratoFinal" id="contratoFinal">
								</div>
							</div>
							</div>
						</div>
					</div>
					<div class="card mb-2">
					    <div class="card-header" id="headingTwo">
							<h5 class="mb-0">Período de Vigência</h5>
					    </div>
					    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo">
							<div class="card-body">
					        	<div class="form-row">
									<div class="form-group col-md-6">
										<label for="dataExpiracaoInicial">Data de Expiração Inicial <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Data inicial de expiração dos contratos."></i></label>
										<input class="form-control" type="date" name="dataExpiracaoInicial" id="dataExpiracaoInicial">
									</div>

									<div class="form-group col-md-6">
										<label for="dataExpiracaoFinal">Data de Expiração Final <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Data final de expiração dos contratos."></i></label>
										<input class="form-control" type="date" name="dataExpiracaoFinal" id="dataExpiracaoFinal">
									</div>
								</div>
					      	</div>
					    </div>
					</div>
					<div class="card mb-2">
						<div class="card-header" id="headingThree">
				      		<h5 class="mb-0">Opções de Matéria</h5>
				    	</div>
				    	<div id="collapseThree" class="collapse show" aria-labelledby="headingThree">
							<div class="card-body">
					        	<div class="form-row">
									<div class="form-group col-md-6">
									    <label for="idMateria">Matéria</label>			            
							            <select class="form-control idMateria-select2" name="idMateria[]" multiple="multiple">
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
									<div class="form-group col-md-6">
							            <label for="idStatusMateria">Status de Matérias</label>
							            <select class="form-control status-select2" name="idStatusMateria[]" multiple="multiple">
											<option value="">Selecione Status</option>
						                    <?php foreach($statuses as $status): ?>
						                        <option value="<?php echo $status['id'];?>"> <?php echo $status['status'];?></option>
						                    <?php endforeach;?>
						                </select>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="dataProducaoInicial">Data de Produção Inicial <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Data inicial para produção das matérias."></i></label>
										<input class="form-control" type="date" name="dataProducaoInicial" id="dataProducaoInicial">
									</div>
									<div class="form-group col-md-6">
										<label for="dataProducaoFinal">Data de Produção Final <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Data final para produção das matérias."></i></label>
										<input class="form-control" type="date" name="dataProducaoFinal" id="dataProducaoFinal">
									</div>
								</div>
							</div>
				    	</div>
					</div>
				</div>
				<div class="form-group">
					<input class="btn btn-primary" type="submit" value="Gerar Relatório">
				</div>
			</form>
    	</div>
    	<div class="tab-pane fade" id="clientes" role="tabpanel" aria-labelledby="clientes-tab">
			<p>Aqui podemos pesquisar por endereço para obter um raio de busca através do Google Maps.</p>
			<p>Precisamos exibir o mapa. Onde? No relatório ou apenas o mapa?</p>
			<p>Ou, uma lista simples das empresas?</p>
        </div>        
    </div>

</div>

<?php include (FOOTER_TEMPLATE);?>

<script>    
    $(document).ready(function() { // transforma os select em select2
        $('.campanha-select2, .status-select2, .idMateria-select2').select2({ 
        	width: '100%',
            language: "pt-BR",
            theme: 'bootstrap4',
            placeholder: "Selecione",
            tags: true,
            allowClear: true,
            tokenSeparators: [',']
        });
    });
</script>
