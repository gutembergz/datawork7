<?php
session_start();
require_once '../../../init.php';
require '../../../check.php';

$pageTitle = 'Editar Histórico';
$parentPage = 'Contrato '.$_GET['nContrato'].' - '.$_GET['empresa']; // breadcrumb
$parentLink = '../form-edit.php?id=' . $_GET['idContrato']; // breadcrumb

?>

<?php include (HEADER_TEMPLATE); ?>

<div class="container-fluid">

    <?php
    
    require '../../../classes/historicos.class.php';
    $h = new Historicos();

    if (isset($_POST['infoHistorico']) && !empty($_POST['infoHistorico'])) {

        $idContrato = addslashes($_POST['idContrato']);
        $infoHistorico = addslashes($_POST['infoHistorico']);        
        $dataAlteracao = date("Y-m-d H:i:s"); // equivale à função now() em SQL
        $idUserAlteracao = addslashes($_SESSION['user_id']); // usuário que ALTERA

        $h->editHistorico($idContrato, $infoHistorico, $dataAlteracao, $idUserAlteracao, $_GET['id']);

        ?>
            <div class="alert alert-success">
                Histórico alterado com sucesso!
            </div>
        <?php 
    }   
    
    if (isset($_GET['id']) && !empty($_GET['id']) || empty($historico)) {
        $historico = $h->getHistorico($_GET['id']);
        
        if (empty($historico)) {
            ?>
            <script type="text/javascript">window.location.href="../index.php"</script>
            <?php 
            exit;
            }

        } else {
            ?>
            <script type="text/javascript">window.location.href="../index.php"</script>
            <?php 
            exit;
        }
    ?>  

    <form method="post">
        
        <div class="form-group">
            <label for="infoHistorico">Informações do Histórico</label>
            <textarea class="form-control" rows="8" name="infoHistorico" id="infoHistorico" required><?php echo $historico['infoHistorico'] ?></textarea>
        </div>
        
        <!-- dados de registro e alteração -->
        <div class="form-row">
            <div class="form-group col-lg-3 col-md-6">
                <label for="name"><small>Registrado por</small></label>
                <input class="form-control form-control-sm" type="text" name="name" id="name" value="<?php echo $historico['nomeUsuario'] ?>" readonly>
            </div>
            <div class="form-group col-lg-3 col-md-6">
                <label for="dataRegistro"><small>Data de Registro</small></label>
                <?php $dataRegistro = strtotime($historico['dataRegistro']);?>
                <input class="form-control form-control-sm" type="text" name="dataRegistro" id="dataRegistro" value="<?php echo date('d/m/Y H:i:s',$dataRegistro); ?>" readonly>
            </div>
            <div class="form-group col-lg-3 col-md-6">
                <label for="userAlteracao"><small>Alterado por</small></label>
                <input class="form-control form-control-sm" type="text" name="userAlteracao" id="userAlteracao" value="<?php echo $historico['userAlteracao']== null ? 'Sem Alterações' : $historico['userAlteracao'] ?>" readonly>
            </div>
            <div class="form-group col-lg-3 col-md-6"> 
                <label for="dataAlteracao"><small>Data de Alteração</small></label>
                <?php $dataAlteracao = strtotime($historico['dataAlteracao']);?>
                <input class="form-control form-control-sm" type="text" name="dataAlteracao" id="dataAlteracao" value="<?php echo $historico['dataAlteracao']== 0 ? 'Sem Alterações' : date('d/m/Y H:i:s',$dataAlteracao); ?>" readonly>
            </div>
        </div>                
        
        <!-- campos ocultos -->
        <input type="hidden" name="idContrato" value="<?php echo $historico['idContrato'];?>">
        <input type="hidden" name="id" value="<?php echo $historico['id']; ?>">
                
        <!-- botões -->
        <div class="form-group">                  
            <input class="btn btn-primary" type="submit" value="Salvar Alterações" <?php echo $historico['idUser'] == $_SESSION['user_id'] ? '' : 'disabled'; ?>>
            <a class="btn btn-danger <?php echo $historico['idUser'] == $_SESSION['user_id'] ? '' : 'disabled'; ?>" href="delete.php?id=<?php echo $historico['id']."&idContrato=".$historico['idContrato']; ?>" onclick="return confirm('Tem certeza de que deseja remover?');" role="button" readonly>Excluir Histórico</a>
        </div>
    
    </form>

</div>

<?php include (FOOTER_TEMPLATE);?>