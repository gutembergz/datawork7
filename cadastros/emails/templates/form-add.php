<?php
session_start();
require_once '../../../init.php';
require '../../../check.php';
$pageTitle = 'Novo Template de E-mail';
$parentPage = 'Templates de E-mails';

include (HEADER_TEMPLATE); ?>

<script type="text/javascript"> // ativador do tinyMCE
    tinymce.init({
        mode: 'textareas', // ativa todas as áreas de texto
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
        $dataRegistro = date("Y-m-d H:i:s"); // equivale à função now() em SQL
        $idUser = addslashes($idUser = $_SESSION['user_id']);

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

        $et->addEmailTemplate($assunto, $texto, $texto2, $tipoEmail, $incluiMaterias, $tiposMaterias, $tiposStatus, $idStatus, $dataRegistro, $idUser);

        ?>
            <div class="alert alert-success">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Template de e-mail adicionado com sucesso! Redirecionando...
                <script type="text/javascript">
                    setTimeout(function(){
                        window.location.href ='form-edit.php?id=<?php echo $lastId;?>';
                    }, 3000);
                </script>
            </div>
        <?php 
    }
    ?>

    <ul class="nav nav-tabs mb-3" id="tabDadosEmailTemplate" role="tablist">

        <li class="nav-item">
            <a class="nav-link active" id="principal-tab" data-toggle="tab" href="#principal" role="tab" aria-controls="principal" aria-selected="true">Principal</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="materias-tab" data-toggle="tab" href="#materias" role="tab" aria-controls="materias" aria-selected="false">Matérias</a>
        </li>
       
    </ul>
    
    <form method="POST" autocomplete="off">

        <div class="tab-content" id="tabDadosTemplateConteudo">
            
            <div class="tab-pane fade show active" id="principal" role="tabpanel" aria-labelledby="principal-tab">
              
                <div class="form-group">
                    <label for="assunto">Assunto do E-mail</label>
                    <input class="form-control" name="assunto" id="assunto" required>
                </div>

                <div class="form-group">
                    <label for="texto">Parágrafo 1</label>
                    <textarea class="form-control" rows="10" name="texto" id="texto"></textarea>
                </div>

                <div class="form-group">
                    <label for="texto2">Parágrafo 2</label>
                    <textarea class="form-control" rows="10" name="texto2" id="texto2"></textarea>
                </div>

            </div> <!-- final de principal-tab -->

            <div class="tab-pane fade" id="materias" role="tabpanel" aria-labelledby="materias-tab"> <!-- inicio de materias-tab -->
                
                <div class="form-row">     
                    <div class="form-group col-md-4">
                        <label for="idStatus">Status</label>    
                        <select class="form-control" name="idStatus" required>
                            <option value="">Selecione Status</option>
                            <option value="1">Ativado</option>
                            <option value="2">Desativado</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="tipoEmail">Tipo de Email</label>
                        <select class="form-control" name="tipoEmail" required>
                            <option value="">Selecione o Tipo de E-mail</option>
                            <option value="Etapa 1: Inicial">Etapa 1: Inicial</option>
                            <option value="Etapa 2: Informativos">Etapa 2: Informativos</option>
                            <option value="Etapa 3: Produção">Etapa 3: Produção</option>
                            <option value="Etapa 4: Diversos">Etapa 4: Diversos</option>
                            <option value="E-mail de Contato">E-mail de Contato</option>                           
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="incluiMaterias">Incluir Matérias?</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="incluiMaterias" id="incluiMaterias-nao" value="0" onclick="removeCampoMaterias();" checked="checked">
                            <label class="custom-control-label" for="incluiMaterias-nao" >Não</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                              <input class="custom-control-input" type="radio" name="incluiMaterias" id="incluiMaterias-sim" value="1" onclick="removeCampoMaterias();" >
                            <label class="custom-control-label" for="incluiMaterias-sim">Sim</label>                        
                        </div>
                    </div>

                </div>

                <div class="form-row" id="selMaterias" style="display: none;">  
 
                    <div class="form-group col">
                        
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
                                            <option value="<?php echo $id; ?>"><?php echo $nome; ?></option>                                                
                                        <?php endforeach; ?>
                                    </optgroup>

                                <?php endforeach;?>
                        </select>

                    </div>

                    <div class="form-group col">
                        
                        <label for="tiposStatus">Selecione os Status a Incluir <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Use a tecla control ou shift para selecionar múltiplas opções."></i></label>

                        <select class="custom-select" name="tiposStatus[]" multiple size="5">
                            <?php 
                            require '../../../classes/status.class.php';
                            $st = new Status();
                            $statuses = $st->getStatus();
                            foreach($statuses as $status): ?>
                                <option value="<?php echo $status['id'] ?>"><?php echo $status['status'] ?></option>
                            <?php endforeach;?>
                        </select>

                    </div>

                </div>
                
                <!-- dados de registro e alteração -->
                <div class="form-row">
                    
                    <div class="form-group col-md-4">
                        <label for="name">Usuário</label>
                        <input class="form-control" type="text" name="name" id="name" value="<?php echo $_SESSION['user_name'];?>" readonly>
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
            </div> <!-- fim de materias-tab -->
                               
            <!-- botões -->
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Salvar Template">
            </div>               
            
        </div>
        
    </form>
    
</div>

<?php include (FOOTER_TEMPLATE);?>