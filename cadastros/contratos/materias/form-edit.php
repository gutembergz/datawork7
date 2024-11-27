<?php
session_start();
require_once '../../../init.php';
require '../../../check.php';

require '../../../classes/materiasCt.class.php';
$mc = new MateriasCt();

$materiaContratada = $mc->getMateriaContratada($_GET['id']);

if (!empty($materiaContratada)) { 
    $pageTitle = 'Editar Matéria Contratada'; // breadcrumb
    $parentPage = 'Contrato '.$materiaContratada['nContrato'].' - '.$materiaContratada['empresaCt']; // breadcrumb
    $parentLink = '../form-edit.php?id=' . $materiaContratada['idContrato']; // breadcrumb
    include (HEADER_TEMPLATE);
}
?>

<div class="container-fluid">
    
    <?php

        if (isset($_POST['idMateria']) && !empty($_POST['idMateria'])) {

            $idContrato = isset($_POST['idContrato']) ? addslashes($_POST['idContrato']) : null;
            $idMateria = isset($_POST['idMateria']) ? addslashes($_POST['idMateria']) : null;
            $idStatus = isset($_POST['idStatus']) ? addslashes($_POST['idStatus']) : null;
            $idUserProducao = isset($_POST['idUserProducao']) ? addslashes($_POST['idUserProducao']) : null;
            $idUserAprovacao = isset($_POST['idUserAprovacao']) ? addslashes($_POST['idUserAprovacao']) : null;
            $idPacote = isset($_POST['idPacote']) ? addslashes($_POST['idPacote']) : null;
            $prazo = isset($_POST['prazo']) ? addslashes($_POST['prazo']) : null;
            $empresa = isset($_POST['empresa']) ? addslashes(trim($_POST['empresa']," ")) : null; // a função trim remove os espaços antes e depois do campo preenchido
            $obs = isset($_POST['obs']) ? addslashes($_POST['obs']) : null; 
            $dataProducao = isset($_POST['dataProducao']) ? addslashes($_POST['dataProducao']) : null;
            $dataLimite = isset($_POST['dataLimite']) ? addslashes($_POST['dataLimite']) : null;  
            $dataExpiracao = isset($_POST['dataExpiracao']) ? addslashes($_POST['dataExpiracao']) : null;  
            $dataAlteracao = date("Y-m-d H:i:s"); // equivale à função now() em SQL
            $idUserAlteracao = addslashes($_SESSION['user_id']); // usuário que ALTERA

            // informações planos web
            $idCategoria = isset($_POST['idCategoria']) ? addslashes($_POST['idCategoria']) : null;
            $frasedestaque = isset($_POST['frasedestaque']) ? addslashes($_POST['frasedestaque']) : null;
            $descricao = isset($_POST['descricao']) ? addslashes($_POST['descricao']) : null; 
            $produtos = isset($_POST['produtos']) ? addslashes($_POST['produtos']) : null; 
            $metadescricao = isset($_POST['metadescricao']) ? addslashes($_POST['metadescricao']) : null;  

            // dados de contato
            $telefone = isset($_POST['telefone']) ? addslashes($_POST['telefone']) : null;
            $celular = isset($_POST['celular']) ? addslashes($_POST['celular']) : null;
            $email = isset($_POST['email']) ? addslashes($_POST['email']) : null;
            $website = isset($_POST['website']) ? addslashes($_POST['website']) : null;

            // redes sociais
            $facebook = isset ($_POST['facebook']) ? addslashes($_POST['facebook']) : null;
            $whatsapp = isset ($_POST['whatsapp']) ? addslashes($_POST['whatsapp']) : null;
            $linkedin = isset ($_POST['linkedin']) ? addslashes($_POST['linkedin']) : null;
            $instagram = isset ($_POST['instagram']) ? addslashes($_POST['instagram']) : null;
            $twitter = isset ($_POST['twitter']) ? addslashes($_POST['twitter']) : null;
            $youtube = isset ($_POST['youtube']) ? addslashes($_POST['youtube']) : null;

            // Mídias
            $linkVideo = isset ($_POST['linkVideo']) ? addslashes($_POST['linkVideo']) : null;
            
            // Google Ads
            $dataInicio = isset ($_POST['dataInicio']) ? addslashes($_POST['dataInicio']) : null;
            $dataTermino = isset ($_POST['dataTermino']) ? addslashes($_POST['dataTermino']) : null;
            $orcamento = isset ($_POST['orcamento']) ? addslashes($_POST['orcamento']) : null;
            $locais = isset ($_POST['locais']) ? addslashes($_POST['locais']) : null;
            $diasSemana = isset ($_POST['diasSemana']) ? addslashes($_POST['diasSemana']) : null;
            $horarioInicial = isset($_POST['horarioInicial']) ? addslashes($_POST['horarioInicial']) : null;
            $horarioFinal = isset($_POST['horarioFinal']) ? addslashes($_POST['horarioFinal']) : null;

            // localização 
            $pesqEndereco = isset($_POST['pesqEndereco']) ? $_POST['pesqEndereco'] : null;
            $endereco = isset($_POST['endereco']) ? $_POST['endereco'] : null;
            $numero = isset($_POST['numero']) ? $_POST['numero'] : null;
            $complemento = isset($_POST['complemento']) ? $_POST['complemento'] : null;
            $bairro = isset($_POST['bairro']) ? $_POST['bairro'] : null;
            $cidade = isset($_POST['cidade']) ? $_POST['cidade'] : null;
            $uf = isset($_POST['uf']) ? $_POST['uf'] : null;        
            $cep = isset($_POST['cep']) ? $_POST['cep'] : null;
            $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : null;  
            $longitude = isset($_POST['longitude']) ? $_POST['longitude'] : null;

            if (isset($_POST['palavrasChave'])) {
                $palavrasChave = '';
                foreach ($_POST['palavrasChave'] as $value) {
                    if ($palavrasChave!='') $palavrasChave.=' | ';
                    $palavrasChave.= $value;
                    } 
            } else {
                $palavrasChave = null;
            }

            if (isset($_POST['caracteristicas'])) {
                $caracteristicas = '';
                foreach ($_POST['caracteristicas'] as $value) {
                    if ($caracteristicas!='') $caracteristicas.=' | ';
                    $caracteristicas.= $value;
                    } 
            } else {
                $caracteristicas = null;
            }

            if (isset($_POST['idPublicacao'])) {
                $idPublicacao = '';
                foreach ($_POST['idPublicacao'] as $value) {
                    if ($idPublicacao!='') $idPublicacao.=' | ';
                    $idPublicacao.= $value;
                    } 
            } else {
                $idPublicacao = null;
            }

            if(isset($_FILES['fotos'])) {
                $fotos = $_FILES['fotos'];
            } else {
                $fotos = array();
            }

            $mc->editMateriaContratada($idContrato, $idMateria, $idPublicacao, $idStatus, $idUserProducao, $idUserAprovacao, $idPacote, $prazo, $empresa, $obs, $dataProducao, $dataLimite, $dataExpiracao, $dataAlteracao, $idUserAlteracao, $idCategoria, $frasedestaque, $descricao, $produtos, $palavrasChave, $metadescricao, $telefone, $celular, $email, $website, $facebook, $whatsapp, $linkedin, $instagram, $twitter, $youtube, $linkVideo, $dataInicio, $dataTermino, $orcamento, $locais, $diasSemana, $horarioInicial, $horarioFinal, $caracteristicas, $pesqEndereco, $endereco, $numero, $complemento, $bairro, $cidade, $uf, $cep, $latitude, $longitude, $fotos, $_GET['id']);
            ?>
                <div class="alert alert-success">
                    Matéria alterada com sucesso!
                </div>
            <?php 
        }   
        
        if (isset($_GET['id']) && !empty($_GET['id']) || empty($materiaContratada)) {
            $materiaContratada = $mc->getMateriaContratada($_GET['id']);               

            // linhas para ativar ou desativar os campos de publicação e de datas
            // matérias: peça de mídia, postagens, google ads, vídeo e cartão
            if ($materiaContratada['idMateria'] == 4 || $materiaContratada['idMateria'] == 5 || $materiaContratada['idMateria'] == 15 || $materiaContratada['idMateria'] == 17 || $materiaContratada['idMateria'] == 18 || $materiaContratada['idMateria'] == 20) {
                $ocultaPublicacao = true;
            } else {
                $ocultaPublicacao = false;
            }
            // materias de banners
            if ($materiaContratada['idMateria'] == 9 || $materiaContratada['idMateria'] == 10 || $materiaContratada['idMateria'] == 11 || $materiaContratada['idMateria'] == 12 || $materiaContratada['idMateria'] == 13 || $materiaContratada['idMateria'] == 14) {
                $ocultaDatas = true;
            } else {
                $ocultaDatas = false;
            }
            
            if (empty($materiaContratada)) {
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
    <form method="POST" enctype="multipart/form-data" autocomplete="off">

        <ul class="errorMessages fade show"></ul>  

        <div class="form-row mb-2">
            <!-- Coluna 1: Dados Externa-->
            <div class="col-lg-8 col-md-6">
            
                <ul class="nav nav-tabs mb-3" id="tabDadosMateria" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="principal-tab" data-toggle="tab" href="#principal" role="tab" aria-controls="principal" aria-selected="true">Principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="informacoes-tab" data-toggle="tab" href="#informacoes" role="tab" aria-controls="informacoes" aria-selected="false">Informações</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contato-tab" data-toggle="tab" href="#contato" role="tab" aria-controls="contato" aria-selected="false">Dados de Contato</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="redessociais-tab" data-toggle="tab" href="#redessociais" role="tab" aria-controls="redessociais" aria-selected="false">Redes Sociais</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="midias-tab" data-toggle="tab" href="#midias" role="tab" aria-controls="midias" aria-selected="false">Mídias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="maisinformacoes-tab" data-toggle="tab" href="#maisinformacoes" role="tab" aria-controls="maisinformacoes" aria-selected="false">Mais Informações</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="localizacao-tab" data-toggle="tab" href="#localizacao" role="tab" aria-controls="localizacao" aria-selected="false">Localização</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="postagens-tab" data-toggle="tab" href="#postagens" role="tab" aria-controls="postagens" aria-selected="false">Postagens</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="googleads-tab" data-toggle="tab" href="#googleads" role="tab" aria-controls="googleads" aria-selected="false">Google Ads</a>
                    </li>
                </ul>

                <div class="tab-content" id="tabDadosMateriaConteudo">
                                
                    <div class="tab-pane fade show active" id="principal" role="tabpanel" aria-labelledby="principal-tab">
                        <div class="form-row mb-2">
                            <div class="col">

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="empresa">Nome da Empresa</label>
                                        <input class="form-control" type="text" name="empresa" id="empresa" value="<?php echo $materiaContratada['empresa']?>"required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-lg-6 col-md-12">
                                        <label for="idMateria">Matéria</label>
                                        <select class="form-control" name="idMateria" id="idMateria" onchange="alteraMateria(this); ocultaTabs(this)" required>
                                            <option value="">Selecione a Matéria</option>
                                                <?php 
                                                require '../../../classes/materias.class.php';
                                                $mt = new Materias();
                                                $materias = $mt->getMaterias();

                                                foreach ($materias as $materia) {
                                                    $grupos[$materia['tipoMateria']][$materia['id']] = $materia['materia'];
                                                    $prazos[$materia['id']] = $materia['prazo'];

                                                }
                                                    foreach($grupos as $rotulo => $opt): ?>
                                                        <optgroup label="<?php echo $rotulo; ?>">
                                                            <?php foreach ($opt as $id => $nome): ?>

                                                                <option value="<?php echo $id; ?>" <?php echo ($materiaContratada['idMateria']==$id)?'selected="selected"':''; ?> data-prazo="<?php
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
                                                    <option value="<?php echo $pacote['id'];?>"<?php echo ($materiaContratada['idPacote']==$pacote['id'])?'selected="selected"':''; ?>><?php echo $pacote['pacote'];?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-3 col-md-12"> 
                                        <label for="prazo">Prazo da Matéria</label>
                                        <select class="form-control" name="prazo" id="prazo" onchange="alteraPrazoMateria(this)" required <?php echo ($materiaContratada['idMateria'] == 4 || $materiaContratada['idMateria'] == 17 || $materiaContratada['idMateria'] == 18)?'disabled':'';?>> 
                                            <option value=""<?php echo $materiaContratada['prazo']==''?'selected':'';?>>Selecione o Prazo</option>
                                            <option value="30"<?php echo $materiaContratada['prazo']=='30'?'selected':'';?>>1 Mês</option>
                                            <option value="60"<?php echo $materiaContratada['prazo']=='60'?'selected':'';?>>2 Meses</option>
                                            <option value="90"<?php echo $materiaContratada['prazo']=='90'?'selected':'';?>>3 Meses</option>
                                            <option value="180"<?php echo $materiaContratada['prazo']=='180'?'selected':'';?>>6 Meses</option>
                                            <option value="365"<?php echo $materiaContratada['prazo']=='365'?'selected':'';?>>1 Ano</option>
                                        </select>
                                    </div>                                    
                                </div>

                                <div class="form-row">

                                    <?php $publicacao = $materiaContratada['idPublicacao'];  // obtém os dados do campos 

                                    if ($publicacao !== null ) {
                                        $publicacoesArray = explode(" | ",$publicacao); // transforma em array 
                                    } else {
                                        $publicacoesArray = array();
                                    }

                                    ?>

                                    <div class="form-group col-lg-12 col-md-12" id="divIdPublicacao" style="display:<?php echo ($ocultaPublicacao == true) ?'none':'block';?>"> 

                                        <label for="idPublicacao">Publicação</label>
                                        <select class="form-control publicacao-select2" name="idPublicacao[]" id="idPublicacao" multiple="multiple" required <?php echo ($ocultaPublicacao == true) ? 'disabled':'';?>>
                                            <?php 
                                                require '../../../classes/publicacoes.class.php';
                                                $p = new Publicacoes();
                                                $publicacoes = $p->getPublicacoes();
                                                foreach($publicacoes as $publicacao): ?>
                                                    
                                                    <option value="<?php echo $publicacao['id'];?>"<?php echo in_array($publicacao['id'], $publicacoesArray) ? "selected":"" ?>><?php echo $publicacao['publicacao']; ?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>                                

                                <div class="form-row">
                                    <div class="form-group col-lg-4 col-md-12">
                                        <label id="lblDataProducao" for="dataProducao">Produção (-2 Dias) <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Prazo de produção deste item. Prazo da Matéria - 2 Dias."></i></label> 
                                        <input class="form-control" type="date" name="dataProducao" id="dataProducao" value="<?php echo date("Y-m-d" , strtotime($materiaContratada['dataProducao']));?>" <?php echo ($ocultaDatas == true) ? '':'disabled';?>>
                                    </div>

                                    <div class="form-group col-lg-4 col-md-12">
                                        <label id="lblDataLimite" for="dataLimite">Data Limite </label> <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Prazo limite de conclusão e envio deste item. Data de inclusão + Prazo da Matéria."></i>
                                        <input class="form-control" type="date" name="dataLimite" id="dataLimite" value="<?php echo date("Y-m-d" , strtotime($materiaContratada['dataLimite']));?>" <?php echo ($ocultaDatas == true) ?'':'disabled';?>>
                                    </div>

                                    <div class="form-group col-lg-4 col-md-12">
                                        <?php $diasExpiracao = isset($materiaContratada['prazo']) ? ($materiaContratada['prazo']) : null; ?>
                                        <label id="lblDataExpiracao" for="dataExpiracao">Expiração (+<?php echo $diasExpiracao; ?> Dias)</label> <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Data de expiração deste item."></i>
                                        <input class="form-control" type="date" name="dataExpiracao" id="dataExpiracao" value="<?php echo $materiaContratada['dataExpiracao']== null ? '' : date("Y-m-d" , strtotime($materiaContratada['dataExpiracao'])) ?>" <?php echo ($ocultaDatas == true) ?'':'disabled';?>>
                                    </div>
                                </div> 

                                <div class="form-row">   
                                    <div class="form-group col-md-12"> 
                                        <label for="obs">Observações</label>
                                        <textarea class="form-control" name="obs" id="obs"><?php echo $materiaContratada['obs'];?></textarea>
                                    </div>
                                </div>
                           
                                <!-- dados de registro e alteração -->
                                <div class="form-row">
                                    <div class="form-group col-lg-3 col-md-6">
                                        <label for="name"><small>Registrado por</small></label>
                                        <input class="form-control form-control-sm" type="text" name="name" id="name" value="<?php echo $materiaContratada['nomeUsuario'] ?>" readonly>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6"> 
                                        <label for="dataRegistro"><small>Data de Registro</small></label>
                                        <?php $dataRegistro = strtotime($materiaContratada['dataRegistro']);?>
                                        <input class="form-control form-control-sm" type="text" name="dataRegistro" id="dataRegistro" value="<?php echo date('d/m/Y H:i:s',$dataRegistro); ?>" readonly>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6">
                                        <label for="userAlteracao"><small>Alterado por</small></label>
                                        <input class="form-control form-control-sm" type="text" name="userAlteracao" id="userAlteracao" value="<?php echo $materiaContratada['userAlteracao']== null ? 'Sem Alterações' : $materiaContratada['userAlteracao'] ?>" readonly>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6"> 
                                        <label for="dataAlteracao"><small>Data de Alteração</small></label>
                                        <?php $dataAlteracao = strtotime($materiaContratada['dataAlteracao']);?>
                                        <input class="form-control form-control-sm" type="text" name="dataAlteracao" id="dataAlteracao" value="<?php echo $materiaContratada['dataAlteracao']== 0 ? 'Sem Alterações' : date('d/m/Y H:i:s',$dataAlteracao); ?>" readonly>
                                    </div>
                                </div> 

                                <!-- campos ocultos --> 
                                <div class="form-row">
                                    <input type="hidden" name="idMateriaContratada" value="<?php echo $materiaContratada['id'];?>"> 
                                    <input type="hidden" name="idContrato" id="idContrato" value="<?php echo $materiaContratada['idContrato'];?>"> 
                                    <input type="hidden" name="id" value="<?php echo $materiaContratada['id']; ?>">
                                    <input type="hidden" name="dataCt" id="dataCt" value="<?php echo $materiaContratada['dataCt']; ?>">
                                    <input type="hidden" name="prazoCt" id="prazoCt" value="<?php echo $materiaContratada['prazoCt']; ?>">
                                    <input type="hidden" name="dataExpiracaoCt" id="dataExpiracaoCt" value="<?php echo date('Y-m-d', strtotime($materiaContratada['dataLimite']. ' + '.$materiaContratada['prazoCt'].' days')); ?>">
                                    <input type="hidden" name="contaMaterias" id="contaMaterias">                                    
                                    <input type="hidden" name="acao" id="acao" value="edit">
                                    <input type="hidden" name="ultimaData" id="ultimaData">
                                    <input type="hidden" name="dataLimite2" id="dataLimite2" value="<?php echo date("Y-m-d H:i:s.u" , strtotime($materiaContratada['dataLimite']));?>">
                                    <input type="hidden" name="prazoDias" id="prazoDias" value="<?php echo $materiaContratada['prazo'];?>">
                                    <input type="hidden" name="dataRegistroF" id="dataRegistroF" value="<?php echo $materiaContratada['dataLimite'];?>">
                                </div>
                            </div>
                        </div> 
                    </div>

                    <div class="tab-pane fade show" id="informacoes" role="tabpanel" aria-labelledby="informacoes-tab">
                        <div class="form-row mb-2">
                            <div class="col">

                                <div class="form-group">
                                    <label for="slug">Link Permanente <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Endereço da publicação. O mesmo será alterado se o nome da empresa mudar."></i></label>
                                    <div class="input-group">                                   
                                        <div class="input-group-prepend" aria-hidden="true">
                                            <span class="input-group-text" id="inputGroupPrepend">https://portaldenegocios.com/empresas/</span>
                                        </div>
                                        <input class="form-control" type="text" name="slug" id="slug" value="<?php echo slugify($materiaContratada['empresa']); ?>">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="idCategoria">Categoria</label>
                                        <select class="form-control" name="idCategoria" id="idCategoria">
                                            <option value="">Selecionar Categoria</option>

                                            <?php
                                                require "../../../classes/categorias.class.php";
                                                $c = new Categorias();
                                                $cats = $c->getLista();
                                                foreach($cats as $cat): ?>
                                                    <option value="<?php echo $cat['id'];?>" <?php echo ($materiaContratada['idCategoria']==$cat['id'])?'selected="selected"':''; ?>><?php echo $cat['categoria'];?></option>
                                                <?php endforeach;?>
                                        </select>
                                    </div>                            
                                </div>

                                <div class="form-group">
                                    <label for="frasedestaque">Frase de Destaque (Plano Premium)</label>
                                    <input class="form-control" type="text" name="frasedestaque" id="frasedestaque" value="<?php echo $materiaContratada['frasedestaque']?>">
                                </div>

                                <div class="form-group">
                                    <label for="descricao">Descrição da Empresa</label>
                                    <textarea class="form-control" name="descricao" id="descricao"><?php echo $materiaContratada['descricao'];?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="produtos">Produtos e Serviços</label>
                                    <textarea class="form-control" name="produtos" id="produtos"><?php echo $materiaContratada['produtos'];?></textarea>
                                </div>                        

                                <div class="form-group">
                                    <?php $palavrasChave = $materiaContratada['palavrasChave'];  // obtém os dados do campos 

                                    if ($palavrasChave !== null ) {
                                        $palavrasArray = explode(" | ",$palavrasChave); // transforma em array 
                                    } 

                                    ?>

                                    <label for="palavrasChave">Palavras Chave</label>
                                    <select class="form-control js-palavrasChave" name="palavrasChave[]" id="palavrasChave" multiple="multiple">
                                        <option disabled="true">Insira as tags separando-as por vírgulas.</option>
                                        <?php foreach($palavrasArray as $palavraArray): ?>
                                        <option value="<?php echo $palavraArray;?>" selected><?php echo $palavraArray;?> </option>
                                        <?php endforeach;?>

                                    </select> 
                                </div>

                                <div class="form-group">
                                    <label for="metadescricao">Metadescrição Web</label>
                                    <textarea class="form-control" name="metadescricao" id="metadescricao"><?php echo $materiaContratada['metadescricao'];?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade show" id="contato" role="tabpanel" aria-labelledby="contato-tab">
                        <div class="form-row mb-2">
                            <div class="col">
                                <!-- conjunto de campos de contato --> 
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="telefone">Telefone</label>
                                        <input class="form-control" type="text" name="telefone" id="telefone" value="<?php echo $materiaContratada['telefone']?>">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="celular">Celular</label>
                                        <input class="form-control" type="text" name="celular" id="celular" value="<?php echo $materiaContratada['celular']?>">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="email">E-mail</label>
                                        <input class="form-control" type="email" name="email" id="email" value="<?php echo $materiaContratada['email']?>">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="website">Website</label>
                                        <input class="form-control" type="url" name="website" id="website" placeholder="https://" value="<?php echo $materiaContratada['website']?>">
                                    </div>
                                </div>
                                <!-- conjunto de campos de contato --> 
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade show" id="redessociais" role="tabpanel" aria-labelledby="redessociais-tab">
                        <div class="form-row mb-2">
                            <div class="col">
                                <!-- conjunto de botões redes sociais -->  
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Facebook">
                                                <span class="input-group-text" id="inputGroupPrepend"><i class="fab fa-facebook-f fa-fw"></i></span>
                                            </div>
                                            <input class="form-control" type="url" name="facebook" id="facebook" value="<?php echo $materiaContratada['facebook'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Instagram">
                                                <span class="input-group-text" id="inputGroupPrepend"><i class="fab fa-instagram fa-fw"></i></span>
                                            </div>
                                            <input class="form-control" type="url" name="instagram" id="instagram" value="<?php echo $materiaContratada['instagram'];?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6"> 
                                        <div class="input-group">
                                            <div class="input-group-prepend" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="WhatsApp">
                                                <span class="input-group-text" id="inputGroupPrepend"><i class="fab fa-whatsapp fa-fw"></i></span>
                                            </div>
                                            <input class="form-control" type="text" name="whatsapp" id="whatsapp" placeholder="(00) 00000-0000" value="<?php echo $materiaContratada['whatsapp'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6"> 
                                        <div class="input-group">
                                            <div class="input-group-prepend" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Twitter">
                                                <span class="input-group-text" id="inputGroupPrepend"><i class="fab fa-twitter fa-fw"></i></span>
                                            </div>
                                            <input class="form-control" type="url" name="twitter" id="twitter" value="<?php echo $materiaContratada['twitter'];?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6"> 
                                        <div class="input-group">
                                            <div class="input-group-prepend" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Linkedin">
                                                <span class="input-group-text" id="inputGroupPrepend"><i class="fab fa-linkedin fa-fw"></i></span>
                                            </div>
                                            <input class="form-control" type="url" name="linkedin" id="linkedin" value="<?php echo $materiaContratada['linkedin'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6"> 
                                        <div class="input-group">
                                            <div class="input-group-prepend" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="YouTube">
                                                <span class="input-group-text" id="inputGroupPrepend"><i class="fab fa-youtube fa-fw"></i></span>
                                            </div>
                                            <input class="form-control" type="url" name="youtube" id="youtube" value="<?php echo $materiaContratada['youtube'];?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- conjunto de botões redes sociais -->
                            </div>
                        </div>                
                    </div>

                    <div class="tab-pane fade show" id="midias" role="tabpanel" aria-labelledby="midias-tab">
                        <div class="form-row mb-2">
                            <div class="col">
                                <div class="form-group">
                                    <label for="fotos">Imagens da Matéria</label>
                                    <input type="file" name="fotos[]" multiple>

                                    <div class="card mt-2">
                                        <div class="card-header"><i class="far fa-image"></i> Imagens da Matéria</div>
                                        <div class="card-body">
                                            <div class="row">
                                                <?php if ($materiaContratada['fotos'] == null) {
                                                    echo "Não há imagens para esta matéria.";
                                                } ?>                                    
                                                    <?php foreach ($materiaContratada['fotos'] as $foto):?>
                                                        <div class="col-md-2">

                                                            <a href="../../../images/materias/<?php echo $foto['url'];?>" data-toggle="lightbox" data-gallery="images-gallery">
                                                                <img class="img-thumbnail" src="../../../images/materias/<?php echo $foto['url']; ?>" title="<?php echo $foto['titulo'];?>" border="0">
                                                            </a>

                                                            <a class="btn btn-danger mt-2 mb-3 btn-sm btn-block" href="delete-image.php?id=<?php echo $foto['id']; ?>" onclick="return confirm('Tem certeza de que deseja excluir esta imagem?');"><i class="fa fa-trash"></i> Excluir</a>
                                                        </div>
                                                    <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                        
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="linkVideo">Link de Vídeo YouTube</label>
                                <div class="input-group">
                                    <input type="url" class="form-control" name="linkVideo" id="linkVideo" placeholder="Cole o link, por exemplo: https://www.youtube.com/watch?v=OK_JCtrrv-c" value="<?php echo $materiaContratada['linkVideo']?>">
                                    <div class="input-group-append">
                                        <a class="btn btn-primary" href="#" role="button" onclick="youtubeDownload(linkVideo)">Baixar Vídeo</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <script>
                        
                    </script>

                    <div class="tab-pane fade show" id="maisinformacoes" role="tabpanel" aria-labelledby="maisinformacoes-tab">
                        <div class="form-row mb-2">
                            <div class="col">
                                <!-- conjunto de checkboxes características -->  
                                <div class="form-row">
                                    <div class="form-group col">

                                        <?php $caracteristicas = $materiaContratada['caracteristicas'];  // obtém os dados do campos 

                                        if ($caracteristicas !== null ) {
                                            $caracteristicasArray = explode(" | ",$caracteristicas); // transforma em array 
                                        } else {
                                            $caracteristicasArray = array();
                                        }
                                       
                                        ?>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input name="caracteristicas[]" class="custom-control-input" type="checkbox" value="check-a" id="check-a" <?php echo in_array("check-a", $caracteristicasArray) ? "checked='checked'":"";?>>
                                            <label class="custom-control-label" for="check-a">Aceita Cartão de Crédito</label>
                                        </div>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input name="caracteristicas[]" class="custom-control-input" type="checkbox" value="check-b" id="check-b" <?php echo in_array("check-b", $caracteristicasArray) ? "checked='checked'":"";?>>
                                            <label class="custom-control-label" for="check-b">Aceita Pedidos Online</label>
                                        </div>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input name="caracteristicas[]" class="custom-control-input" type="checkbox" value="check-c" id="check-c" <?php echo in_array("check-c", $caracteristicasArray) ? "checked='checked'":"";?>>
                                            <label class="custom-control-label" for="check-c">Empresa Exportadora</label>
                                        </div>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input name="caracteristicas[]" class="custom-control-input" type="checkbox" value="check-d" id="check-d" <?php echo in_array("check-d", $caracteristicasArray) ? "checked='checked'":"";?>>
                                            <label class="custom-control-label" for="check-d">Entrega em Domicílio</label>
                                        </div>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input name="caracteristicas[]" class="custom-control-input" type="checkbox" value="check-e" id="check-e" <?php echo in_array("check-e", $caracteristicasArray) ? "checked='checked'":"";?>>
                                            <label class="custom-control-label" for="check-e">Estacionamento Grátis</label>
                                        </div>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input name="caracteristicas[]" class="custom-control-input" type="checkbox" value="check-f" id="check-f" <?php echo in_array("check-f", $caracteristicasArray) ? "checked='checked'":"";?>>
                                            <label class="custom-control-label" for="check-f">Orçamento Gratuito</label>
                                        </div>

                                    </div>
                                </div>                            
                                                      
                                <!-- conjunto de campos extra -->
                            </div>
                        </div>                
                    </div>

                    <div class="tab-pane fade show" id="localizacao" role="tabpanel" aria-labelledby="localizacao-tab">
                        <div class="form-row mb-2">
                            <div class="col">

                                <div class="form-group">
                                    <label for="pesqEndereco">Pesquisar Endereço</label>
                                    <input class="form-control" type="text" name="pesqEndereco" id="pesqEndereco" placeholder="Digite o endereço para pesquisar no Google Maps" size="104" value="<?php echo $materiaContratada['pesqEndereco']?>">
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="endereco">Endereço</label>
                                        <input class="form-control" type="text" name="endereco" id="endereco" value="<?php echo $materiaContratada['endereco']?>">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="numero">Número</label>
                                        <input class="form-control" type="text" name="numero" id="numero" maxlength="15" value="<?php echo $materiaContratada['numero']?>">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="complemento">Complemento</label>
                                        <input class="form-control" type="text" name="complemento" id="complemento" maxlength="35" value="<?php echo $materiaContratada['complemento']?>" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="bairro">Bairro</label>
                                    <input class="form-control" type="text" name="bairro" id="bairro"  value="<?php echo $materiaContratada['bairro']?>">
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="cidade">Cidade</label>
                                        <input class="form-control" type="text" name="cidade" id="cidade"  value="<?php echo $materiaContratada['cidade']?>" ></label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="uf">Estado</label>
                                        <input class="form-control" type="text" name="uf" id="uf"  value="<?php echo $materiaContratada['uf']?>" ></label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="cep">CEP <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Digite o CEP e pressione a tecla TAB para preencher os campos automaticamente."></i></label>
                                        <input class="form-control" type="text" name="cep" id="cep" value="<?php echo $materiaContratada['cep']?>" ></label>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="latitude">Latitude</label>
                                            <input class="form-control" type="text" name="latitude" id="latitude" value="<?php echo $materiaContratada['latitude']?>"/>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="longitude">Longitude</label>
                                            <input class="form-control" type="text" name="longitude" id="longitude" value="<?php echo $materiaContratada['longitude']?>"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">                            
                                    <div id="map-canvas"></div>
                                    <!-- configurado em lib/js/google-maps.js-->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade show" id="postagens" role="tabpanel" aria-labelledby="postagens-tab">
                        <?php include 'postagens-materia.php'; ?>
                    </div>

                    <div class="tab-pane fade show" id="googleads" role="tabpanel" aria-labelledby="googleads-tab">
                        <?php include 'anuncios-google-ads.php'; ?>
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
                                        <option value="<?php echo $status['id'];?>"<?php echo ($materiaContratada['idStatus']==$status['id'])?'selected="selected"':''; ?>><?php echo $status['status'];?></option>
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
                                    <option value="<?php echo $usuario['id'];?>"<?php echo ($materiaContratada['idUserProducao']==$usuario['id'])?'selected="selected"':'';?>><?php echo $usuario['name'];?></option>
                                <?php endforeach;?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="idUserAprovacao">Atribuir Usuário de Aprovação</label> <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Usuário atribuído à aprovação desta matéria."></i>
                            <select class="form-control" name="idUserAprovacao" id="idUserAprovacao" required>
                                <option value="">Selecione Usuário</option>
                                <?php                                   

                                foreach($usuarios as $usuario): ?>
                                    <option value="<?php echo $usuario['id'];?>"<?php echo ($materiaContratada['idUserAprovacao']==$usuario['id'])?'selected="selected"':''; ?>><?php echo $usuario['name'];?></option>
                                <?php endforeach;?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="dataContrato">Data do Contrato <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Data de entrada do contrato."></i></label>
                            <input class="form-control" type="date" name="dataContrato" id="dataContrato" value="<?php echo date("Y-m-d" , strtotime($materiaContratada['dataCt']));?>" readonly>
                            <small class="form-text text-muted">Vigência do Contrato: <?php echo $materiaContratada['prazoCt'] ?> dias.</small>
                        </div>                        

                        <!-- botões -->
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" id="botaoSubmit" value="Salvar Alterações">
                            <a class="btn btn-danger" href="delete.php?id=<?php echo $materiaContratada['id']; ?>&idContrato=<?php echo $materiaContratada['idContrato']; ?>" onclick="return confirm('Tem certeza de que deseja remover?');" role="button">Excluir Matéria</a>
                        </div>

                    </div>
                </div> 
            </div>

        </div>
    </form>
</div>

<?php include 'postagens-modal.php';?>

<?php include (FOOTER_TEMPLATE);?>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnxkHFMUTb3jxNtaB1BNYPbLJ6nmfU5DM&libraries=places&callback=initialize"></script>

<script>
    $('form').submit(function(e) {
    $(':disabled').each(function(e) {
        $(this).removeAttr('disabled');
    })
});
</script>

<script> // função para contar e limitar caracteres
$('#titulo1').keyup(function(){limiting($(this), 30, '#counterT1');});
$('#titulo2').keyup(function(){limiting($(this), 30, '#counterT2');});
$('#titulo3').keyup(function(){limiting($(this), 30, '#counterT3');});
$('#titulo4').keyup(function(){limiting($(this), 30, '#counterT4');});
$('#titulo5').keyup(function(){limiting($(this), 30, '#counterT5');});
$('#titulo6').keyup(function(){limiting($(this), 30, '#counterT6');});
$('#titulo7').keyup(function(){limiting($(this), 30, '#counterT7');});
$('#titulo8').keyup(function(){limiting($(this), 30, '#counterT8');});
$('#titulo9').keyup(function(){limiting($(this), 30, '#counterT9');});
$('#titulo10').keyup(function(){limiting($(this), 30, '#counterT10');});
$('#titulo11').keyup(function(){limiting($(this), 30, '#counterT11');});
$('#titulo12').keyup(function(){limiting($(this), 30, '#counterT12');});
$('#titulo13').keyup(function(){limiting($(this), 30, '#counterT13');});
$('#titulo14').keyup(function(){limiting($(this), 30, '#counterT14');});
$('#titulo15').keyup(function(){limiting($(this), 30, '#counterT15');});

$('#descricao1').keyup(function(){limiting($(this), 90, '#counter1');});
$('#descricao2').keyup(function(){limiting($(this), 90, '#counter2');});
$('#descricao3').keyup(function(){limiting($(this), 90, '#counter3');});
$('#descricao4').keyup(function(){limiting($(this), 90, '#counter4');});

$('#titulo1Chamada').keyup(function(){limiting($(this), 30, '#counterT1Chamada');});
$('#titulo2Chamada').keyup(function(){limiting($(this), 30, '#counterT2Chamada');});
$('#descricao1Chamada').keyup(function(){limiting($(this), 90, '#counter1Chamada');});
$('#descricao2Chamada').keyup(function(){limiting($(this), 90, '#counter2Chamada');});

</script>

<script> // transforma o select .js-palavrasChave em select2
    $(document).ready(function() { 
        $('.js-palavrasChave').select2({
            width: '100%',  
            language: "pt-BR",
            theme: 'bootstrap4',
            tags: true,
            allowClear: true,
            tokenSeparators: [',']
        });
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

<script type="text/javascript" language="javascript"> // relacionado ao modal de postagens// relacionado ao modal de Postagens
    $(document).ready(function(){
        $('#addPost').click(function(){
            $('#posts_form')[0].reset();
            $('.modal-title').text("Adicionar Postagem");
            $('#action').val("Adicionar");
            $('#operation').val("Add");           
            $('#popupPosts').modal('hide');
        });

        var table = $('#tblPostagensMateria').DataTable();

        $(document).on('submit', '#posts_form', function(event){
            event.preventDefault();

            var titulo = $('#titulo').val();
            var dataPublicacao = $('#dataPublicacao').val();
            var idStatus = $('#idStatus').val();
            var urlFacebook = $('#urlFacebook').val();
            var urlInstagram = $('#urlInstagram').val();
            var urlLinkedin = $('#urlLinkedin').val();
            var urlTwitter = $('#urlTwitter').val();
            var urlFacebook_bitly = $('#urlFacebook_bitly').val();
            var urlInstagram_bitly = $('#urlInstagram_bitly').val();
            var urlLinkedin_bitly = $('#urlLinkedin_bitly').val();
            var urlTwitter_bitly = $('#urlTwitter_bitly').val();

            if(titulo != '' && dataPublicacao != '')
            {
                $.ajax({
                    url:"postagens-insert.php",
                    method:'POST',
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data)
                    {
                        alert('Os dados foram salvos com sucesso.');
                        $('#posts_form')[0].reset();
                        $('#postModal').modal('hide');
                        $('#popupPosts').modal('hide');
                        
                        table.ajax.reload(); // recarrega datatables
                    }
                });
            }
            else
            {
                alert("Ao menos título e data devem ser preenchidos.");
            }
        });
        
        $(document).on('click', '.update', function(){
            var id = $(this).attr("id");
            $.ajax({
                url:"postagens-fetch-single.php",
                method:"GET",
                data:{id:id},
                dataType:"json",
                success:function(data)
                {
                    // convertendo data e preenchendo através da biblioteca Moment.js
                    var dataPublicacaoConvertida = new Date(data.dataPublicacao);
                    var dateString = moment(dataPublicacaoConvertida).format('YYYY-MM-DD');
                    $('#dataPublicacao').val(dateString);
                    $('#postModal').modal('show');
                    $('#titulo').val(data.titulo);
                    $("#idStatusPosts").val(data.idStatus);
                    $('#urlFacebook').val(data.urlFacebook);
                    $('#urlInstagram').val(data.urlInstagram);
                    $('#urlLinkedin').val(data.urlLinkedin);
                    $('#urlTwitter').val(data.urlTwitter);
                    $('#urlFacebook_bitly').val(data.urlFacebook_bitly);
                    $('#urlInstagram_bitly').val(data.urlInstagram_bitly);
                    $('#urlLinkedin_bitly').val(data.urlLinkedin_bitly);
                    $('#urlTwitter_bitly').val(data.urlTwitter_bitly);
                    $('.modal-title').text("Editar Postagem");
                    $('#id').val(id);             
                    $('#action').val("Salvar");
                    $('#operation').val("Edit");
                }
            })
        });
        
        $(document).on('click', '.delete', function(){
            var id = $(this).attr("id");
            if(confirm("Tem certeza de que deseja excluir?"))
            {
                $.ajax({
                    url:"postagens-delete.php",
                    method:"GET",
                    data:{id:id},
                    success:function(data)
                    {
                        alert('O registro foi excluído com sucesso.');
                        table.ajax.reload(); // recarrega datatables
                    }
                });
            }
            else
            {
                return false;   
            }
        });
    }); 
</script>

<script type="text/javascript" language="javascript"> // relacionado ao modal de Google Ads
    // anúncios responsivos
    $(document).ready(function(){
        $('#addAdResponsivo').click(function(){
            $('#ads_form')[0].reset();
            $('.modal-title').text("Adicionar Anúncio Responsivo");
            $('#actionAds').val("Adicionar");
            $('#operationAds').val("Add");
            //$('#popupAds').modal('hide');
            $('#counterT1,#counterT2,#counterT3,#counterT4,#counterT5,#counterT6,#counterT7,#counterT8,#counterT9,#counterT10,#counterT11,#counterT12,#counterT13,#counterT14,#counterT15').text('0/30');
            $('#counter1,#counter2,#counter3,#counter4').text('0/90')
        });

        var table = $('#tblAdsMateria').DataTable();

        $(document).on('submit', '#ads_form', function(event){
            event.preventDefault();

            var urlFinal = $('#urlFinal').val();
            var urlVisualizacao = $('#urlVisualizacao').val();            

            if(urlFinal != '' && urlVisualizacao != '')
            {
                $.ajax({
                    url:"googleads-insert.php",
                    method:'POST',                    
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data)
                    {
                        alert('Os dados foram salvos com sucesso.');
                        $('#ads_form')[0].reset();
                        $('#adsModal').modal('hide');
                        $('#popupAds').modal('hide');
                        
                        table.ajax.reload(); // recarrega datatables
                    }
                });
            }
            else
            {
                alert("Ao menos as URL Final e de Visualização devem ser preenchidas.");
            }
        });
        
        $(document).on('click', '.updateAds', function(){
            var id = $(this).attr("id");
            $.ajax({
                url:"googleads-fetch-single.php",
                method:"GET",
                data:{id:id},
                dataType:"json",
                success:function(data)
                {
                    $('#adsModal').modal('show');                    
                    $('#urlFinal').val(data.urlFinal);
                    $('#urlVisualizacao').val(data.urlVisualizacao);

                    // preenchendo os campos de dados
                    $('#titulo1').val(data.titulo1);    $('#titulo2').val(data.titulo2);    $('#titulo3').val(data.titulo3);
                    $('#titulo4').val(data.titulo4);    $('#titulo5').val(data.titulo5);    $('#titulo6').val(data.titulo6);
                    $('#titulo7').val(data.titulo7);    $('#titulo8').val(data.titulo8);    $('#titulo9').val(data.titulo9);
                    $('#titulo10').val(data.titulo10);  $('#titulo11').val(data.titulo11);  $('#titulo12').val(data.titulo12);
                    $('#titulo13').val(data.titulo13);  $('#titulo14').val(data.titulo14);  $('#titulo15').val(data.titulo15);
                    $('#descricao1').val(data.descricao1); $('#descricao2').val(data.descricao2); $('#descricao3').val(data.descricao3); $('#descricao4').val(data.descricao4);

                    // definindo as variáveis de limites de caracteres
                    var lt = '30';
                    var ld = '90';
                    var a = 0 // contando os títulos e adicionando mais um a cada um não vazio
                    var b = 0 // contando as descrições e adicionando mais um a cada um não vazio

                    // checando quantos caracteres tem nos campos
                    if (data.titulo1 != null && data.titulo1.length > 1) {var t1 = data.titulo1.length;} else {var t1 = 0;}
                    if (data.titulo2 != null && data.titulo2.length > 1) {var t2 = data.titulo2.length;} else {var t2 = 0;}
                    if (data.titulo3 != null && data.titulo3.length > 1) {var t3 = data.titulo3.length;} else {var t3 = 0;}
                    if (data.titulo4 != null && data.titulo4.length > 1) {var t4 = data.titulo4.length;(a++);} else {var t4 = 0;}
                    if (data.titulo5 != null && data.titulo5.length > 1) {var t5 = data.titulo5.length;(a++);} else {var t5 = 0;}
                    if (data.titulo6 != null && data.titulo6.length > 1) {var t6 = data.titulo6.length;(a++);} else {var t6 = 0;}
                    if (data.titulo7 != null && data.titulo7.length > 1) {var t7 = data.titulo7.length;(a++);} else {var t7 = 0;}
                    if (data.titulo8 != null && data.titulo8.length > 1) {var t8 = data.titulo8.length;(a++);} else {var t8 = 0;}
                    if (data.titulo9 != null && data.titulo9.length > 1) {var t9 = data.titulo9.length;(a++);} else {var t9 = 0;}
                    if (data.titulo10 != null && data.titulo10.length > 1) {var t10 = data.titulo10.length;(a++);} else {var t10 = 0;}
                    if (data.titulo11 != null && data.titulo11.length > 1) {var t11 = data.titulo11.length;(a++);} else {var t11 = 0;}
                    if (data.titulo12 != null && data.titulo12.length > 1) {var t12 = data.titulo12.length;(a++);} else {var t12 = 0;}
                    if (data.titulo13 != null && data.titulo13.length > 1) {var t13 = data.titulo13.length;(a++);} else {var t13 = 0;}
                    if (data.titulo14 != null && data.titulo14.length > 1) {var t14 = data.titulo14.length;(a++);} else {var t14 = 0;}
                    if (data.titulo15 != null && data.titulo15.length > 1) {var t15 = data.titulo15.length;(a++);} else {var t15 = 0;}

                    console.log(a)

                    // checando quantos caracteres tem nos campos. estando vazio, zera
                    if (data.descricao1 != null && data.descricao1.length > 1) {var d1 = data.descricao1.length;} else {var d1 = 0;}
                    if (data.descricao2 != null && data.descricao2.length > 1) {var d2 = data.descricao2.length;} else {var d2 = 0;} 
                    if (data.descricao3 != null && data.descricao3.length > 1) {var d3 = data.descricao3.length;(b++);} else {var d3 = 0;} 
                    if (data.descricao4 != null && data.descricao4.length > 1) {var d4 = data.descricao4.length;(b++);} else {var d4 = 0;} 

                    // preenchendo os contadores dos títulos
                    $('#counterT1').text(t1+'/'+lt);    $('#counterT2').text(t2+'/'+lt);    $('#counterT3').text(t3+'/'+lt);
                    $('#counterT4').text(t4+'/'+lt);    $('#counterT5').text(t5+'/'+lt);    $('#counterT6').text(t6+'/'+lt); 
                    $('#counterT7').text(t7+'/'+lt);    $('#counterT8').text(t8+'/'+lt);    $('#counterT9').text(t9+'/'+lt);
                    $('#counterT10').text(t10+'/'+lt);  $('#counterT11').text(t11+'/'+lt);  $('#counterT12').text(t12+'/'+lt); 
                    $('#counterT13').text(t13+'/'+lt);  $('#counterT14').text(t14+'/'+lt);  $('#counterT15').text(t15+'/'+lt);

                    console.log(b)

                    // preenchendo os contadores das descrições
                    $('#counter1').text(d1+'/'+ld); $('#counter2').text(d2+'/'+ld); $('#counter3').text(d3+'/'+ld); $('#counter4').text(d4+'/'+ld); 

                    // definindo os textos dos elementos
                    $('.modal-title').text("Editar Anúncio Responsivo");
                    $('#idAds').val(id);
                    $('#contaTitulos').val(a);
                    $('#contaDescricoes').val(b);  
                    $('#actionAds').val("Salvar");
                    $('#operationAds').val("Edit");
                }
            })
        });
        
        $(document).on('click', '.deleteAds', function(){
            var id = $(this).attr("id");
            if(confirm("Tem certeza de que deseja excluir?"))
            {
                $.ajax({
                    url:"googleads-delete.php",
                    method:"GET",
                    data:{id:id},
                    success:function(data)
                    {
                        alert('O registro foi excluído com sucesso.');
                        table.ajax.reload(); // recarrega datatables
                    }
                });
            }
            else
            {
                return false;   
            }
        });
    });

    // anúncios de chamadas
    $(document).ready(function(){
        $('#addAdChamada').click(function(){
            $('#adsChamada_form')[0].reset();
            $('.modal-title').text("Adicionar Anúncio de Chamada");
            $('#actionAdsChamada').val("Adicionar");
            $('#operationAdsChamada').val("Add");
            $('#counterT1Chamada,#counterT2Chamada').text('0/30');
            $('#counter1Chamada,#counter2Chamada').text('0/90')
        });

        var table = $('#tblAdsMateriaChamadas').DataTable();

        $(document).on('submit', '#adsChamada_form', function(event){
            event.preventDefault();

            var urlFinalChamada = $('#urlFinalChamada').val();
            var urlVisualizacaoChamada = $('#urlVisualizacaoChamada').val();            

            if(urlFinalChamada != '' && urlVisualizacaoChamada != '')
            {
                $.ajax({
                    url:"googleadsChamada-insert.php",
                    method:'POST',                    
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data)
                    {
                        alert('Os dados foram salvos com sucesso.');
                        $('#adsChamada_form')[0].reset();
                        $('#adsModalChamada').modal('hide');
                        $('#popupAds').modal('hide');
                        
                        table.ajax.reload(); // recarrega datatables
                    }
                });
            }
            else
            {
                alert("Ao menos as URL Final e de Visualização devem ser preenchidas.");
            }
        });
        
        $(document).on('click', '.updateAdsChamada', function(){
            var id = $(this).attr("id");
            $.ajax({
                url:"googleadsChamada-fetch-single.php",
                method:"GET",
                data:{id:id},
                dataType:"json",
                success:function(data)
                {
                    $('#adsModalChamada').modal('show');                    
                    $('#urlFinalChamada').val(data.urlFinalChamada);
                    $('#urlVisualizacaoChamada').val(data.urlVisualizacaoChamada);

                    // preenchendo os campos de dados
                    $('#titulo1Chamada').val(data.titulo1Chamada); $('#titulo2Chamada').val(data.titulo2Chamada);    
                    $('#descricao1Chamada').val(data.descricao1Chamada); $('#descricao2Chamada').val(data.descricao2Chamada); 
                    $('#nomeEmpresa').val(data.nomeEmpresa); $('#numeroTel').val(data.numeroTel); 

                    // definindo as variáveis de limites de caracteres
                    var lt = '30';
                    var ld = '90';
                    var a = 0 // contando os títulos e adicionando mais um a cada um não vazio
                    var b = 0 // contando as descrições e adicionando mais um a cada um não vazio

                    // checando quantos caracteres tem nos campos
                    if (data.titulo1Chamada != null && data.titulo1Chamada.length > 1) {var t1 = data.titulo1Chamada.length;} else {var t1 = 0;}
                    if (data.titulo2Chamada != null && data.titulo2Chamada.length > 1) {var t2 = data.titulo2Chamada.length;} else {var t2 = 0;}
                    

                    console.log(a + ' caracteres')

                    // checando quantos caracteres tem nos campos. estando vazio, zera
                    if (data.descricao1Chamada != null && data.descricao1Chamada.length > 1) {var d1 = data.descricao1Chamada.length;} else {var d1 = 0;}
                    if (data.descricao2Chamada != null && data.descricao2Chamada.length > 1) {var d2 = data.descricao2Chamada.length;} else {var d2 = 0;} 
                    

                    // preenchendo os contadores dos títulos
                    $('#counterT1Chamada').text(t1+'/'+lt); $('#counterT2Chamada').text(t2+'/'+lt);

                    console.log(b)

                    // preenchendo os contadores das descrições
                    $('#counter1Chamada').text(d1+'/'+ld); $('#counter2Chamada').text(d2+'/'+ld);

                    // definindo os textos dos elementos
                    $('.modal-title').text("Editar Anúncio de Chamada");
                    $('#idAdsChamada').val(id);
                    $('#contaTitulosChamada').val(a);
                    $('#contaDescricoesChamada').val(b);  
                    $('#actionAdsChamada').val("Salvar");
                    $('#operationAdsChamada').val("Edit");
                }
            })
        });
        
        $(document).on('click', '.deleteAds', function(){
            var id = $(this).attr("id");
            if(confirm("Tem certeza de que deseja excluir?"))
            {
                $.ajax({
                    url:"googleadsChamada-delete.php",
                    method:"GET",
                    data:{id:id},
                    success:function(data)
                    {
                        alert('O registro foi excluído com sucesso.');
                        table.ajax.reload(); // recarrega datatables
                    }
                });
            }
            else
            {
                return false;   
            }
        });
    });
</script>