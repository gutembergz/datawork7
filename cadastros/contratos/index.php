<?php
session_start();
require_once '../../init.php';
require '../../check.php';
$pageTitle = 'Cadastro de Contratos';
?>

<?php include (HEADER_TEMPLATE);?>

<div class="container-fluid"> 
    <div class="table-responsive">
        <table class="table table-hover" id="tblContratos" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">Contrato</th>
                    <th scope="col">Empresa</th>
                    <th scope="col">Campanha</th>
                    <th scope="col">Prazo</th>
                    <th scope="col">Data</th>
                    <th scope="col">Status</th>
                    <th scope="col" style="width:10px">Edição</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<a class="float bg-primary text-white" href="form-add.php" role="button" data-toggle="tooltip" data-placement="top" title="Novo Contrato">
    <i class="fas fa-plus float-button"></i>
</a>

<?php include (FOOTER_TEMPLATE);?>