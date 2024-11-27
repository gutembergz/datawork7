<?php
session_start();
require_once '../../init.php';
require '../../check.php';
require '../../classes/materiasCt.class.php';
$mc = new MateriasCt();

$materiaContratada = $mc->getMateriaContratada($_GET['id']);

if (!empty($materiaContratada)) { 
    $pageTitle = 'Editar Inserção'; // breadcrumb

    if ($materiaContratada['nContrato'] != 0) {
        $parentPage = 'Contrato '.$materiaContratada['nContrato'].' - '.$materiaContratada['empresaCt']; // breadcrumb
        $parentLink = '../contratos/form-edit.php?id=' . $materiaContratada['idContrato']; // breadcrumb
    } else { 
        $parentPage = 'Cadastro de Inserções'; // breadcrumb
        $parentLink = '../portal'; // breadcrumb
    }


    //$parentPage = 'Contrato '.$materiaContratada['nContrato'].' - '.$materiaContratada['empresaCt']; // breadcrumb
    
    include (HEADER_TEMPLATE);
}
?>

<div class="container-fluid">
    
    <?php

        if (isset($_POST['idMateria']) && !empty($_POST['idMateria'])) {
            $idContrato = addslashes($_POST['idContrato']);
            $idMateria = addslashes($_POST['idMateria']);
            $idPublicacao = addslashes($_POST['idPublicacao']);
            $idStatus = addslashes($_POST['idStatus']);
            $idUserProducao = addslashes($_POST['idUserProducao']);
            $idUserAprovacao = addslashes($_POST['idUserAprovacao']);
            $idPacote = addslashes($_POST['idPacote']);

            $empresa = addslashes(trim($_POST['empresa']," ")); // a função trim remove os espaços antes e depois do campo preenchido
            $dataProducao = addslashes(dateConvert($_POST['dataProducao']));
            $dataLimite = addslashes(dateConvert($_POST['dataLimite']));
            $dataExpiracao = addslashes($_POST['dataExpiracao']);
            //$dataExpiracao = addslashes(dateConvert($_POST['dataExpiracao']));
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

            if(isset($_FILES['fotos'])) {
                $fotos = $_FILES['fotos'];
            } else {
                $fotos = array();
            }

            $mc->editMateriaContratada($idContrato, $idMateria, $idPublicacao, $idStatus, $idUserProducao, $idUserAprovacao, $idPacote, $empresa, $dataProducao, $dataLimite, $dataExpiracao, $dataAlteracao, $idUserAlteracao, $idCategoria, $frasedestaque, $descricao, $produtos, $palavrasChave, $metadescricao, $telefone, $celular, $email, $website, $facebook, $whatsapp, $linkedin, $instagram, $twitter, $youtube,$dataInicio, $dataTermino, $orcamento, $locais, $diasSemana, $horarioInicial, $horarioFinal, $caracteristicas, $pesqEndereco, $endereco, $numero, $complemento, $bairro, $cidade, $uf, $cep, $latitude, $longitude, $fotos, $_GET['id']);
            ?>
                <div class="alert alert-success">
                    Matéria alterada com sucesso!
                </div>
            <?php 
        }   
        
        if (isset($_GET['id']) && !empty($_GET['id']) || empty($materiaContratada)) {
            $materiaContratada = $mc->getMateriaContratada($_GET['id']);
            
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

                                    <div class="form-group col-md-4">
                                        <label for="idMateria">Matéria</label>
                                        <select class="form-control" name="idMateria" id="idMateria" onchange="alteraMateria(this); ocultaTabs(this)" required>
                                            <option value="">Selecione Matéria</option>
                                                <?php 
                                                require '../../classes/materias.class.php';
                                                $mt = new Materias();
                                                $materias = $mt->getMateriasPortal();

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

                                    <div class="form-group col-md-4">
                                        <label for="idPacote">Pacote</label>
                                        <select class="form-control" name="idPacote" id="idPacote" required>
                                            <option value="">Selecione Pacote</option>
                                            <option value="1" <?php echo $materiaContratada['idPacote']=='1'?'selected':'';?> >Pacote Start</option>
                                            <option value="2" <?php echo $materiaContratada['idPacote']=='2'?'selected':'';?> >Pacote Master</option>
                                            <option value="3" <?php echo $materiaContratada['idPacote']=='3'?'selected':'';?> >Pacote Supremo</option>
                                            <option value="4" <?php echo $materiaContratada['idPacote']=='4'?'selected':'';?> >Extras</option>
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
                                                    <option value="<?php echo $publicacao['id'];?>"<?php echo ($materiaContratada['idPublicacao']==$publicacao['id'])?'selected="selected"':''; ?>><?php echo $publicacao['publicacao'];?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>                        

                                <div class="form-row">
                                    <div class="form-group col-lg-4 col-md-6">
                                        <label id="lblDataProducao" for="dataProducao">Produção (-2 Dias) <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Prazo de produção deste item. Prazo da Matéria - 2 Dias."></i></label> 
                                        <input class="form-control" type="text" name="dataProducao" id="dataProducao" value="<?php echo date("d/m/Y" , strtotime($materiaContratada['dataProducao']));?>" readonly>                                  
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6">
                                        <label id="lblDataLimite" for="dataLimite">Data Limite </label> <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Prazo limite de conclusão e envio deste item. Data de inclusão + Prazo da Matéria."></i></label>
                                        <input class="form-control" type="text" name="dataLimite" id="dataLimite" value="<?php echo date("d/m/Y" , strtotime($materiaContratada['dataLimite']));?>" readonly>
                                    </div>

                                    <div class="form-group col-lg-4 col-md-12">
                                        <label id="lblDataExpiracao" for="dataExpiracao">Expiração</label> <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Data de expiração deste item."></i></label>
                                        <input class="form-control" type="date" name="dataExpiracao" id="dataExpiracao" value="<?php echo date("Y-m-d", strtotime($materiaContratada['dataExpiracao']));?>">
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
                                <input type="hidden" name="idMateriaContratada" value="<?php echo $materiaContratada['id'];?>"> 
                                <input type="hidden" name="idContrato" value="<?php echo $materiaContratada['idContrato'];?>"> 
                                <input type="hidden" name="id" value="<?php echo $materiaContratada['id']; ?>">
                                <input type="hidden" name="dataCt" id="dataCt" value="<?php echo $materiaContratada['dataCt']; ?>">
                                <input type="hidden" name="prazoCt" id="prazoCt" value="<?php echo $materiaContratada['prazoCt']; ?>">
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
                                            <?php
                                                require "../../classes/categorias.class.php";
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

                                                        <a href="../../images/materias/<?php echo $foto['url'];?>" data-toggle="lightbox" data-gallery="images-gallery">
                                                            <img class="img-thumbnail" src="../../images/materias/<?php echo $foto['url']; ?>" title="<?php echo $foto['titulo'];?>" border="0">
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
                    </div>

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
                                        <option value="<?php echo $status['id'];?>"<?php echo ($materiaContratada['idStatus']==$status['id'])?'selected="selected"':''; ?>><?php echo $status['status'];?></option>
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
                                    <option value="<?php echo $usuario['id'];?>"<?php echo ($materiaContratada['idUserProducao']==$usuario['id'])?'selected="selected"':'';?>><?php echo $usuario['name'];?></option>
                                <?php endforeach;?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="idUserAprovacao">Atribuir Usuário de Aprovação <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Usuário atribuído à aprovação desta matéria."></i></label>
                            <select class="form-control" name="idUserAprovacao" id="idUserAprovacao" required>
                                <option value="">Selecione Usuário</option>
                                <?php                                   

                                foreach($usuarios as $usuario): ?>
                                    <option value="<?php echo $usuario['id'];?>"<?php echo ($materiaContratada['idUserAprovacao']==$usuario['id'])?'selected="selected"':''; ?>><?php echo $usuario['name'];?></option>
                                <?php endforeach;?>

                            </select>
                        </div>                        

                        <!-- botões -->
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="Salvar Alterações">
                            <a class="btn btn-danger" href="delete.php?id=<?php echo $materiaContratada['id']; ?>&idContrato=<?php echo $materiaContratada['idContrato']; ?>" onclick="return confirm('Tem certeza de que deseja remover?');" role="button">Excluir Matéria</a>
                        </div>

                    </div>
                </div> 
            </div>

        </div>
    </form>
</div>

<?php include (FOOTER_TEMPLATE);?>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnxkHFMUTb3jxNtaB1BNYPbLJ6nmfU5DM&libraries=places&callback=initialize"></script>

<script>    
    $(document).ready(function() { // transforma o select .js-palavrasChave em select2
        $('.js-palavrasChave').select2({ 
            language: "pt-BR",
            theme: 'bootstrap4',
            tags: true,
            allowClear: true,
            tokenSeparators: [',']
        });
    });
</script>