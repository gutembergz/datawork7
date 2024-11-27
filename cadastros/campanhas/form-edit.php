<?php
session_start();
require_once '../../init.php';
require '../../check.php';
$pageTitle = 'Editar Campanha';
$parentPage = 'Campanhas';

include (HEADER_TEMPLATE); ?>

<div class="container-fluid">

    <?php 
    require '../../classes/campanhas.class.php';
    $c = new Campanhas();

    if (isset($_POST['campanha']) && !empty($_POST['campanha'])) {

        $campanha = addslashes($_POST['campanha']);
        $descCampanha = addslashes($_POST['descCampanha']);
        $anoCampanha = addslashes($_POST['anoCampanha']);
        $dataAlteracao = date("Y-m-d H:i:s"); // equivale à função now() em SQL

        $c->editCampanha($campanha, $descCampanha, $anoCampanha, $dataAlteracao, $_GET['id']);

        ?>
            <div class="alert alert-success">
                Campanha alterada com sucesso!
            </div>
        <?php 
    }   
    
    if (isset($_GET['id']) && !empty($_GET['id']) || empty($campanha)) {
        
    $campanha = $c->getCampanha($_GET['id']);

    if (empty($campanha)) {
        ?>
        <script type="text/javascript">window.location.href="index.php"</script>
        <?php 
        exit;
        }

    } else {
        ?>
        <script type="text/javascript">window.location.href="index.php"</script>
        <?php 
        exit;
    }

    ?> 

    <ul class="nav nav-tabs mb-3" id="tabDadosCampanha" role="tablist">

        <li class="nav-item">
            <a class="nav-link active" id="principal-tab" data-toggle="tab" href="#principal" role="tab" aria-controls="principal" aria-selected="true">Principal</a>
        </li>
        
    </ul>

    <div class="tab-content" id="tabDadosHistoricoConteudo">
            
        <div class="tab-pane fade show active" id="principal" role="tabpanel" aria-labelledby="principal-tab">
          
            <form method="POST">

                <div class="form-group">
                    <label for="campanha">Campanha</label>
                    <input class="form-control" type="text" name="campanha" id="campanha" value="<?php echo $campanha['campanha'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="anoCampanha">Ano da Campanha</label>
                    <input class="form-control" type="text" name="anoCampanha" id="anoCampanha" value="<?php echo $campanha['anoCampanha'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="descCampanha">Descrição da Campanha</label>
                    <textarea class="form-control" name="descCampanha" id="descCampanha" required><?php echo $campanha['descCampanha'] ?></textarea>
                </div>

                <!-- dados de registro e alteração -->
                <div class="form-row">
                    
                    <div class="form-group col-md-4">
                        <label for="name">Usuário</label>
                        <input class="form-control" type="text" name="name" id="name" value="<?php echo $campanha['nomeUsuario'] ?>" readonly>
                    </div>

                    <div class="form-group col-md-4"> 
                        <label for="dataRegistro">Data de Registro </label>
                        <?php $dataRegistro = strtotime($campanha['dataRegistro']);?>
                        <input class="form-control" type="text" name="dataRegistro" id="dataRegistro" value="<?php echo date('d/m/Y H:i:s',$dataRegistro); ?>" readonly>
                    </div>

                    <div class="form-group col-md-4"> 
                        <label for="dataAlteracao">Data de Alteração </label>
                        <?php $dataAlteracao = strtotime($campanha['dataAlteracao']);?>
                        <input class="form-control" type="text" name="dataAlteracao" id="dataAlteracao" value="<?php echo $campanha['dataAlteracao']== 0 ? 'Sem Alterações' : date('d/m/Y H:i:s',$dataAlteracao); ?>" readonly>
                    </div>

                </div> 
                
                <!-- botões -->
                <div class="form-group"> 
                    <input class="btn btn-primary" type="submit" role="button" value="Salvar Alterações">
                    <a class="btn btn-danger" href="delete.php?id=<?php echo $campanha['id']; ?>" onclick="return confirm('Tem certeza de que deseja remover?');" role="button" readonly>Excluir Campanha</a> 
                </div>
            
            </form>
        </div>

    </div>

</div>

<?php include (FOOTER_TEMPLATE);?>