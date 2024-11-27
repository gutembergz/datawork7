<?php
require_once '../../../init.php';
require '../../../check.php';
?>

<div class="form-row mb-2">
    <div class="col">
        <div class="form-row">
           <div class="form-group col-md-6">
                <label>Data de Início</label>
                <input type="date" name="dataInicio" id="dataInicio" class="form-control" value="<?php echo $materiaContratada['dataInicio']== 0 ? '' : date("Y-m-d", strtotime($materiaContratada['dataInicio']));?>"/>
            </div>
            <div class="form-group col-md-6">
                <label>Data de Término <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Esta data não pode ultrapassar a data do contrato. Como ajustar?"></i></label>
                <input type="date" name="dataTermino" id="dataTermino" class="form-control" value="<?php echo $materiaContratada['dataTermino']== 0 ? '' : date("Y-m-d", strtotime($materiaContratada['dataTermino']));?>"/>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6"> 
                <label for="orcamento">Orçamento Mensal</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">R$</span>
                    </div>
                    <input class="form-control" type="text" name="orcamento" id="orcamento" value="<?php echo number_format($materiaContratada['orcamento'], 2, ',', '.') ; ?>" maxlength="15"/>
                </div>
            </div>

            <div class="form-group col-md-6">
                <label for="locais">Localidades</label>
                <input type="text" name="locais" id="locais" class="form-control" value="<?php echo $materiaContratada['locais']?>"/>
            </div>                                    
        </div>

        <div class="form-row">
            <div class="form-group col-md-6"> 
                <label for="diasSemana">Dias da Semana</label>
                <select class="form-control" name="diasSemana" id="diasSemana">
                    <option value="">Selecionar Dias</option>
                    <option value="1"<?php echo $materiaContratada['diasSemana']=='1'?'selected':'';?>>Todos os dias</option>
                    <option value="2"<?php echo $materiaContratada['diasSemana']=='2'?'selected':'';?>>De segunda a sexta</option>
                    <option value="3"<?php echo $materiaContratada['diasSemana']=='3'?'selected':'';?>>Sábados e domingos</option>
                    <option value="4"<?php echo $materiaContratada['diasSemana']=='4'?'selected':'';?>>Segundas-feiras</option>
                    <option value="5"<?php echo $materiaContratada['diasSemana']=='5'?'selected':'';?>>Terças-feiras</option>
                    <option value="6"<?php echo $materiaContratada['diasSemana']=='6'?'selected':'';?>>Quartas-feiras</option>
                    <option value="7"<?php echo $materiaContratada['diasSemana']=='7'?'selected':'';?>>Quintas-feiras</option>
                    <option value="8"<?php echo $materiaContratada['diasSemana']=='8'?'selected':'';?>>Sextas-feiras</option>
                    <option value="9"<?php echo $materiaContratada['diasSemana']=='9'?'selected':'';?>>Sábados</option>
                    <option value="10"<?php echo $materiaContratada['diasSemana']=='10'?'selected':'';?>>Domingos</option>
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="horarioInicial">Horário Inicial</label>
                <input type="time" name="horarioInicial" id="horarioInicial" class="form-control" value="<?php echo $materiaContratada['horarioInicial']?>"/>
            </div>

            <div class="form-group col-md-3">
                <label for="horarioFinal">Horário Final</label>
                <input type="time" name="horarioFinal" id="horarioFinal" class="form-control" value="<?php echo $materiaContratada['horarioFinal']?>"/>
            </div>                                    
        </div>
    </div>
</div>

<div class="form-row mb-6">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-hover" id="tblAdsMateria" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Anúncios Responsivos de Pesquisa</th>                        
                        <th scope="col" style="width:10px">Edição</th>
                        <th scope="col" style="width:10px">Exclusão</th>
                    </tr>
                </thead>        
            </table>
        </div>
    </div>
</div>

<div class="form-row mb-2">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-hover" id="tblAdsMateriaChamadas" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Anúncios somente para Chamadas</th>                        
                        <th scope="col" style="width:10px">Edição</th>
                        <th scope="col" style="width:10px">Exclusão</th>
                    </tr>
                </thead>        
            </table>
        </div>
    </div>
</div>

<!-- o form modal para adição e edição destes posts está no rodapé do form-edit.php -->

<!-- Adicionar data-tt="tooltip" title="Título" para múltiplos data-toggle. Salvo no footer.php -->
<button type="button" id="btPopupAds" data-toggle="modal" data-target="#popupAds" data-tt="tooltip" title="Opções Google Ads" class="btn float bg-primary text-white">
    <i class="fas fa-plus"></i>
</button>

