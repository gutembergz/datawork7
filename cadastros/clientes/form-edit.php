<?php
session_start();
require_once '../../init.php';
require '../../check.php';
$pageTitle = 'Editar Cliente';
$parentPage = 'Clientes';

include (HEADER_TEMPLATE); ?>

<div class="container-fluid">

    <?php
    $idCliente = $_GET['id']; // pega o ID da URL - para exibir os contratos do mesmo 
    require '../../classes/clientes.class.php';
    $c = new Clientes();

    if (isset($_POST['empresa']) && !empty($_POST['empresa'])) {

        $empresa = addslashes($_POST['empresa']);
        $razaoSocial = addslashes($_POST['razaoSocial']);
        $autorizante = addslashes($_POST['autorizante']);
        $anunciante = addslashes($_POST['anunciante']);
        $endereco = addslashes($_POST['endereco']);
        $numero = addslashes($_POST['numero']);
        $complemento = addslashes($_POST['complemento']);
        $cidade = addslashes($_POST['cidade']);
        $uf = addslashes($_POST['uf']);
        $bairro = addslashes($_POST['bairro']);
        $cep = addslashes($_POST['cep']);
        $telefone = addslashes($_POST['telefone']);
        $celular = addslashes($_POST['celular']);
        $email = addslashes($_POST['email']);
        $website = addslashes($_POST['website']);
        $cnpj = addslashes($_POST['cnpj']);
        $cpf = addslashes($_POST['cpf']);
        $tipoCliente = addslashes($_POST['tipoCliente']);      
        $obs = addslashes($_POST['obs']);
        $apresentacao = addslashes($_POST['apresentacao']);
        $produtos = addslashes($_POST['produtos']);
        $areaAtuacao = addslashes($_POST['areaAtuacao']);
        $tipoEmpresa = addslashes($_POST['tipoEmpresa']);
        $fraseDestaque = addslashes($_POST['fraseDestaque']);
        $diferencial = addslashes($_POST['diferencial']);
        $video = addslashes($_POST['video']);
        $facebook = addslashes($_POST['facebook']);
        $whatsapp = addslashes($_POST['whatsapp']);
        $linkedin = addslashes($_POST['linkedin']);
        $instagram = addslashes($_POST['instagram']);
        $twitter = addslashes($_POST['twitter']);
        $youtube = addslashes($_POST['youtube']);

        $dataAlteracao = date("Y-m-d H:i:s"); // equivale à função now() em SQL
        $idUserAlteracao = addslashes($_SESSION['user_id']); // usuário que ALTERA
        
        if (isset($_POST['palavrasChave'])) {
            $palavrasChave = '';
            foreach ($_POST['palavrasChave'] as $value) {
                if ($palavrasChave!='') $palavrasChave.=' | ';
                $palavrasChave.= $value;
                } 
        } else {
            $palavrasChave = null;
        }

        if(isset($_FILES['fotos'])) {
            $fotos = $_FILES['fotos'];
        } else {
            $fotos = array();
        }      

        $c->editCliente($empresa, $razaoSocial, $autorizante, $anunciante, $endereco, $numero, $complemento, $cidade, $uf, $bairro, $cep, $telefone, $celular, $email, $website, $cnpj, $cpf, $tipoCliente, $obs, $apresentacao, $produtos, $areaAtuacao, $tipoEmpresa, $fraseDestaque, $diferencial, $video, $facebook, $whatsapp, $linkedin, $instagram, $twitter, $youtube, $palavrasChave, $dataAlteracao, $idUserAlteracao, $fotos, $_GET['id']);

        ?>
            <div class="alert alert-success">
                Cliente alterado com sucesso!
            </div>
        <?php 
    }   
    

    if (isset($_GET['id']) && !empty($_GET['id']) || empty($cliente)) {
        $cliente = $c->getCliente($_GET['id']);

        $enderecoCompleto = $cliente['endereco'].", ". $cliente['numero'] ." - ". $cliente['complemento'] ." - ". $cliente['bairro'] ." - CEP: ". $cliente['cep'] ." - ". $cliente['cidade'] ." - ". $cliente['uf'] ;
        
        if (empty($cliente)) {
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

    <h2><?php echo $cliente['empresa'] ?><small class="text-muted"> <?php echo ($cliente['anunciante'] == '1') ? '<span class="badge badge-success">Anunciante</span>' : '<span class="badge badge-warning">Não Anunciante</span>' ?></small></h2>
    <ul class="nav nav-tabs mb-3" id="tabDadosCliente" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="principal-tab" data-toggle="tab" href="#principal" role="tab" aria-controls="principal" aria-selected="true">Dados Cadastrais</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="perfil-tab" data-toggle="tab" href="#perfil" role="tab" aria-controls="perfil" aria-selected="false">Perfil do Cliente</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="redessociais-tab" data-toggle="tab" href="#redessociais" role="tab" aria-controls="redessociais" aria-selected="false">Redes Sociais</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="contratos-tab" data-toggle="tab" href="#contratos" role="tab" aria-controls="contratos" aria-selected="false">Contratos</a>
        </li>
    </ul>  
        
        <ul class="errorMessages fade show"></ul>        

        <div class="tab-content" id="tabDadosClienteConteudo">            

            <div class="tab-pane fade show active" id="principal" role="tabpanel" aria-labelledby="principal-tab">

                <form method="POST" enctype="multipart/form-data" autocomplete="off">
              
                    <div class="form-group">
                        <label for="empresa">Empresa (Nome Fantasia)</label>
                        <input class="form-control" type="text" name="empresa" id="empresa" value="<?php echo $cliente['empresa'] ?>" required>
                        <small id="empresaHelp" class="form-text text-muted">Preencha o nome da empresa sem as siglas de razão social.</small>
                    </div>

                    <div class="form-group">
                        <label for="razaoSocial">Razão Social</label>
                        <input class="form-control" type="text" name="razaoSocial" id="razaoSocial" value="<?php echo $cliente['razaoSocial'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="autorizante">Autorizante</label>
                        <input class="form-control" type="text" name="autorizante" id="autorizante" value="<?php echo $cliente['autorizante'] ?>" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="cep">CEP</label> <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Digite o CEP e pressione a tecla TAB para preencher os campos automaticamente."></i>
                            <input class="form-control" type="text" name="cep" id="cep" value="<?php echo $cliente['cep'] ?>" autocomplete="off" required>
                            <small id="cepHelp" class="form-text text-muted"><a target="_blank" href="http://www.buscacep.correios.com.br/sistemas/buscacep/">Não sei o CEP</a> <i class="fas fa-external-link-alt" title="Abre em uma nova janela."></i></small>
                        </div>

                        <div class="form-group col-md-5">
                            <label for="endereco">Endereço</label>
                            <input class="form-control" type="text" name="endereco" id="endereco" value="<?php echo $cliente['endereco'] ?>" required>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="numero">Número</label>
                            <input class="form-control" type="text" name="numero" id="numero" value="<?php echo $cliente['numero'] ?>" maxlength="15" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="complemento">Complemento</label>
                            <input class="form-control" type="text" name="complemento" id="complemento" value="<?php echo $cliente['complemento'] ?>" maxlength="35">
                        </div>                    
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="bairro">Bairro</label>
                            <input class="form-control" type="text" name="bairro" id="bairro" value="<?php echo $cliente['bairro'] ?>" required>
                        </div>

                        <div class="form-group col-md-5">
                            <label for="cidade">Cidade</label>
                            <input class="form-control" type="text" name="cidade" id="cidade" value="<?php echo $cliente['cidade'] ?>" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="uf">Estado</label>
                            <select class="form-control" name="uf" id="uf">
                                <option value="">Selecionar Estado</option>
                                <option value="AC" <?php echo $cliente['uf']=='AC'?'selected':'';?> >Acre</option>
                                <option value="AL" <?php echo $cliente['uf']=='AL'?'selected':'';?> >Alagoas</option>
                                <option value="AP" <?php echo $cliente['uf']=='AP'?'selected':'';?> >Amapá</option>
                                <option value="AM" <?php echo $cliente['uf']=='AM'?'selected':'';?> >Amazonas</option>
                                <option value="BA" <?php echo $cliente['uf']=='BA'?'selected':'';?> >Bahia</option>
                                <option value="CE" <?php echo $cliente['uf']=='CE'?'selected':'';?> >Ceará</option>
                                <option value="DF" <?php echo $cliente['uf']=='DF'?'selected':'';?> >Distrito Federal</option>
                                <option value="ES" <?php echo $cliente['uf']=='ES'?'selected':'';?> >Espírito Santo</option>
                                <option value="GO" <?php echo $cliente['uf']=='GO'?'selected':'';?> >Goiás</option>
                                <option value="MA" <?php echo $cliente['uf']=='MA'?'selected':'';?> >Maranhão</option>
                                <option value="MT" <?php echo $cliente['uf']=='MT'?'selected':'';?> >Mato Grosso</option>
                                <option value="MS" <?php echo $cliente['uf']=='MS'?'selected':'';?> >Mato Grosso do Sul</option>
                                <option value="MG" <?php echo $cliente['uf']=='MG'?'selected':'';?> >Minas Gerais</option>
                                <option value="PA" <?php echo $cliente['uf']=='PA'?'selected':'';?> >Pará</option>
                                <option value="PB" <?php echo $cliente['uf']=='PE'?'selected':'';?> >Paraíba</option>
                                <option value="PR" <?php echo $cliente['uf']=='PR'?'selected':'';?> >Paraná</option>
                                <option value="PE" <?php echo $cliente['uf']=='PE'?'selected':'';?> >Pernambuco</option>
                                <option value="PI" <?php echo $cliente['uf']=='PI'?'selected':'';?> >Piauí</option>
                                <option value="RJ" <?php echo $cliente['uf']=='RJ'?'selected':'';?> >Rio de Janeiro</option>
                                <option value="RN" <?php echo $cliente['uf']=='RN'?'selected':'';?> >Rio Grande do Norte</option>
                                <option value="RS" <?php echo $cliente['uf']=='RS'?'selected':'';?> >Rio Grande do Sul</option>
                                <option value="RO" <?php echo $cliente['uf']=='RO'?'selected':'';?> >Rondônia</option>
                                <option value="RR" <?php echo $cliente['uf']=='RR'?'selected':'';?> >Roraima</option>
                                <option value="SC" <?php echo $cliente['uf']=='SC'?'selected':'';?> >Santa Catarina</option>
                                <option value="SP" <?php echo $cliente['uf']=='SP'?'selected':'';?> >São Paulo</option>
                                <option value="SE" <?php echo $cliente['uf']=='SE'?'selected':'';?> >Sergipe</option>
                                <option value="TO" <?php echo $cliente['uf']=='TO'?'selected':'';?> >Tocantins</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="enderecoCompleto">Endereço Completo</label>
                            <input class="form-control" type="text" name="enderecoCompleto" id="enderecoCompleto" value="<?php echo $enderecoCompleto; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="telefone">Telefone</label>
                            <input class="form-control" type="text" name="telefone" id="telefone" value="<?php echo $cliente['telefone'] ?>" placeholder="(00) 0000-0000">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="celular">Celular</label>
                            <input class="form-control" type="text" name="celular" id="celular" value="<?php echo $cliente['celular'] ?>" placeholder="(00) 00000-0000">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="email">E-mail</label> <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="No momento, é permitido cadastrar apenas um e-mail."></i>
                            <input class="form-control" type="email" name="email" id="email" value="<?php echo $cliente['email'] ?>" required onkeydown="lowerCase(this);">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="website">Website</label> <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="É necessário incluir o protocolo antes da URL."></i>
                            <input class="form-control" type="url" name="website" id="website" value="<?php echo $cliente['website'] ?>" placeholder="http://" onkeydown="lowerCase(this);">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="anunciante">Cliente já Anunciante?</label><br>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="custom-control-input" type="radio" name="anunciante" id="anunciante-nao" value="0" <?php if ($cliente['anunciante'] == '0'): ?> checked="checked" <?php endif; ?>>
                                <label class="custom-control-label" for="anunciante-nao">Não Anunciante</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                  <input class="custom-control-input" type="radio" name="anunciante" id="anunciante-sim" value="1" <?php if ($cliente['anunciante'] == '1'): ?> checked="checked" <?php endif; ?>>
                                <label class="custom-control-label" for="anunciante-sim">Anunciante</label>                        
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="tipoCliente">Tipo de Cliente</label><br>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="custom-control-input" type="radio" name="tipoCliente" id="p-juridica" value="1" onclick="removeCampo();" <?php if ($cliente['tipoCliente'] == '1'): ?> checked="checked" <?php endif; ?>>
                                <label class="custom-control-label" for="p-juridica">Pessoa Jurídica</label> 
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="custom-control-input" type="radio" name="tipoCliente" id="p-fisica" value="0" onclick="removeCampo();" <?php if ($cliente['tipoCliente'] == '0'): ?> checked="checked" <?php endif; ?>>
                                <label class="custom-control-label" for="p-fisica">Pessoa Física</label>
                            </div>
                            
                        </div>
                            
                        <div class="form-group col-md-4" id="div-pj" <?php echo $cliente['tipoCliente']==1 ? 'style="display: block;"' : 'style="display: none;"'?>>
                            <label for="cnpj">CNPJ</label>
                            <input class="form-control" type="text" name="cnpj" id="cnpj" placeholder="99.999.999/9999-99" value="<?php echo $cliente['cnpj'] ?> ">
                        </div>
                    
                        <div class="form-group col-md-4" id="div-pf" <?php echo $cliente['tipoCliente']==0 ? 'style="display: block;"' : 'style="display: none;"'?>>
                            <label for="cpf">CPF</label>
                            <input class="form-control" type="text" name="cpf" id="cpf" placeholder="999.999.999-99" value="<?php echo $cliente['cpf'] ?>" >   
                        </div>                    

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12"> 
                            <label for="obs">Observações</label>
                            <textarea class="form-control" name="obs" id="obs"><?php echo $cliente['obs'] ?></textarea>
                        </div>
                    </div>
                    
                    <!-- dados de registro e alteração -->
                    <div class="form-row">
                        <div class="form-group col-lg-3 col-md-6">
                            <label for="name"><small>Registrado por</small></label>
                            <input class="form-control form-control-sm" type="text" name="name" id="name" value="<?php echo $cliente['nomeUsuario'] ?>" readonly>
                        </div>
                        <div class="form-group col-lg-3 col-md-6"> 
                            <label for="dataRegistro"><small>Data de Registro</small></label>
                            <?php $dataRegistro = strtotime($cliente['dataRegistro']);?>
                            <input class="form-control form-control-sm" type="text" name="dataRegistro" id="dataRegistro" value="<?php echo date('d/m/Y H:i:s',$dataRegistro); ?>" readonly>
                        </div>
                        <div class="form-group col-lg-3 col-md-6">
                            <label for="userAlteracao"><small>Alterado por</small></label>                            
                            <input class="form-control form-control-sm" type="text" name="userAlteracao" id="userAlteracao" value="<?php echo $cliente['userAlteracao']== null ? 'Sem Alterações' : $cliente['userAlteracao'] ?>" readonly>
                        </div>
                        <div class="form-group col-lg-3 col-md-6">
                            <label for="dataAlteracao"><small>Data de Alteração</small></label>
                            <?php $dataAlteracao = strtotime($cliente['dataAlteracao']);?>
                            <input class="form-control form-control-sm" type="text" name="dataAlteracao" id="dataAlteracao" value="<?php echo $cliente['dataAlteracao']== 0 ? 'Sem Alterações' : date('d/m/Y H:i:s',$dataAlteracao); ?>" readonly>
                        </div>
                    </div>

                    <!-- conjunto de botões dados cadastrais -->
                    <input class="btn btn-primary" type="submit" value="Salvar Alterações">                    
                    <a class="btn btn-danger" href="delete.php?id=<?php echo $cliente['id']; ?>" onclick="return confirm('Tem certeza de que deseja excluir este cliente? Todos os contratos do mesmo serão excluídos.');" role="button">Excluir Cliente</a>
                    
            </div>

            <div class="tab-pane fade" id="perfil" role="tabpanel" aria-labelledby="perfil-tab">
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <i class="fa fa-info-circle"></i> Adicione o máximo de informações sobre o cliente para os anúncios, campanhas e peças de mídia.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>  
            
                <div class="form-row">
                    <div class="form-group col-md-6"> 
                        <label for="apresentacao">Apresentação do Anunciante <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Defina um pequeno texto de apresentação sobre a empresa."></i></label>
                        <textarea class="form-control" name="apresentacao" id="apresentacao" rows="8"><?php echo $cliente['apresentacao'] ?></textarea>
                    </div>
               
                    <div class="form-group col-md-6"> 
                        <label for="apresentacao">Produtos/Serviços <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Quais os produtos ou serviços que a empresa oferece? Separe-os por parágrafos."></i></label>
                        <textarea class="form-control" name="produtos" id="produtos" rows="8"><?php echo $cliente['produtos'] ?></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="tipoEmpresa">Tipo de Empresa</label>
                        <select class="form-control" name="tipoEmpresa" id="tipoEmpresa">
                            <option value="">Selecionar Tipo de Empresa</option>
                            <option value="0" <?php echo $cliente['tipoEmpresa']=='0'?'selected':'';?>>Fornecedor</option>
                            <option value="1" <?php echo $cliente['tipoEmpresa']=='1'?'selected':'';?>>Fabricante</option>
                            <option value="2" <?php echo $cliente['tipoEmpresa']=='2'?'selected':'';?>>Prestador de Serviços</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="areaAtuacao">Área de Atuação <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Qual região a empresa atende? Você pode especificar várias regiões."></i></label>
                        <input class="form-control" type="text" name="areaAtuacao" id="areaAtuacao" value="<?php echo $cliente['areaAtuacao'];?>">
                    </div>                    
                </div>

                <div class="form-group">
                    <label for="fraseDestaque">Frase de Destaque <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="A empresa tem algum slogan? Informe-o aqui."></i></label>
                    <input class="form-control" type="text" name="fraseDestaque" id="fraseDestaque" value="<?php echo $cliente['fraseDestaque'];?>">
                </div>

                <div class="form-group">
                    <label for="diferencial">Diferencial <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="O que esta empresa oferece de diferente?"></i></label>
                    <input class="form-control" type="text" name="diferencial" id="diferencial" value="<?php echo $cliente['diferencial'];?>">
                </div>

                <div class="form-group">
                    <?php $palavrasChave = $cliente['palavrasChave'];  // obtém os dados do campos 

                    if ($palavrasChave !== null ) {
                        $palavrasArray = explode(" | ",$palavrasChave); // transforma em array 
                    }
                   
                    ?>

                    <label for="palavrasChave">Palavras Chave</label>
                    <select class="form-control js-example-tokenizer" name="palavrasChave[]" id="palavrasChave" multiple="multiple">
                        <option disabled="true">Insira as tags separando-as por vírgulas.</option>
                        <?php foreach($palavrasArray as $palavraArray): ?>
                        <option value="<?php echo $palavraArray;?>" selected><?php echo $palavraArray;?> </option>
                        <?php endforeach;?>
                    </select> 
                </div>

                <div class="form-group">
                    <label for="video">Link de Vídeo no YouTube/Vimeo</label>
                    <input class="form-control" type="text" name="video" id="video" value="<?php echo $cliente['video'] ?>">
                </div>

                <div class="form-group">
                    <label for="fotos">Imagens de Referência <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Salve aqui imagens como logotipos, anúncios e imagens de produtos."></i></label>
                    <input type="file" name="fotos[]" multiple>
                    <div class="card mt-2">
                        <div class="card-header"><i class="far fa-image"></i> Imagens de Referência</div>
                        <div class="card-body">
                            <div class="row">
                                <?php if ($cliente['fotos'] == null) {
                                    echo "Não há imagens para este cliente.";
                                } ?>                                    
                                    <?php foreach ($cliente['fotos'] as $foto):?>
                                        <div class="col-md-2">

                                            <a href="../../images/clientes/<?php echo $foto['url'];?>" data-toggle="lightbox" data-gallery="images-gallery">
                                                <img class="img-thumbnail" src="../../images/clientes/<?php echo $foto['url']; ?>" title="<?php echo $foto['titulo'];?>" border="0">
                                            </a>

                                            <a class="btn btn-danger mt-2 mb-3 btn-sm btn-block" href="delete-image.php?id=<?php echo $foto['id']; ?>" onclick="return confirm('Tem certeza de que deseja excluir esta imagem?');"><i class="fa fa-trash"></i> Excluir</a>

                                        </div>
                                    <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- conjunto de botões perfil -->
                <input class="btn btn-primary" type="submit" value="Salvar Alterações">
                <a class="btn btn-danger" href="delete.php?id=<?php echo $cliente['id']; ?>" onclick="return confirm('Tem certeza de que deseja excluir este cliente? Todos os contratos do mesmo serão excluídos.');" role="button">Excluir Cliente</a>

            </div>

            <div class="tab-pane fade" id="redessociais" role="tabpanel" aria-labelledby="redessociais-tab">
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <i class="fa fa-info-circle"></i> Preencha o máximo de redes sociais do cliente, ativas ou inativas.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div> 

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="facebook" hidden>Facebook</label>
                        <div class="input-group">
                            <div class="input-group-prepend" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Facebook">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fab fa-facebook-f fa-fw"></i></span>
                            </div>
                            <input class="form-control" type="url" name="facebook" id="facebook" value="<?php echo $cliente['facebook'];?>">
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="instagram" hidden>Instagram</label>
                        <div class="input-group">
                            <div class="input-group-prepend" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Instagram">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fab fa-instagram fa-fw"></i></span>
                            </div>
                            <input class="form-control" type="url" name="instagram" id="instagram" value="<?php echo $cliente['instagram'];?>">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="whatsapp" hidden>WhatsApp</label> 
                        <div class="input-group">
                            <div class="input-group-prepend" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="WhatsApp">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fab fa-whatsapp fa-fw"></i></span>
                            </div>
                            <input class="form-control" type="text" name="whatsapp" id="whatsapp" placeholder="(00) 00000-0000" value="<?php echo $cliente['whatsapp'];?>">
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="twitter" hidden>Twitter</label> 
                        <div class="input-group">
                            <div class="input-group-prepend" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Twitter">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fab fa-twitter fa-fw"></i></span>
                            </div>
                            <input class="form-control" type="url" name="twitter" id="twitter" value="<?php echo $cliente['twitter'];?>">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="linkedin" hidden>Linkedin</label> 
                        <div class="input-group">
                            <div class="input-group-prepend" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Linkedin">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fab fa-linkedin fa-fw"></i></span>
                            </div>
                            <input class="form-control" type="url" name="linkedin" id="linkedin" value="<?php echo $cliente['linkedin'];?>">
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="youtube" hidden>YouTube</label> 
                        <div class="input-group">
                            <div class="input-group-prepend" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="YouTube">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fab fa-youtube fa-fw"></i></span>
                            </div>
                            <input class="form-control" type="url" name="youtube" id="youtube" value="<?php echo $cliente['youtube'];?>">
                        </div>
                    </div>
                </div>
                <!-- conjunto de botões redes sociais -->
                <input class="btn btn-primary" type="submit" value="Salvar Alterações">
                <a class="btn btn-danger" href="delete.php?id=<?php echo $cliente['id']; ?>" onclick="return confirm('Tem certeza de que deseja excluir este cliente? Todos os contratos do mesmo serão excluídos.');" role="button">Excluir Cliente</a>
            </div>

            </form> <!-- fecha o form da primeira aba -->
    
            <div class="tab-pane fade" id="contratos" role="tabpanel" aria-labelledby="contratos-tab">
                 <?php include 'cliente-contratos.php'; ?>
            </div>

        </div>

</div>

<?php include (FOOTER_TEMPLATE);?>

<script>    
    $(document).ready(function() { // transforma os select em select2
        $('.js-example-tokenizer').select2({
            width: '100%', 
            language: "pt-BR",
            theme: 'bootstrap4',
            tags: true,
            allowClear: true,
            tokenSeparators: [',']
        });
    });
</script>

<script type="text/javascript" src="https://static.safetymails.com/assets/js/safetyoptin_v3.0.min.js"></script>
<script type="text/javascript">
__safetyObj__ = {
    api_key:'f4f8ed239f3371e4dc19c16036f46f736eb53b0e',
    ticket_origem:'cbabff15c0d1732fb9d6bf950ad9444789d4ed7b',
    field_email: "#email",
    button_id: "saveButtonNull", // somente para evitar o bloqueio do botão salvar
    accept_status: "undefined,PENDENTE,INCERTO,DESCONHECIDO,SCRAPED,JUNK",
    message_public_domain: "Ops! Parece que este e-mail é inválido. Digite novamente.",
    message_invalid: "Ops! Parece que este e-mail é inválido. Digite novamente.",
    message_valid: "OK! Este e-mail é valido.",
    tmp_delay: "1000",
    block_public_domain: false,
};
SafetyApi.init();
</script>




