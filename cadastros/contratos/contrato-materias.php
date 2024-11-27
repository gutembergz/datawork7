<?php
require_once '../../init.php';
require '../../check.php';
?>
      
<div class="table-responsive">
    <table class="table table-hover" id="tblMateriasCt" style="width:100%">
        <thead>
            <tr>
                <th>Matéria</th>                
                <th>Data de Produção</th>
                <th>Data Limite</th>
                <th>Data de Expiração</th>
                <th>Status</th>                
                <th>Pacote</th>
                <th style="width:10px">Edição</th>
            </tr>
        </thead>
    </table>
</div>

<div id="addMateria" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Adicionar Matéria</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form action="<?php echo BASEURL; ?>cadastros/contratos/materias/form-add.php" method="POST">
                    <input type="hidden" name="idContrato" value="<?php echo $id; ?>">
                    <input type="hidden" name="nContrato" value="<?php echo $contrato['nContrato']; ?>">  
                    <input type="hidden" name="empresa" value="<?php echo $contrato['empresa']; ?>"> 
                    <input type="hidden" name="dataCt" value="<?php echo $contrato['dataRegistro']; ?>">
                    <input type="hidden" name="prazoCt" value="<?php echo $contrato['prazo']; ?>"> 
                    <button class="btn btn-primary btn-lg btn-block mb-2" type="submit" value="Submit">Adicionar Matéria Única</button>
                </form>
                <form action="<?php echo BASEURL; ?>cadastros/contratos/materias/form-pacote.php" method="POST">
                    <input type="hidden" name="idContrato" value="<?php echo $id; ?>">
                    <input type="hidden" name="nContrato" value="<?php echo $contrato['nContrato']; ?>">  
                    <input type="hidden" name="empresa" value="<?php echo $contrato['empresa']; ?>"> 
                    <button class="btn btn-success btn-lg btn-block mb-2" type="submit" value="Submit">Adicionar Pacote</button>
                </form>
            </div>            
        </div>
    </div>
</div>

<!-- Adicionar data-tt="tooltip" title="Título" para múltiplos data-toggle. Salvo no footer.php -->
<a class="float bg-primary text-white" href="#addMateria" role="button" data-toggle="modal" data-tt="tooltip" title="Adicionar Matéria">
    <i class="fas fa-plus float-button"></i>
</a>