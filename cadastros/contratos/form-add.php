<?php
session_start();
require_once '../../init.php';
require '../../check.php';
$pageTitle = 'Novo Contrato';
$parentPage = 'Contratos';

// recebemos o nome da empresa ao adicionar um novo contrato baseado em cliente
if (isset($_GET['idCliente']) && !empty($_GET['idCliente']) && isset($_GET['nomeCliente']) && !empty($_GET['nomeCliente'])) {
    $idClienteCt = $_GET['idCliente'];
    $nomeCliente = $_GET['nomeCliente'];

} else {
    $idClienteCt = "";
    $nomeCliente = "";
}

include (HEADER_TEMPLATE); ?>

<div class="container-fluid">

    <?php
    require '../../classes/contratos.class.php';
    $ct = new Contratos();

    if (isset($_POST['idCliente']) && !empty($_POST['idCliente'])) {        

        $idCliente = addslashes($_POST['idCliente']);
        $idRepresentante = addslashes($_POST['idRepresentante']);
        $idCampanha = addslashes($_POST['idCampanha']);
        $idStatus = addslashes($_POST['idStatus']);
        $nContrato = addslashes($_POST['nContrato']);
        $prazo = addslashes($_POST['prazo']);
        $valor = addslashes(number_format(str_replace(",",".",str_replace(".","",$_POST['valor'])), 2, '.', ''));
        $obs = addslashes($_POST['obs']);
        $dataExpiracao = addslashes($_POST['dataExpiracao']);
        $dataRegistro = date("Y-m-d H:i:s"); // equivale à função now() em SQL
        $idUser = addslashes($idUser = $_SESSION['user_id']);

        $ct->addContrato($idCliente, $idRepresentante, $idCampanha, $idStatus, $nContrato, $prazo, $valor, $obs, $dataExpiracao, $dataRegistro, $idUser);
        ?>
            <div class="alert alert-success">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Contrato adicionado com sucesso! Redirecionando...
                <script type="text/javascript">
                    setTimeout(function(){
                        window.location.href ='form-edit.php?id=<?php echo $lastId;?>';
                     }, 3000);
                </script>
            </div>
        <?php 
    }
    ?> 
        
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <i class="fa fa-info-circle"></i> Para adicionar matérias, históricos e outras informações, salve o contrato primeiro.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <ul class="nav nav-tabs mb-3" id="tabDadosCliente" role="tablist">

        <li class="nav-item">
            <a class="nav-link active" id="principal-tab" data-toggle="tab" href="#principal" role="tab" aria-controls="principal" aria-selected="true">Dados do Contrato</a>
        </li>

        <li class="nav-item">
            <a class="nav-link disabled">Dados do Cliente</a>
        </li>

        <li class="nav-item">
            <a class="nav-link disabled">Matérias</a>
        </li>

        <li class="nav-item">
            <a class="nav-link disabled">Histórico</a>
        </li>

        <li class="nav-item">
            <a class="nav-link disabled">E-mails Enviados</a>
        </li>

        <li class="nav-item">
            <a class="nav-link disabled">Financeiro</a>
        </li>
        
    </ul>

    <div class="tab-content" id="tabDadosClienteConteudo">
        
        <div class="tab-pane fade show active" id="principal" role="tabpanel" aria-labelledby="principal-tab">

            <form method="POST" autocomplete="off">

                <ul class="errorMessages fade show"></ul>

                <div class="form-group">
                    <label for="idCliente">Cliente</label> <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Selecione o cliente através da lista abaixo."></i>
                    <select class="form-control" name="idCliente" id="idCliente" required>
                        <option value="<?php echo $idClienteCt;?>" selected="selected"><?php echo $nomeCliente;?></option>
                    </select>
                </div>

                <div class="form-row"> 
                    <div class="form-group col-md-6">
                        <label for="idStatus">Status</label>    
                        <select class="form-control" name="idStatus" id="idStatus" required>
                            <option value="">Selecione Status</option>

                            <?php 
                            require '../../classes/status.class.php';
                            $st = new Status();
                            $statuses = $st->getStatus();
                            foreach($statuses as $status): ?>
                                <option value="<?php echo $status['id'];?>"><?php echo $status['status'];?></option>
                            <?php endforeach;?>

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="idCampanha">Campanha</label>
                        <select class="form-control" name="idCampanha" id="idCampanha" required>
                            <option value="">Selecionar Campanha</option>
                            <?php 
                            require '../../classes/campanhas.class.php';
                            $cp = new Campanhas();
                            $campanhas = $cp->getCampanhas();
                            foreach($campanhas as $campanha): ?>
                                <option value="<?php echo $campanha['id'];?>"><?php echo $campanha['campanha'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6"> 
                        <label for="nContrato">Número do Contrato</label>
                        <input class="form-control" type="text" name="nContrato" id="nContrato" maxlength="7" required>
                    </div>

                    <div class="form-group col-md-6"> 
                        <label for="valor">Valor</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroupPrepend">R$</span>
                            </div>
                            <input class="form-control" type="text" name="valor" id="valor" maxlength="15" required>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3"> 
                        <label for="prazo">Prazo do Contrato</label>
                        <select class="form-control" name="prazo" id="prazo" onchange="alteraPrazoContrato(this)" required>
                            <option value="">Selecione o Prazo</option>
                            <option value="30">1 Mês</option>
                            <option value="60">2 Meses</option>
                            <option value="90">3 Meses</option>
                            <option value="180">6 Meses</option>
                            <option value="365">1 Ano</option>
                        </select>                        
                    </div>
                    <div class="form-group col-md-3"> 
                        <label for="dataExpiracao">Data de Expiração</label>
                        <input class="form-control" type="date" name="dataExpiracao" id="dataExpiracao" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="idRepresentante">Representante</label>
                        <select class="form-control" name="idRepresentante" id="idRepresentante" required>
                            <option value="">Selecionar Representante</option>
                            <?php 
                            require '../../classes/representantes.class.php';
                            $r = new Representantes();
                            $representantes = $r->getRepresentantes();
                            foreach($representantes as $representante): ?>
                                <option value="<?php echo $representante['id'];?>"><?php echo $representante['nome'];?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    </div>                    
                </div>

                <div class="form-row">   
                    <div class="form-group col-md-12"> 
                        <label for="obs">Observações</label>
                        <textarea class="form-control" name="obs" id="obs"></textarea>
                    </div>
                </div>

                <!-- dados de registro e alteração -->
                <div class="form-row">
                    <div class="form-group col-lg-3 col-md-6">
                        <label for="name"><small>Registrado por</small></label>
                        <input class="form-control form-control-sm" type="text" name="name" id="name" value="<?php echo $_SESSION['user_name']; ?>" readonly>
                    </div>
                    <div class="form-group col-lg-3 col-md-6"> 
                        <label for="dataRegistro"><small>Data de Registro</small></label>
                        <input class="form-control form-control-sm" type="datetime-local" name="dataRegistro" id="dataRegistro" value="<?php echo $dataRegistro = date('Y-m-d\TH:i:s'); ?>" readonly>
                    </div>
                    <div class="form-group col-lg-3 col-md-6">
                        <label for="userAlteracao"><small>Alterado por</small></label>
                        <input class="form-control form-control-sm" type="text" name="userAlteracao" id="userAlteracao" value="Aguardando Dados" readonly>
                    </div>
                    <div class="form-group col-lg-3 col-md-6"> 
                        <label for="dataAlteracao"><small>Data de Alteração</small></label>
                        <input class="form-control form-control-sm" type="text" name="dataAlteracao" id="dataAlteracao" value="Aguardando Dados" readonly>
                    </div>
                </div>
                
                <div class="form-group">    
                    <!-- campos ocultos -->
                    <input type="hidden" name="prazoDias" id="prazoDias"> 

                    <!-- botões -->
                    <input class="btn btn-primary" type="submit" value="Salvar Contrato">
                </div>
                
            </form>

        </div>

    </div>

</div>

<?php include (FOOTER_TEMPLATE);?>

<script>
    $(document).ready(function() { // transforma os select em select2
        $('#idCliente').select2({
            width: '100%', 
            minimumInputLength: 3,
            language: {                                             
                noResults: function () {                        
                    var termoPesquisa = $('.select2-search input').val();
                    return $("<a href='http://"+host+"/portaldenegocios/manager/cadastros/clientes/form-add.php?empresa="+termoPesquisa+"'>Sem resultados. Adicionar Cliente?</a>");
                },
                searching: function () {
                    return 'Buscando…';
                },
                inputTooShort: function (args) {
                    var remainingChars = args.minimum - args.input.length;
                    var message = 'Digite ' + remainingChars + ' ou mais caracteres';
                    return message;
                },
            },            
            theme: 'bootstrap4',
            ajax: {
            url: 'busca-clientes.php',
            dataType: 'json'
        },   
            
        });
    });
</script>