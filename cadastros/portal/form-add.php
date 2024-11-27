<?php
session_start();
require_once '../../init.php';
require '../../check.php';
$pageTitle = 'Nova Inserção';

// aqui recebemos o id do contrato através do POST - para adição da nova matéria
// if (isset($_POST["idContrato"])) {
//         $idContrato = isset($_POST['idContrato']) ? $_POST['idContrato'] : null;
//         $nContrato = isset($_POST['nContrato']) ? $_POST['nContrato'] : null;
//         $empresa = isset($_POST['empresa']) ? $_POST['empresa'] : null;
//         $dataCt = isset($_POST['dataCt']) ? $_POST['dataCt'] : null;
//         $prazoCt = isset($_POST['prazoCt']) ? $_POST['prazoCt'] : null;
//         $parentPage = 'Contrato '. $nContrato . ' - ' . $empresa; // breadcrumb
//         $parentLink = '../form-edit.php?id=' . $idContrato; // breadcrumb

//     } else {
//         header("Location: ../index.php");
//         exit;
// }

include (HEADER_TEMPLATE); ?>

<div class="container-fluid">

    <?php
        require '../../classes/materiasCt.class.php';
        $mc = new MateriasCt();

        if (isset($_POST['idMateria']) && !empty($_POST['idMateria'])) {

            $idContrato = addslashes($_POST['idContrato']);
            $idMateria = addslashes($_POST['idMateria']);
            $idPublicacao = addslashes($_POST['idPublicacao']);
            $idStatus = addslashes($_POST['idStatus']);
            $idUserProducao = addslashes($_POST['idUserProducao']);
            $idUserAprovacao = addslashes($_POST['idUserAprovacao']);
            $idPacote = addslashes($_POST['idPacote']);               
            $empresa = addslashes($_POST['empresa']); 
            $dataProducao = addslashes(dateConvert($_POST['dataProducao']));
            $dataLimite = addslashes(dateConvert($_POST['dataLimite']));
            $dataExpiracao = addslashes(dateConvert($_POST['dataExpiracao']));
            $dataRegistro = date("Y-m-d H:i:s"); // equivale à função now() em SQL
            $idUser = addslashes($_SESSION['user_id']); // usuário que ADICIONA

            $mc->addMateriaContratada($idContrato, $idMateria, $idPublicacao, $idStatus, $idUserProducao, $idUserAprovacao, $idPacote, $empresa, $dataProducao, $dataLimite, $dataExpiracao, $dataRegistro, $idUser);
            ?>
                <div class="alert alert-success">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Inserção adicionada com sucesso! Redirecionando...
                    <script type="text/javascript">
                        setTimeout(function(){
                        window.location.href ='form-edit.php?id=<?php echo $lastId.'&idContrato='.$idContrato.'&nContrato='.$nContrato.'&empresa='.$empresa;?>';
                        //redireciona para a o novo registro, gera o breadcrumb através do POST                  
                        }, 3000);
                    </script>
                </div>
            <?php 
        }
    ?>

    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <i class="fa fa-info-circle"></i> Para adicionar imagens e mais informações a esta inserção, salve-a primeiro.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <form method="POST" autocomplete="off">
        <div class="form-row mb-2">
            <!-- Coluna 1: Dados Externa-->
            <div class="col-lg-8 col-md-6">

                <ul class="nav nav-tabs mb-3" id="tabDadosMateria" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="principal-tab" data-toggle="tab" href="#principal" role="tab" aria-controls="principal" aria-selected="true">Principal</a>
                    </li>        
                </ul>

                <div class="tab-content" id="tabDadosMateriaConteudo">

                    <div class="tab-pane fade show active" id="principal" role="tabpanel" aria-labelledby="principal-tab">
                        <div class="form-row mb-2">                    
                           
                            <div class="col">
                                <div class="form-group">
                                    <label for="empresa">Nome da Empresa</label>
                                    <input class="form-control" type="text" name="empresa" id="empresa" required>
                                </div>

                                <div class="form-row">
                                   
                                    <div class="form-group col-md-4">
                                        <label for="idMateria">Matéria</label>
                                        <select class="form-control" name="idMateria" id="idMateria" onchange="alteraMateria(this)" required>
                                            <option value="">Selecione Matéria</option>
                                                <?php 
                                                require '../../classes/materias.class.php';
                                                $mt = new Materias();
                                                $materias = $mt->getMateriasPortal();

                                                foreach ($materias as $materia) {
                                                   $grupos[$materia['tipoMateria']][$materia['id']]  = $materia['materia'];
                                                   $prazos[$materia['id']]  = $materia['prazo'];
                                                }

                                            foreach($grupos as $rotulo => $opcao): ?>
                                    
                                                <optgroup label="<?php echo $rotulo; ?>">
                                                    <?php foreach ($opcao as $id => $nome) : ?>
                                                        
                                                        <option value="<?php echo $id; ?>" data-prazo="<?php
                                                            foreach ($prazos as $id2 => $prazo) {
                                                                if ($id2 == $id) {
                                                                  echo $prazo;
                                                                }
                                                            }
                                                            ?>"><?php echo $nome; ?></option>                                                 

                                                    <?php endforeach; ?>
                                                </optgroup>

                                            <?php endforeach;?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="idPacote">Pacote</label>
                                        <select class="form-control" name="idPacote" id="idPacote" required>
                                            <option value="">Selecione Pacote</option>
                                            <option value="1">Pacote Start</option>
                                            <option value="2">Pacote Master</option>
                                            <option value="3">Pacote Supremo</option>
                                            <option value="4">Extras</option>
                                        </select> 
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="idPublicacao">Publicação</label>
                                        <select class="form-control" name="idPublicacao" id="idPublicacao" required>
                                            <option value="">Selecione a Publicação</option>
                                            <?php 
                                                require '../../classes/publicacoes.class.php';
                                                $p = new Publicacoes();
                                                $publicacoes = $p->getPublicacoes();
                                                foreach($publicacoes as $publicacao): ?>
                                                    <option value="<?php echo $publicacao['id'];?>"><?php echo $publicacao['publicacao'];?></option>
                                            <?php endforeach;?>                                   
                                        </select>
                                    </div>
                                </div>                        

                                <div class="form-row">

                                    <div class="form-group col-lg-4 col-md-6">                                  
                                        <label id="lblDataProducao" for="dataProducao">Produção (-2 Dias) <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Prazo da Matéria - 2 Dias."></i></label>
                                        <input class="form-control" type="text" name="dataProducao" id="dataProducao" readonly>
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6">
                                        <label id="lblDataLimite" for="dataLimite">Data Limite </label> <label><i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Prazo limite de conclusão e envio deste item. Data de inclusão + Prazo da Matéria."></i></label>
                                        <input class="form-control" type="text" name="dataLimite" id="dataLimite" readonly>
                                    </div>

                                    <div class="form-group col-lg-4 col-md-12">
                                        <label id="lblDataExpiracao" for="dataExpiracao">Expiração (+<?php //echo $prazoCt; ?> dias) </label> <label> <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Data de expiração deste item."></i></label>
                                        <input class="form-control" type="date" name="dataExpiracao" id="dataExpiracao">
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

                                <div class="form-row"><!-- campos ocultos --> 
                                    <input type="hidden" name="idContrato" value="<?php echo $idContrato;?>"> 
                                    <input type="hidden" name="idUser" value="<?php echo $_SESSION['user_id'];?>">
                                    <input type="hidden" name="dataCt" id="dataCt" value="<?php echo $dataCt; ?>">
                                    <input type="hidden" name="prazoCt" id="prazoCt" value="<?php echo $prazoCt; ?>">
                                </div>
                            </div>
                            
                        </div> 
                    </div>
                    
                    <!-- botões -->
                    <!-- <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Cadastrar">
                    </div> -->
                </div>
            </div>
            <!-- Coluna 2: Informações Externas-->
            <div class="col-lg-4 col-md-6">
                <div class="card ml-2">
                    <div class="card-header">Informações Gerais</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="idStatus">Status</label>
                            <select class="form-control" name="idStatus" id="idStatus" required>
                                <option value="">Selecione Status</option>
                                <?php 
                                    require '../../classes/status.class.php';
                                    $s = new Status();
                                    $statuses = $s->getStatus();
                                    foreach($statuses as $status): ?>
                                        <option value="<?php echo $status['id'];?>"><?php echo $status['status'];?></option>
                                <?php endforeach;?>
                            </select> 
                        </div>

                        <div class="form-group">
                            <label for="idUserProducao">Atribuir Usuário de Produção <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Usuário atribuído à produção desta matéria."></i></label>
                            <select class="form-control" name="idUserProducao" id="idUserProducao" required>
                                <option value="">Selecione Usuário</option>
                                <?php 
                                require '../../classes/usuarios.class.php';
                                $u = new Usuarios();
                                $usuarios = $u->getUsuariosByRole();

                                foreach($usuarios as $usuario): ?>
                                    <option value="<?php echo $usuario['id'];?>"><?php echo $usuario['name'];?></option>
                                <?php endforeach;?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="idUserAprovacao">Atribuir Usuário de Aprovação <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Usuário atribuído à aprovação desta matéria."></i></label>
                            <select class="form-control" name="idUserAprovacao" id="idUserAprovacao" required>
                                <option value="">Selecione Usuário</option>
                                <?php 
                                
                                foreach($usuarios as $usuario): ?>
                                    <option value="<?php echo $usuario['id'];?>"><?php echo $usuario['name'];?></option>
                                <?php endforeach;?>

                            </select>
                        </div>

                        <!-- botões -->
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="Cadastrar Inserção">
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </form>

</div>

<?php include (FOOTER_TEMPLATE);?>

