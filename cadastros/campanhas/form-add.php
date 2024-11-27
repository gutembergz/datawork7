<?php
session_start();
require_once '../../init.php';
require '../../check.php';
$pageTitle = 'Nova Campanha';
$parentPage = 'Campanhas';
//$idPagina = 3;
//checaAcesso($idPagina);

include (HEADER_TEMPLATE);
?>

<div class="container-fluid">

    <?php 
    require '../../classes/campanhas.class.php';
    $c = new Campanhas();

    if (isset($_POST['campanha']) && !empty($_POST['campanha'])) {        

        $campanha = addslashes($_POST['campanha']);
        $descCampanha = addslashes($_POST['descCampanha']);
        $anoCampanha = addslashes($_POST['anoCampanha']);
        $dataRegistro = date("Y-m-d H:i:s"); // equivale à função now() em SQL
        $idUser = addslashes($idUser = $_SESSION['user_id']);

        $c->addCampanha($campanha, $descCampanha, $anoCampanha, $dataRegistro, $idUser);
        ?>
            <div class="alert alert-success">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Campanha adicionada com sucesso! Redirecionando...
                <script type="text/javascript">
                    setTimeout(function(){
                        window.location.href ='form-edit.php?id=<?php echo $lastId;?>';
                    }, 3000);
                </script>
            </div>
        <?php 
    }
    ?> 

    <ul class="nav nav-tabs mb-3" id="tabDadosCampanha" role="tablist">

        <li class="nav-item">
            <a class="nav-link active" id="principal-tab" data-toggle="tab" href="#principal" role="tab" aria-controls="principal" aria-selected="true">Principal</a>
        </li>
       
    </ul>

    <div class="tab-content" id="tabDadosCampanhaConteudo">
        
        <div class="tab-pane fade show active" id="principal" role="tabpanel" aria-labelledby="principal-tab">
          
            <form method="POST">
                
                <div class="form-group">
                    <label for="campanha">Campanha</label>
                    <input class="form-control" type="text" name="campanha" id="campanha" placeholder="Anual 20XX" required>
                </div>

                <div class="form-group">
                    <label for="anoCampanha">Ano da Campanha</label>
                    <input class="form-control" type="text" name="anoCampanha" id="anoCampanha" placeholder="20XX" required>
                </div>

                <div class="form-group">
                    <label for="descCampanha">Descrição da Campanha</label>
                    <textarea class="form-control" name="descCampanha" id="descCampanha" placeholder="Campanha 20XX - Portal de Negócios" required></textarea>
                </div>

                <!-- dados de registro e alteração -->
                <div class="form-row">
                    
                    <div class="form-group col-md-4">
                        <label for="name">Usuário</label>
                        <input class="form-control" type="text" name="name" id="name" value="<?php echo $_SESSION['user_name']; ?>" readonly>
                    </div>

                    <div class="form-group col-md-4"> 
                        <label for="dataRegistro">Data de Registro </label>
                        <input class="form-control" type="text" name="dataRegistro" id="dataRegistro" value="Aguardando Dados" readonly>
                    </div>

                    <div class="form-group col-md-4"> 
                        <label for="dataAlteracao">Data de Alteração </label>
                        <input class="form-control" type="text" name="dataAlteracao" id="dataAlteracao" value="Aguardando Dados" readonly>
                    </div>

                </div> 

                <!-- campos ocultos -->
                <input type="hidden" name="idUser" value="<?php echo $_SESSION['user_id'];?>"> 

                <!-- botões -->
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Salvar Campanha">
                </div>
            </form>

        </div>

    </div>

</div>

<?php include (FOOTER_TEMPLATE);?>