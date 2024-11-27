<?php
session_start();
require_once '../../../init.php';
require '../../../check.php';
$pageTitle = 'Editar Template de E-mail';
$parentPage = 'Templates de E-mails';

include (HEADER_TEMPLATE); ?>

<script type="text/javascript"> // ativador do tinyMCE
    tinymce.init({
        mode: 'textareas',
        language: 'pt_BR',
        branding: false // remove o rodapé do tinyMCE
    });
</script>

<div class="container-fluid">

    <?php 
    require '../../../classes/emailsTemplates.class.php';
    $et = new EmailsTemplates();

    if (isset($_POST['assunto']) && !empty($_POST['assunto'])) {

        $assunto = addslashes($_POST['assunto']);
        $texto = addslashes($_POST['texto']);
        $texto2 = addslashes($_POST['texto2']);
        $tipoEmail = addslashes($_POST['tipoEmail']);
        $incluiMaterias = addslashes($_POST['incluiMaterias']);
        $idStatus = addslashes($_POST['idStatus']);
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

        if (isset($_POST['tiposStatus'])) {
            $tiposStatus = '';
            foreach ($_POST['tiposStatus'] as $value) {
                if ($tiposStatus!='') $tiposStatus.=', ';
                $tiposStatus.= $value;
                } 
        } else {
            $tiposStatus = '';
        }

        $et->editEmailTemplate($assunto, $texto, $texto2, $tipoEmail, $incluiMaterias, $tiposMaterias, $tiposStatus, $idStatus, $dataAlteracao, $_GET['id']);

        ?>
            <div class="alert alert-success">
                Template de e-mail alterado com sucesso!
            </div>
        <?php 
    }   
    
    if (isset($_GET['id']) && !empty($_GET['id']) || empty($assunto)) {
        
        $emailTemplate = $et->getEmailTemplate($_GET['id']);

        if (empty($emailTemplate)) {
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

    <ul class="nav nav-tabs mb-3" id="tabDadosTemplate" role="tablist">

        <li class="nav-item">
            <a class="nav-link active" id="principal-tab" data-toggle="tab" href="#principal" role="tab" aria-controls="principal" aria-selected="true">Principal</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="materias-tab" data-toggle="tab" href="#materias" role="tab" aria-controls="materias" aria-selected="false">Matérias</a>
        </li>
       
    </ul>
    
    <form method="POST" autocomplete="off">

        <div class="tab-content" id="tabDadosTemplateConteudo">
           
            <div class="tab-pane fade show active" id="principal" role="tabpanel" aria-labelledby="principal-tab"> <!-- inicio de principal-tab -->
         
                <div class="form-group">
                    <label for="assunto">Assunto do E-mail</label>
                    <input class="form-control" name="assunto" id="assunto" value="<?php echo $emailTemplate['assunto'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="texto">Parágrafo 1</label>
                    <textarea class="form-control" rows="10" name="texto" id="texto"><?php echo $emailTemplate['texto'] ?></textarea>
                </div>

                <div class="form-group">
                    <label for="texto2">Parágrafo 2</label>
                    <textarea class="form-control" rows="10" name="texto2" id="texto2"><?php echo $emailTemplate['texto2'] ?></textarea>
                </div>

            </div> <!-- final de principal-tab -->

            <div class="tab-pane fade" id="materias" role="tabpanel" aria-labelledby="materias-tab"> <!-- inicio de materias-tab -->
                
                <div class="form-row">     
                    <div class="form-group col-md-4">
                        <label for="idStatus">Status</label>    
                        <select class="form-control" name="idStatus" required>
                            <option value="" <?php echo $emailTemplate['idStatus']==''?'selected':'';?>>Selecione Status</option>
                            <option value="1" <?php echo $emailTemplate['idStatus']=='1'?'selected':'';?>>Ativado</option>
                            <option value="2" <?php echo $emailTemplate['idStatus']=='2'?'selected':'';?>>Desativado</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="tipoEmail">Tipo de E-mail</label>

                        <select class="form-control" name="tipoEmail" required>
                            <option value="" <?php echo $emailTemplate['tipoEmail']==''?'selected':'';?>>Selecione o Tipo de E-mail</option>
                            <option value="Etapa 1: Inicial" <?php echo $emailTemplate['tipoEmail']=='Etapa 1: Inicial'?'selected':'';?>>Etapa 1: Inicial</option>
                            <option value="Etapa 2: Informativos" <?php echo $emailTemplate['tipoEmail']=='Etapa 2: Informativos'?'selected':'';?>>Etapa 2: Informativos</option>
                            <option value="Etapa 3: Produção" <?php echo $emailTemplate['tipoEmail']=='Etapa 3: Produção'?'selected':'';?>>Etapa 3: Produção</option>
                            <option value="Etapa 4: Diversos" <?php echo $emailTemplate['tipoEmail']=='Etapa 4: Diversos'?'selected':'';?>>Etapa 4: Diversos</option>
                            <option value="E-mail de Contato" <?php echo $emailTemplate['tipoEmail']=='E-mail de Contato'?'selected':'';?>>E-mail de Contato</option>
                        </select>

                    </div>

                    <div class="form-group col-md-4">
                        <label for="incluiMaterias">Incluir Matérias?</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="incluiMaterias" id="incluiMaterias-nao" value="0" onclick="removeCampoMaterias();" checked="checked" <?php if ($emailTemplate['incluiMaterias'] == '0'): ?> checked="checked" <?php endif; ?>>
                            <label class="custom-control-label" for="incluiMaterias-nao" >Não</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                              <input class="custom-control-input" type="radio" name="incluiMaterias" id="incluiMaterias-sim" value="1" onclick="removeCampoMaterias();" <?php if ($emailTemplate['incluiMaterias'] == '1'): ?> checked="checked" <?php endif; ?>>
                            <label class="custom-control-label" for="incluiMaterias-sim">Sim</label>                        
                        </div>
                    </div>
                </div>

                <div class="form-row" id="selMaterias" <?php echo $emailTemplate['incluiMaterias']==1 ? 'style="display: block;"' : 'style="display: none;"'?>>  
                
                    <div class="form-group col">
                        
                        <?php $tiposMaterias = $emailTemplate['tiposMaterias'];  // obtém os dados do campos

                        $materiasArray = explode(",",$tiposMaterias); // transforma em array ?>

                        <label for="tiposMaterias">Selecione as Matérias a Incluir <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Use a tecla control ou shift para selecionar múltiplas opções."></i></label>

                            <select class="custom-select" name="tiposMaterias[]" multiple size="10">
                                
                                <?php 
                                require '../../../classes/materias.class.php';
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

                    <div class="form-group col">                        
                        <?php $tiposStatus = $emailTemplate['tiposStatus'];  // obtém os dados do campos
                        $statusArray = explode(",",$tiposStatus); // transforma em array ?>

                        <label for="tiposStatus">Selecione os Status a Incluir <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Use a tecla control ou shift para selecionar múltiplas opções."></i></label>

                        <select class="custom-select" name="tiposStatus[]" multiple size="5">
                            
                            <?php 
                            require '../../../classes/status.class.php';
                            $st = new Status();
                            $statuses = $st->getStatus();
                            foreach($statuses as $status): ?>
                                <option value="<?php echo $status['id'] ?>"<?php echo in_array($status['id'], $statusArray) ? "selected":"" ?>><?php echo $status['status'] ?></option>
                            <?php endforeach;?>

                        </select>
                    </div>

                </div>
                
                <!-- dados de registro e alteração -->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="name">Usuário</label>
                        <input class="form-control" type="text" name="name" id="name" value="<?php echo $emailTemplate['nomeUsuario'] ?>" readonly>
                    </div>
                    <div class="form-group col-md-4"> 
                        <label for="dataRegistro">Data de Registro </label>
                        <?php $dataRegistro = strtotime($emailTemplate['dataRegistro']);?>
                        <input class="form-control" type="text" name="dataRegistro" id="dataRegistro" value="<?php echo date('d/m/Y H:i:s',$dataRegistro); ?>" readonly>
                    </div>
                    <div class="form-group col-md-4"> 
                        <label for="dataAlteracao">Data de Alteração </label>
                        <?php $dataAlteracao = strtotime($emailTemplate['dataAlteracao']);?>
                        <input class="form-control" type="text" name="dataAlteracao" id="dataAlteracao" value="<?php echo $emailTemplate['dataAlteracao']== 0 ? 'Sem Alterações' : date('d/m/Y H:i:s',$dataAlteracao); ?>" readonly>
                    </div>
                </div> 

            </div>

            <!-- botões -->
            <div class="form-group">                  
                <input class="btn btn-primary" type="submit" value="Salvar Alterações">
                <a class="btn btn-danger" href="delete.php?id=<?php echo $emailTemplate['id']; ?>" onclick="return confirm('Tem certeza de que deseja remover?');" role="button" readonly>Excluir Template</a> 
            </div>

        </div>

    </form>
     
</div>


<?php include (FOOTER_TEMPLATE);?>