<?php
session_start();
require_once '../../init.php';
require '../../check.php';
$pageTitle = 'Editar Pacote de Matéria';
$parentPage = 'Pacotes de Matérias';

include (HEADER_TEMPLATE); ?>

<div class="container-fluid">

    <?php 
    require '../../classes/pacotes.class.php';
    $pc = new Pacotes();
    $pacotes = $pc->getPacote($_GET['id']);

    if (isset($_POST['pacote']) && !empty($_POST['pacote'])) {

        $pacote = isset($_POST['pacote']) ? addslashes($_POST['pacote']) : null;
        $idStatus = isset($_POST['idStatus']) ? addslashes($_POST['idStatus']) : null; 
        $qtdPecas3Meses = isset($_POST['qtdPecas3Meses']) ? addslashes($_POST['qtdPecas3Meses']) : null; 
        $qtdPecas6Meses = isset($_POST['qtdPecas6Meses']) ? addslashes($_POST['qtdPecas6Meses']) : null; 
        $qtdPecas12Meses = isset($_POST['qtdPecas12Meses']) ? addslashes($_POST['qtdPecas12Meses']) : null;
        $qtdClass3Meses = isset($_POST['qtdClass3Meses']) ? addslashes($_POST['qtdClass3Meses']) : null; 
        $qtdClass6Meses = isset($_POST['qtdClass6Meses']) ? addslashes($_POST['qtdClass6Meses']) : null; 
        $qtdClass12Meses = isset($_POST['qtdClass12Meses']) ? addslashes($_POST['qtdClass12Meses']) : null;
        $tipoPacote = isset($_POST['tipoPacote']) ? addslashes($_POST['tipoPacote']) : null;
        $dataAlteracao = date("Y-m-d H:i:s"); // equivale à função now() em SQL

        if (isset($_POST['tiposMaterias'])) {
            $tiposMaterias = '';
            foreach ($_POST['tiposMaterias'] as $value) {
                if ($tiposMaterias!='') $tiposMaterias.=', ';
                $tiposMaterias.= $value;
                } 
        } else {
            $tiposMaterias = '';
        }        

        $pc->editPacote($pacote, $idStatus, $qtdPecas3Meses, $qtdPecas6Meses, $qtdPecas12Meses, $qtdClass3Meses, $qtdClass6Meses, $qtdClass12Meses, $tipoPacote, $dataAlteracao, $tiposMaterias, $_GET['id']);

        ?>
            <div class="alert alert-success">
                Pacote de matéria alterado com sucesso!
            </div>
        <?php 
    }   
    
    if (isset($_GET['id']) && !empty($_GET['id']) || empty($pacotes)) {
        $pacotes = $pc->getPacote($_GET['id']);

        if (empty($pacotes)) {
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
        
    <form method="POST" autocomplete="off">

        <div class="form-row">   
            <div class="form-group col-md-4">
                <label for="pacote">Nome do Pacote</label>
                <input class="form-control" name="pacote" id="pacote" value="<?php echo $pacotes['pacote'] ?>" required>
            </div>

            <div class="form-group col-md-4">
                <label for="idStatus">Status</label>    
                <select class="form-control" name="idStatus" required>
                    <option value="" <?php echo $pacotes['idStatus']==''?'selected':'';?>>Selecione Status</option>
                    <option value="1" <?php echo $pacotes['idStatus']=='1'?'selected':'';?>>Ativado</option>
                    <option value="2" <?php echo $pacotes['idStatus']=='2'?'selected':'';?>>Desativado</option>
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="tipoPacote">Tipo de Pacote</label>
                <select class="form-control" name="tipoPacote">
                    <option value="" <?php echo $pacotes['tipoPacote']==''?'selected':'';?>>Sem Seleção</option>
                    <option value="posts" <?php echo $pacotes['tipoPacote']=='posts'?'selected':'';?>>Pacote de Posts</option>                    
                </select>
            </div>

        </div>  

        <div class="form-row">
            <div class="form-group form-group col-md-4">
                <label for="qtdPecas3Meses">Quantidade de Peças (1 a 3 Meses)</label>
                <input class="form-control" name="qtdPecas3Meses" id="qtdPecas3Meses" value="<?php echo $pacotes['qtdPecas3Meses'] ?>" required>
            </div>
            <div class="form-group form-group col-md-4">
                <label for="qtdPecas6Meses">Quantidade de Peças (6 Meses)</label>
                <input class="form-control" name="qtdPecas6Meses" id="qtdPecas6Meses" value="<?php echo $pacotes['qtdPecas6Meses'] ?>" required>
            </div>
            <div class="form-group form-group col-md-4">
                <label for="qtdPecas12Meses">Quantidade de Peças (1 Ano)</label>
                <input class="form-control" name="qtdPecas12Meses" id="qtdPecas12Meses" value="<?php echo $pacotes['qtdPecas12Meses'] ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group form-group col-md-4">
                <label for="qtdClass3Meses">Quantidade de Classificados (1 a 3 Meses)</label>
                <input class="form-control" name="qtdClass3Meses" id="qtdClass3Meses" value="<?php echo $pacotes['qtdClass3Meses'] ?>" required>
            </div>
            <div class="form-group form-group col-md-4">
                <label for="qtdClass6Meses">Quantidade de Classificados (6 Meses)</label>
                <input class="form-control" name="qtdClass6Meses" id="qtdClass6Meses" value="<?php echo $pacotes['qtdClass6Meses'] ?>" required>
            </div>
            <div class="form-group form-group col-md-4">
                <label for="qtdClass12Meses">Quantidade de Classificados (1 Ano)</label>
                <input class="form-control" name="qtdClass12Meses" id="qtdClass12Meses" value="<?php echo $pacotes['qtdClass12Meses'] ?>" required>
            </div>
        </div>

        <div class="form-row" id="selMaterias">  
        
            <div class="form-group col">
                
                <?php $tiposMaterias = $pacotes['tiposMaterias'];  // obtém os dados do campos

                $materiasArray = explode(",",$tiposMaterias); // transforma em array ?>

                <label for="tiposMaterias">Selecione as Matérias a Incluir <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Use a tecla control ou shift para selecionar múltiplas opções."></i></label>

                    <select class="custom-select" name="tiposMaterias[]" multiple size="10">
                        
                        <?php 
                        require '../../classes/materias.class.php';
                        $mt = new Materias();
                        $materias = $mt->getMaterias();

                        foreach ($materias as $materia) {
                           $grupos[$materia['tipoMateria']][$materia['id']]  = $materia['materia'];                                       
                        }

                        foreach($grupos as $rotulo => $opcao): ?>
                
                            <optgroup label="<?php echo $rotulo; ?>">
                                <?php foreach ($opcao as $id => $nome) : ?>
                                    <option value="<?php echo $id; ?>"<?php echo in_array($id, $materiasArray) ? "selected":"" ?>><?php echo $nome; ?></option>                                                
                                <?php endforeach; ?>
                            </optgroup>

                        <?php endforeach;?>

                    </select>

            </div>            

        </div>
                
        <!-- dados de registro e alteração -->
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="name">Usuário</label>
                <input class="form-control" type="text" name="name" id="name" value="<?php echo $pacotes['nomeUsuario'] ?>" readonly>
            </div>
            <div class="form-group col-md-4"> 
                <label for="dataRegistro">Data de Registro </label>
                <?php $dataRegistro = strtotime($pacotes['dataRegistro']);?>
                <input class="form-control" type="text" name="dataRegistro" id="dataRegistro" value="<?php echo date('d/m/Y H:i:s',$dataRegistro); ?>" readonly>
            </div>
            <div class="form-group col-md-4"> 
                <label for="dataAlteracao">Data de Alteração </label>
                <?php $dataAlteracao = strtotime($pacotes['dataAlteracao']);?>
                <input class="form-control" type="text" name="dataAlteracao" id="dataAlteracao" value="<?php echo $pacotes['dataAlteracao']== 0 ? 'Sem Alterações' : date('d/m/Y H:i:s',$dataAlteracao); ?>" readonly>
            </div>
        </div>            

        <!-- botões -->
        <div class="form-group">                  
            <input class="btn btn-primary" type="submit" value="Salvar Alterações">
            <a class="btn btn-danger" href="delete.php?id=<?php echo $pacotes['id']; ?>" onclick="return confirm('Tem certeza de que deseja remover?');" role="button" readonly>Excluir Template</a> 
        </div>       

    </form>
     
</div>

<?php include (FOOTER_TEMPLATE);?>