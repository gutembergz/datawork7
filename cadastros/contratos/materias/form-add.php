<?php
session_start();
require_once '../../../init.php';
require '../../../check.php';
$pageTitle = 'Nova Matéria';

// aqui recebemos o id do contrato através do POST - para adição da nova matéria
if (isset($_POST["idContrato"])) {
        $idContrato = isset($_POST['idContrato']) ? $_POST['idContrato'] : null;
        $nContrato = isset($_POST['nContrato']) ? $_POST['nContrato'] : null;
        $empresa = isset($_POST['empresa']) ? $_POST['empresa'] : null;
        $dataCt = isset($_POST['dataCt']) ? $_POST['dataCt'] : null;
        $prazoCt = isset($_POST['prazoCt']) ? $_POST['prazoCt'] : null;
        $parentPage = 'Contrato '. $nContrato . ' - ' . $empresa; // breadcrumb
        $parentLink = '../form-edit.php?id=' . $idContrato; // breadcrumb

    } else {
        header("Location: ../index.php");
        exit;
}

include (HEADER_TEMPLATE); ?>

<div class="container-fluid">

    <?php
        require '../../../classes/materiasCt.class.php';
        $mc = new MateriasCt();

        if (isset($_POST['idMateria']) && !empty($_POST['idMateria'])) {

            $idContrato = isset($_POST['idContrato']) ? addslashes($_POST['idContrato']) : null;
            $idMateria = isset($_POST['idMateria']) ? addslashes($_POST['idMateria']) : null;
            $idStatus = isset($_POST['idStatus']) ? addslashes($_POST['idStatus']) : null;
            $idUserProducao = isset($_POST['idUserProducao']) ? addslashes($_POST['idUserProducao']) : null;
            $idUserAprovacao = isset($_POST['idUserAprovacao']) ? addslashes($_POST['idUserAprovacao']) : null;
            $idPacote = isset($_POST['idPacote']) ? addslashes($_POST['idPacote']) : null;
            $prazo = isset($_POST['prazo']) ? addslashes($_POST['prazo']) : null;  
            $empresa = isset($_POST['empresa']) ? addslashes(trim($_POST['empresa']," ")) : null;  
            $obs = isset($_POST['obs']) ? addslashes($_POST['obs']) : null; 
            $dataProducao = isset($_POST['dataProducao']) ? addslashes($_POST['dataProducao']) : null;
            $dataLimite = isset($_POST['dataLimite']) ? addslashes($_POST['dataLimite']) : null;  
            $dataExpiracao = isset($_POST['dataExpiracao']) ? addslashes($_POST['dataExpiracao']) : null;  
            $dataRegistro = date("Y-m-d H:i:s"); // equivale à função now() em SQL
            $idUser = addslashes($_SESSION['user_id']); // usuário que ADICIONA

            if (isset($_POST['idPublicacao'])) {
                $idPublicacao = '';
                foreach ($_POST['idPublicacao'] as $value) {
                    if ($idPublicacao!='') $idPublicacao.=' | ';
                    $idPublicacao.= $value;
                    } 
            } else {
                $idPublicacao = null;
            }

            $mc->addMateriaContratada($idContrato, $idMateria, $idPublicacao, $idStatus, $idUserProducao, $idUserAprovacao, $idPacote, $prazo, $empresa, $obs, $dataProducao, $dataLimite, $dataExpiracao, $dataRegistro, $idUser);
            ?>
                <div class="alert alert-success">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Matéria adicionada com sucesso! Redirecionando...
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
        <i class="fa fa-info-circle"></i> Para adicionar imagens e mais informações a esta matéria, salve-a primeiro.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <form method="POST" autocomplete="off">

        <ul class="errorMessages fade show"></ul>
        
        <div class="form-row mb-2">
            <!-- Coluna 1: Dados Externa-->
            <div class="col-lg-8 col-md-6">
                <ul class="nav nav-tabs mb-3" id="tabDadosMateria" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="principal-tab" data-toggle="tab" href="#principal" role="tab" aria-controls="principal" aria-selected="true">Principal</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link disabled" id="informacoes-tab">Informações</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="contato-tab">Dados de Contato</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="redessociais-tab">Redes Sociais</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="midias-tab">Mídias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="maisinformacoes-tab">Mais Informações</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="localizacao-tab">Localização</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="postagens-tab">Postagens</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="googleads-tab">Google Ads</a>
                    </li>
                </ul>

                <div class="tab-content" id="tabDadosMateriaConteudo">

                    <div class="tab-pane fade show active" id="principal" role="tabpanel" aria-labelledby="principal-tab">
                        <div class="form-row mb-2">                    
                           
                            <div class="col">
                                <div class="form-group">
                                    <label for="empresa">Nome da Empresa</label>
                                    <input class="form-control" type="text" name="empresa" id="empresa" value="<?php echo $empresa; ?>" required>
                                </div>

                                <div class="form-row">                                   
                                    <div class="form-group col-lg-6 col-md-12">
                                        <label for="idMateria">Matéria</label>
                                        <select class="form-control" name="idMateria" id="idMateria" onchange="alteraMateria(this)" required>
                                            <option value="">Selecione a Matéria</option>
                                                <?php 
                                                require '../../../classes/materias.class.php';
                                                $mt = new Materias();
                                                $materias = $mt->getMaterias();

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

                                    <div class="form-group col-lg-3 col-md-12">
                                        <label for="idPacote">Pacote</label>
                                        <select class="form-control" name="idPacote" id="idPacote" required>
                                            <option value="">Selecione o Pacote</option>
                                            <?php 
                                                require '../../../classes/pacotes.class.php';
                                                $pct = new Pacotes();
                                                $pacotes = $pct->getPacotes();
                                                foreach($pacotes as $pacote): ?>
                                                    <option value="<?php echo $pacote['id'];?>"><?php echo $pacote['pacote'];?></option>
                                            <?php endforeach;?>                                   
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-3 col-md-12"> 
                                        <label for="prazo">Prazo da Matéria</label>
                                        <select class="form-control" name="prazo" id="prazo" onchange="alteraPrazoMateria(this)" required>
                                            <option value="">Selecione o Prazo</option>
                                            <option value="30">1 Mês</option>
                                            <option value="60">2 Meses</option>
                                            <option value="90">3 Meses</option>
                                            <option value="180">6 Meses</option>
                                            <option value="365">1 Ano</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-lg-12 col-md-12" id="divIdPublicacao">
                                        <label for="idPublicacao">Publicação</label>
                                        <select class="form-control publicacao-select2" name="idPublicacao[]" id="idPublicacao" multiple="multiple" required>                                            
                                            <?php 
                                                require '../../../classes/publicacoes.class.php';
                                                $p = new Publicacoes();
                                                $publicacoes = $p->getPublicacoes();
                                                foreach($publicacoes as $publicacao): ?>
                                                    <option value="<?php echo $publicacao['id'];?>"><?php echo $publicacao['publicacao'];?></option>
                                            <?php endforeach;?>                                   
                                        </select>
                                    </div>                                    
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-lg-4 col-md-12">
                                        <label id="lblDataProducao" for="dataProducao">Produção (-2 Dias) <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Prazo da Matéria - 2 Dias."></i></label>
                                        <input class="form-control" type="date" name="dataProducao" id="dataProducao" disabled>
                                    </div>

                                    <div class="form-group col-lg-4 col-md-12">
                                        <label id="lblDataLimite" for="dataLimite">Data Limite </label> <label><i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Prazo limite de conclusão e envio deste item. Data de inclusão + Prazo da Matéria."></i></label>
                                        <input class="form-control" type="date" name="dataLimite" id="dataLimite" disabled>
                                    </div>

                                    <div class="form-group col-lg-4 col-md-12">
                                        <label id="lblDataExpiracao" for="dataExpiracao">Expiração (+<?php echo $prazoCt; ?> Dias) </label> <label> <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Data de expiração deste item."></i></label>
                                        <input class="form-control" type="date" name="dataExpiracao" id="dataExpiracao" disabled>
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
                                <div class="form-row">
                                    <input type="hidden" name="idContrato" id="idContrato" value="<?php echo $idContrato;?>"> 
                                    <input type="hidden" name="idUser" id="idUser" value="<?php echo $_SESSION['user_id'];?>">
                                    <input type="hidden" name="dataCt" id="dataCt" value="<?php echo $dataCt; ?>">
                                    <input type="hidden" name="prazoCt" id="prazoCt" value="<?php echo $prazoCt; ?>">
                                    <input type="hidden" name="dataExpiracaoCt" id="dataExpiracaoCt">                                    
                                    <input type="hidden" name="contaMaterias" id="contaMaterias">
                                    <input type="hidden" name="acao" id="acao" value="add">                                    
                                    <input type="hidden" name="ultimaData" id="ultimaData">
                                    <input type="hidden" name="dataLimite2" id="dataLimite2">
                                    <input type="hidden" name="nContrato" id="nContrato" value="<?php echo $nContrato;?>">
                                    <input type="hidden" name="prazoDias" id="prazoDias">
                                    <input type="hidden" name="dataRegistroF" id="dataRegistroF">
                                </div>
                            </div>
                            
                        </div> 
                    </div>                  

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
                                    require '../../../classes/status.class.php';
                                    $s = new Status();
                                    $statuses = $s->getStatus();
                                    foreach($statuses as $status): ?>
                                        <option value="<?php echo $status['id'];?>"><?php echo $status['status'];?></option>
                                <?php endforeach;?>
                            </select> 
                        </div>

                        <div class="form-group">
                            <label for="idUserProducao">Atribuir Usuário de Produção</label> <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Usuário atribuído à produção desta matéria."></i>
                            <select class="form-control" name="idUserProducao" id="idUserProducao" required>
                                <option value="">Selecione Usuário</option>
                                <?php 
                                require '../../../classes/usuarios.class.php';
                                $u = new Usuarios();
                                $usuarios = $u->getUsuariosByRole();

                                foreach($usuarios as $usuario): ?>
                                    <option value="<?php echo $usuario['id'];?>"><?php echo $usuario['name'];?></option>
                                <?php endforeach;?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="idUserAprovacao">Atribuir Usuário de Aprovação</label> <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Usuário atribuído à aprovação desta matéria."></i>
                            <select class="form-control" name="idUserAprovacao" id="idUserAprovacao" required>
                                <option value="">Selecione Usuário</option>
                                <?php 
                                
                                foreach($usuarios as $usuario): ?>
                                    <option value="<?php echo $usuario['id'];?>"><?php echo $usuario['name'];?></option>
                                <?php endforeach;?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="dataContrato">Data do Contrato <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Data de entrada do contrato."></i></label>
                             <input class="form-control" type="date" name="dataContrato" id="dataContrato" value="<?php echo date("Y-m-d" , strtotime($dataCt));?>" readonly>
                             <small class="form-text text-muted">Vigência do Contrato: <?php echo $prazoCt; ?> dias.</small>
                        </div>

                        <!-- botões -->
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" id="botaoSubmit" value="Cadastrar Matéria">
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </form>

</div>

<?php include (FOOTER_TEMPLATE);?>

<script>
    $('form').submit(function(e) {
    $(':disabled').each(function(e) {
        $(this).removeAttr('disabled');
    })
});
</script>

<script>    
    $(document).ready(function() { // transforma os select em select2
        $('.publicacao-select2').select2({ 
            width: '100%',
            language: "pt-BR",
            theme: 'bootstrap4',
            placeholder: "Selecione Publicações",
            tags: true,
            allowClear: true,
            tokenSeparators: [',']
        });
    });
</script>

<script>
    // Define como padrão o prazo da nova matéria baseada no contrato
    document.getElementById('prazo').value = '<?php echo $prazoCt; ?>';
    document.getElementById('prazo').disabled = true;
    document.getElementById('divIdPublicacao').style.display = 'none';
    document.getElementById('idPublicacao').disabled = true;
</script>