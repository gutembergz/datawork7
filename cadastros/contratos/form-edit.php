<?php
session_start();
require_once '../../init.php';
require '../../check.php';
$pageTitle = 'Edição de Contrato';
$parentPage = 'Contratos';

include (HEADER_TEMPLATE); ?>

<div class="container-fluid">

    <?php
    $id = $_GET['id']; // pega o ID da URL - para exibir as matérias, históricos e emails do mesmo 
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
        $dataRegistro = addslashes($_POST['dataRegistro']);
        $dataAlteracao = date("Y-m-d H:i:s"); // equivale à função now() em SQL
        $idUserAlteracao = addslashes($_SESSION['user_id']); // usuário que ALTERA

        $ct->editContrato($idCliente, $idRepresentante, $idCampanha, $idStatus, $nContrato, $prazo, $valor, $obs, $dataExpiracao, $dataRegistro, $dataAlteracao, $idUserAlteracao, $_GET['id']);

        ?>
            <div class="alert alert-success">
                Contrato alterado com sucesso!
            </div>
        <?php 
    }   
    
    if (isset($_GET['id']) && !empty($_GET['id']) || empty($contrato)) {
        $contrato = $ct->getContrato($_GET['id']);
        
        if (empty($contrato)) {
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
    
    <h2><?php echo $contrato['empresa']?><small class="text-muted"> #<?php echo $contrato['nContrato'];?></small>
        <small><span class="badge badge-<?php echo statusColor($contrato['status']); ?>"><?php echo $contrato['status']; ?></span></small>
    </h2>

    <ul class="nav nav-tabs mb-3" id="tabContrato" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="dadosContrato-tab" data-toggle="tab" href="#dadosContrato" role="tab" aria-controls="dadosContrato" aria-selected="true">Dados do Contrato</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="dadosCliente-tab" data-toggle="tab" href="#dadosCliente" role="tab" aria-controls="dadosCliente" aria-selected="false">Dados do Cliente</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="materias-tab" data-toggle="tab" href="#materias" role="tab" aria-controls="materias" aria-selected="false">Matérias</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="historico-tab" data-toggle="tab" href="#historico" role="tab" aria-controls="historico" aria-selected="false">Histórico</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="emails-tab" data-toggle="tab" href="#emails" role="tab" aria-controls="emails" aria-selected="false">E-mails Enviados</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="financeiro-tab" data-toggle="tab" href="#financeiro" role="tab" aria-controls="financeiro" aria-selected="false">Financeiro</a>
        </li> 
    </ul>

    <div class="tab-content" id="tabDadosContratoConteudo">
        
        <div class="tab-pane fade show active" id="dadosContrato" role="tabpanel" aria-labelledby="dadosContrato-tab">

            <form method="POST" autocomplete="off">

                <ul class="errorMessages fade show"></ul>

                <div class="form-group">
                    <label for="idCliente">Cliente <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Selecione o cliente através da lista abaixo."></i></label>
                    <select class="form-control" name="idCliente" id="idCliente" onchange="alteraCliente(this)" required>
                        <option value="<?php echo $contrato['idCliente'];?>" selected="selected"><?php echo $contrato['empresa'];?></option>
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
                                <option value="<?php echo $status['id'];?>" <?php echo ($contrato['idStatus']==$status['id'])?'selected="selected"':''; ?>><?php echo $status['status'];?>
                                </option>
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
                                <option value="<?php echo $campanha['id'];?>" <?php echo ($contrato['idCampanha']==$campanha['id'])?'selected="selected"':''; ?>><?php echo $campanha['campanha'];?>
                                </option>
                            <?php endforeach;?>

                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6"> 
                        <label for="nContrato">Número do Contrato</label>
                        <input class="form-control" type="text" name="nContrato" id="nContrato" value="<?php echo $contrato['nContrato'] ?>" maxlength="7" required>
                    </div>

                    <div class="form-group col-md-6"> 
                        <label for="valor">Valor</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">R$</span>
                            </div>
                            <input class="form-control" type="text" name="valor" id="valor" value="<?php echo number_format($contrato['valor'], 2, ',', '.') ; ?>" maxlength="15" required>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3"> 
                        <label for="prazo">Prazo do Contrato</label>
                        <select class="form-control" name="prazo" id="prazo" onchange="alteraPrazoContrato(this)" required>
                            <option value=""<?php echo $contrato['prazo']==''?'selected':'';?>>Selecione o Prazo</option>
                            <option value="30"<?php echo $contrato['prazo']=='30'?'selected':'';?>>1 Mês</option>
                            <option value="60"<?php echo $contrato['prazo']=='60'?'selected':'';?>>2 Meses</option>
                            <option value="90"<?php echo $contrato['prazo']=='90'?'selected':'';?>>3 Meses</option>
                            <option value="180"<?php echo $contrato['prazo']=='180'?'selected':'';?>>6 Meses</option>
                            <option value="365"<?php echo $contrato['prazo']=='365'?'selected':'';?>>1 Ano</option>
                        </select>                        
                    </div>
                    <div class="form-group col-md-3"> 
                        <label for="dataExpiracao">Data de Expiração</label>
                        <?php $dataExpiracao = strtotime($contrato['dataExpiracao']);?>
                        <input class="form-control" type="date" name="dataExpiracao" id="dataExpiracao" value="<?php echo $contrato['dataExpiracao']== 0 ? '' : date("Y-m-d", $dataExpiracao); ?>" readonly>
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
                                <option value="<?php echo $representante['id'];?>" <?php echo ($contrato['idRepresentante']==$representante['id'])?'selected="selected"':''; ?>><?php echo $representante['nome'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    
                </div>

                <div class="form-row">   
                    <div class="form-group col-md-12"> 
                        <label for="obs">Observações</label>
                        <textarea class="form-control" name="obs" id="obs"><?php echo $contrato['obs'];?></textarea>
                    </div>
                </div>

                <!-- dados de registro e alteração -->
                <div class="form-row">
                    <div class="form-group col-lg-3 col-md-6">
                        <label for="name"><small>Registrado por</small></label>
                        <input class="form-control form-control-sm" type="text" name="name" id="name" value="<?php echo $contrato['nomeUsuario'] ?>" readonly>
                    </div>
                    <div class="form-group col-lg-3 col-md-6"> 
                        <label for="dataRegistro"><small>Data de Registro</small></label>
                        <input class="form-control form-control-sm" type="datetime-local" name="dataRegistro" id="dataRegistro" onchange="alteraDataRegistro(this); alteraPrazoContrato();" value="<?php echo date("Y-m-d\TH:i:s", strtotime($contrato['dataRegistro']));?>" required>
                    </div>
                    <div class="form-group col-lg-3 col-md-6">
                        <label for="userAlteracao"><small>Alterado por</small></label>                        
                        <input class="form-control form-control-sm" type="text" name="userAlteracao" id="userAlteracao" value="<?php echo $contrato['userAlteracao']== null ? 'Sem Alterações' : $contrato['userAlteracao'] ?>" readonly>
                    </div>
                    <div class="form-group col-lg-3 col-md-6"> 
                        <label for="dataAlteracao"><small>Data de Alteração</small></label>
                        <?php $dataAlteracao = strtotime($contrato['dataAlteracao']);?>
                        <input class="form-control form-control-sm" type="text" name="dataAlteracao" id="dataAlteracao" value="<?php echo $contrato['dataAlteracao']== 0 ? 'Sem Alterações' : date('d/m/Y H:i:s',$dataAlteracao); ?>" readonly>
                    </div>
                </div>

                <!-- campos ocultos -->
                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $contrato['id']; ?>">
                    <input type="hidden" name="idCliente" id="idCliente2" value="<?php echo $contrato['idCliente']; // envia o dado para geração de email, mas salva ao mesmo tempo ao editar... ?>">
                    <input type="hidden" name="prazoDias" id="prazoDias" value="<?php echo $contrato['prazo'];?>"> 

                    <!-- botões -->
                    <input class="btn btn-primary" type="submit" value="Salvar Alterações">
                    <a class="btn btn-danger" href="delete.php?id=<?php echo $contrato['id']; ?>" onclick="return confirm('Tem certeza de que deseja remover?');" role="button">Excluir Contrato</a>
                </div>

            </form>

        </div>

        <div class="tab-pane fade" id="dadosCliente" role="tabpanel" aria-labelledby="dadosCliente-tab">
             <?php include 'contrato-cliente.php'; ?>
        </div>

        <div class="tab-pane fade" id="materias" role="tabpanel" aria-labelledby="materias-tab">
             <?php include 'contrato-materias.php'; ?>
        </div>
    
        <div class="tab-pane fade" id="historico" role="tabpanel" aria-labelledby="historico-tab">
            <?php include 'contrato-historico.php'; ?> 
        </div>       

        <div class="tab-pane fade" id="emails" role="tabpanel" aria-labelledby="emails-tab">
            <?php include 'contrato-emails.php'; ?>  
        </div>

        <div class="tab-pane fade" id="financeiro" role="tabpanel" aria-labelledby="financeiro-tab">
            
            <div class="container-fluid"> 
                
                <div class="row">
                    <div class="col-md-6">
                        
                        <div><i class="fa fa-upload mr-1 text-muted"></i>Imagem do Contrato</div>
                        
                            <?php 

                                $arquivo = $contrato['filename']; //arquivo único
                                $idCampanha = $contrato['idCampanha'];

                                if (!empty($arquivo)):$imagem = "../../images/contratos/".$idCampanha."/".$arquivo; ?>

                                    <a href="<?php echo $imagem;?>" data-toggle="lightbox" data-title="Imagem do Contrato <?php echo$contrato['nContrato']; ?> ">

                                        <img src="<?php echo $imagem; ?>" class="img-thumbnail" height= "300px" width="300px" />

                                    </a><br/><br/>

                                    <form method="POST" action="contrato-delete.php">
                                        <input type="" name="id" value="<?php echo $id; ?>">
                                        <input type="hidden" name="idCampanha" value="<?php echo $contrato['idCampanha']; ?>">
                                        <input type="hidden" name="filename" value="<?php echo $contrato['filename']; ?>">
                                        <input class="btn btn-danger" type="submit" name="excluir" value="Excluir Imagem" onclick="return confirm('Tem certeza de que deseja excluir?');">
                                    </form>

                            <?php else: ?>
                               
                                <em>Sem imagem enviada.</em>

                            <?php endif; ?>                            
                        
                    </div>

                    <div class="col-md-6">                      
                        <div class="card mb-6">
                            <div class="card-header"><i class="fa fa-upload mr-1 text-muted"></i>Upload do Contrato</div>
                            <div class="card-body">                     
                        
                                <form method="POST" enctype="multipart/form-data" action="contrato-upload.php">
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <input type="hidden" name="nContrato" value="<?php echo $contrato['nContrato']; ?>">
                                        <input type="hidden" name="idCampanha" value="<?php echo $contrato['idCampanha']; ?>">
                                        <input type="hidden" name="filename" value="<?php echo $contrato['filename']; ?>"> 
                                        <input type="file" class="form-control-file" id="arquivo "name="arquivo" required /><br/>
                                        <input class="btn btn-primary" type="submit" value="Enviar"/>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<?php include (FOOTER_TEMPLATE);?>

<script>
// <!-- Transforma os select em select2 -->
    $(document).ready(function() { 
        $('#idCliente').select2({
            width: '100%', 
            minimumInputLength: 3,
            language: "pt-BR",
            theme: 'bootstrap4',
            ajax: {
            url: 'busca-clientes.php',
            dataType: 'json'
        },   
            
        });
    });
</script>