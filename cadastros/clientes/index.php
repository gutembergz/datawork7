<?php
session_start();
require_once '../../init.php';
require '../../check.php';
$pageTitle = 'Cadastro de Clientes';
?>

<?php include (HEADER_TEMPLATE);?>

<div class="container-fluid">
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <i class="fa fa-info-circle"></i> Pesquise por Empresa, Razão Social, Autorizante, E-mail, Telefone, Celular, CPF e CNPJ.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="table-responsive">
        <table class="table table-hover" id="tblClientes" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">Empresa</th>
                    <th scope="col">Razão Social</th>
                    <th scope="col">Autorizante</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Celular</th>
                    <th scope="col">CPF</th>
                    <th scope="col">CNPJ</th>
                    <th scope="col">Data</th>
                    <th scope="col" style="width:10px">Edição</th>
                </tr>
            </thead>            
        </table>
    </div>
</div>

<!-- <a class="float bg-primary text-white" href="form-add.php" role="button" data-toggle="tooltip" data-placement="top" title="Novo Cliente"> -->

<a class="float bg-primary text-white" href="#" role="button" data-tt="tooltip" data-toggle="modal" data-target="#novoCliente" data-placement="top" title="Novo Cliente">



    <i class="fas fa-plus float-button"></i>
</a>

<?php include (FOOTER_TEMPLATE);?>