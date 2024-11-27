<?php
session_start();
require_once '../../../init.php';
require '../../../check.php';

// aqui recebemos o id do contrato através do POST - para adição do novo histórico
if (isset($_POST["idContrato"])) {
        $idContrato = isset($_POST['idContrato']) ? $_POST['idContrato'] : null;
        $nContrato = isset($_POST['nContrato']) ? $_POST['nContrato'] : null;
        $empresa = isset($_POST['empresa']) ? $_POST['empresa'] : null;
        $parentPage = 'Contrato '. $nContrato . ' - ' . $empresa; // breadcrumb
        $parentLink = '../form-edit.php?id=' . $idContrato; // breadcrumb
        $pageTitle = 'Novo Histórico';

    } else {
        header("Location: ../index.php");
        exit;
}

include (HEADER_TEMPLATE); ?>

<div class="container-fluid">
    
    <?php
    require '../../../classes/historicos.class.php';
    $h = new Historicos();

    if (isset($_POST['infoHistorico']) && !empty($_POST['infoHistorico'])) {        

        $idContrato = addslashes($_POST['idContrato']);
        $infoHistorico = addslashes($_POST['infoHistorico']);     
        $dataRegistro = date("Y-m-d H:i:s"); // equivale à função now() em SQL
        $idUser = addslashes($idUser = $_SESSION['user_id']);

        $h->addHistorico($idContrato, $infoHistorico, $dataRegistro, $idUser);
        ?>
            <div class="alert alert-success">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Histórico adicionado com sucesso! Redirecionando...
                <script type="text/javascript">
                    setTimeout(function(){
                    window.location.href ='form-edit.php?id=<?php echo $lastId.'&idContrato='.$idContrato.'&nContrato='.$nContrato.'&empresa='.$empresa;?>';
                    // redireciona para a o novo registro, gera o breadcrumb através do POST                  
                    }, 3000);
                </script>
            </div>
        <?php 
    }
    ?>  

    <ul class="nav nav-tabs mb-3" id="tabDadosHistorico" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="principal-tab" data-toggle="tab" href="#principal" role="tab" aria-controls="principal" aria-selected="true">Principal</a>
        </li>
    </ul>

    <div class="tab-content" id="tabDadosHistoricoConteudo">
        
        <div class="tab-pane fade show active" id="principal" role="tabpanel" aria-labelledby="principal-tab">
          
            <form method="post">

                <div class="form-group">
                    <label for="infoHistorico">Informações do Histórico</label>
                    <textarea class="form-control" rows="8" name="infoHistorico" id="infoHistorico" required></textarea>
                </div>

                <!-- dados de registro e alteração -->
                <div class="form-row">
                    <div class="form-group col-lg-3 col-md-6">
                        <label for="name"><small>Registrado por</small></label>
                        <input class="form-control form-control-sm" type="text" name="name" id="name" value="<?php echo $_SESSION['user_name']; ?>" readonly>
                    </div>
                    <div class="form-group col-lg-3 col-md-6"> 
                        <label for="dataRegistro"><small>Data de Registro</small></label>
                        <input class="form-control form-control-sm" type="text" name="dataRegistro" id="dataRegistro" value="Aguardando Dados" readonly>
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

                <!-- campos ocultos -->
                <input type="hidden" name="idContrato" value="<?php echo $idContrato;?>"> 
                <input type="hidden" name="idUser" value="<?php echo $_SESSION['user_id'];?>">
                <input type="hidden" name="nContrato" value="<?php echo $nContrato; ?>">  
                <input type="hidden" name="empresa" value="<?php echo $empresa; ?>">   

                <!-- botões -->
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Salvar Histórico">
                </div>
            </form>

        </div>

    </div>

</div>

<?php include (FOOTER_TEMPLATE);?>