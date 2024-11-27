<?php 
require_once '../../../init.php';
require '../../../check.php';
?>

<div id="postModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="posts_form" method="POST">    
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar Postagem</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <i class="fa fa-info-circle"></i> Cadastre aqui os links das postagens feitas nas redes.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label>Título da Postagem</label>
                            <input class="form-control" type="text" name="titulo" id="titulo" required>
                        </div>                        
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Status da Postagem</label>
                            <select class="form-control" name="idStatusPosts" id="idStatusPosts" required>
                                <option value="">Selecione o Status</option>
                                <option value="1">Aguardando</option>
                                <option value="2">Publicada</option>            
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Data de Publicação</label>
                            <input type="date" name="dataPublicacao" id="dataPublicacao" class="form-control"/>
                        </div>                        
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <div class="input-group">
                                <div class="input-group-prepend" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Link do Post no Facebook">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fab fa-facebook-f fa-fw"></i></span>
                                </div>
                                <input class="form-control" type="url" name="urlFacebook" id="urlFacebook" placeholder="Cole aqui o link do post">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="shorten_url('urlFacebook', 'urlFacebook_bitly');">Encurtar Link</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <input type="text" name="urlFacebook_bitly" id="urlFacebook_bitly" class="form-control" placeholder="Link curto Facebook" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-8"> 
                            <div class="input-group">
                                <div class="input-group-prepend" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Link do Post no Instagram">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fab fa-instagram fa-fw"></i></span>
                                </div>
                                <input class="form-control" type="url" name="urlInstagram" id="urlInstagram" placeholder="Cole aqui o link do post">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="shorten_url('urlInstagram', 'urlInstagram_bitly');">Encurtar Link</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <input type="text" name="urlInstagram_bitly" id="urlInstagram_bitly" class="form-control" placeholder="Link curto Instagram" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <div class="input-group">
                                <div class="input-group-prepend" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Link do Post no Linkedin">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fab fa-linkedin fa-fw"></i></span>
                                </div>
                                <input class="form-control" type="url" name="urlLinkedin" id="urlLinkedin" placeholder="Cole aqui o link do post">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="shorten_url('urlLinkedin', 'urlLinkedin_bitly');">Encurtar Link</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <input type="text" name="urlLinkedin_bitly" id="urlLinkedin_bitly" class="form-control" placeholder="Link curto Linkedin" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <div class="input-group">
                                <div class="input-group-prepend" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Link do Post no Twitter">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fab fa-twitter fa-fw"></i></span>
                                </div>
                                <input class="form-control" type="url" name="urlTwitter" id="urlTwitter" placeholder="Cole aqui o link do post">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="shorten_url('urlTwitter', 'urlTwitter_bitly');">Encurtar Link </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <input type="text" name="urlTwitter_bitly" id="urlTwitter_bitly" class="form-control" placeholder="Link curto Twitter" />
                        </div>                        
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idMateriaContratada" id="idMateriaContratada" value="<?php echo $_GET['id']; ?>"/>
                    <input type="hidden" name="id" id="id"/>
                    <input type="hidden" name="operation" id="operation"/>                    
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Adicionar"/>                    
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="popupPosts" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Adicionar Postagem</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

                <button type="button" id="addPost" data-toggle="modal" data-target="#postModal" class="btn btn-primary btn-lg btn-block mb-2">Adicionar Postagem</button>

                <form id="btnPostsCliente" action="<?php echo BASEURL; ?>cadastros/contratos/materias/form-posts-cliente-lote.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="idMateriaContratada" value="<?php echo $_GET['id']; ?>"/>
                    <input type="hidden" name="idContrato" value="<?php echo $materiaContratada['idContrato']; ?>">  
                    <input type="hidden" name="nContrato" value="<?php echo $materiaContratada['nContrato']; ?>">                     
                    <input type="hidden" name="empresa" value="<?php echo $materiaContratada['empresa']; ?>">
                    <input type="hidden" name="start_date" value="<?php echo date("Y-m-d", strtotime($materiaContratada['dataLimite'])); ?>"> 
                    <input type="hidden" name="end_date" value="<?php echo date("Y-m-d", strtotime($materiaContratada['dataExpiracao'])); ?>">
                    <button class="btn btn-secondary btn-lg btn-block mb-2" type="submit" value="Submit" onclick="return confirm('Atenção ao utilizar esta ferramenta. Posts duplicados podem ocorrer.')";>Adicionar Postagens em Lote </button>
                </form>

                <form id="btnPostsPortal" action="<?php echo BASEURL; ?>cadastros/contratos/materias/form-posts-portal-lote.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="idMateriaContratada" value="<?php echo $_GET['id']; ?>"/>
                    <input type="hidden" name="idContrato" value="<?php echo $materiaContratada['idContrato']; ?>">  
                    <input type="hidden" name="nContrato" value="<?php echo $materiaContratada['nContrato']; ?>">                     
                    <input type="hidden" name="empresa" value="<?php echo $materiaContratada['empresa']; ?>">
                    <input type="hidden" name="start_date" value="<?php echo date("Y-m-d", strtotime($materiaContratada['dataLimite'])); ?>"> 
                    <input type="hidden" name="end_date" value="<?php echo date("Y-m-d", strtotime($materiaContratada['dataExpiracao'])); ?>">
                    <button class="btn btn-danger btn-lg btn-block mb-2" type="submit" value="Submit" onclick="return confirm('Atenção ao utilizar esta ferramenta. Posts duplicados podem ocorrer.')";>Adicionar Postagens em Lote </button>
                </form>

                <form action="<?php echo BASEURL; ?>cadastros/contratos/materias/postagens_imprimir.php" method="POST" target="print_popup" onsubmit="window.open('about:blank','print_popup','width=1000,height=800');">
                    <input type="hidden" name="idMateriaContratada" value="<?php echo $_GET['id']; ?>"/>
                    <input type="hidden" name="empresa" value="<?php echo $materiaContratada['empresa']; ?>">
                    <input type="hidden" name="nContrato" value="<?php echo $materiaContratada['nContrato']; ?>">  
                    <button type="submit" class="btn btn-success btn-lg btn-block mb-2">Imprimir Postagens da Matéria</button>
                </form> 

            </div>            
        </div>
    </div>
</div>

<div id="popupAds" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Opções Google Ads</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <button type="button" id="addAdResponsivo" data-toggle="modal" data-target="#adsModal" class="btn btn-primary btn-lg btn-block mb-2">Adicionar Anúncio Responsivo</button>
                <button type="button" id="addAdChamada" data-toggle="modal" data-target="#adsModalChamada" class="btn btn-success btn-lg btn-block mb-2">Adicionar Anúncio de Chamadas</button>

                <form action="<?php echo BASEURL; ?>cadastros/contratos/materias/googleads_imprimir.php" method="POST" target="print_popup" onsubmit="window.open('about:blank','print_popup','width=1000,height=800')";> 
                    <input type="hidden" name="idMateriaContratada" value="<?php echo $_GET['id']; ?>"/>
                    <input type="hidden" name="empresa" value="<?php echo $materiaContratada['empresa']; ?>">
                    <input type="hidden" name="nContrato" value="<?php echo $materiaContratada['nContrato']; ?>">  
                    <button type="submit" class="btn btn-danger btn-lg btn-block mb-2">Imprimir Resumo Google Ads</button>
                </form> 

            </div>            
        </div>
    </div>
</div>

<div id="adsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="ads_form" method="POST">    
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar Anúncio Responsivo</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="form-row">
                        <div class="form-group col mb-2">
                            <label>URL Final</label>
                            <input class="form-control form-control-sm" type="url" name="urlFinal" id="urlFinal">
                        </div>                        
                    </div>

                    <div class="form-row">
                        <div class="form-group col mb-2">
                            <label>URL de Visualização</label>
                            <input class="form-control form-control-sm" type="url" name="urlVisualizacao" id="urlVisualizacao">
                        </div>                        
                    </div>
                    
                    <label>Títulos <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Insira de 3 a 15 títulos. Eles são exibidos na parte superior do anúncio e podem ter até 30 caracteres."></i></label>

                    <div class="form-row">
                        <div class="form-group col-md-6 mb-2">
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" name="titulo1" id="titulo1" required>
                                <div class="input-group-append">
                                    <p id="counterT1" class="input-group-text">0/30</p>
                                </div>
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" name="titulo2" id="titulo2" required>
                                <div class="input-group-append">
                                    <p id="counterT2" class="input-group-text">0/30</p>
                                </div>
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" name="titulo3" id="titulo3" required>
                                <div class="input-group-append">
                                    <p id="counterT3" class="input-group-text">0/30</p>
                                </div>
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" name="titulo4" id="titulo4">
                                <div class="input-group-append">
                                    <p id="counterT4" class="input-group-text">0/30</p>
                                </div>
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" name="titulo5" id="titulo5">
                                <div class="input-group-append">
                                    <p id="counterT5" class="input-group-text">0/30</p>
                                </div>
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" name="titulo6" id="titulo6">
                                <div class="input-group-append">
                                    <p id="counterT6" class="input-group-text">0/30</p>
                                </div>
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" name="titulo7" id="titulo7">
                                <div class="input-group-append">
                                    <p id="counterT7" class="input-group-text">0/30</p>
                                </div>
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" name="titulo8" id="titulo8">
                                <div class="input-group-append">
                                    <p id="counterT8" class="input-group-text">0/30</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" name="titulo9" id="titulo9">
                                <div class="input-group-append">
                                    <p id="counterT9" class="input-group-text">0/30</p>
                                </div>
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" name="titulo10" id="titulo10">
                                <div class="input-group-append">
                                    <p id="counterT10" class="input-group-text">0/30</p>
                                </div>
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" name="titulo11" id="titulo11">
                                <div class="input-group-append">
                                    <p id="counterT11" class="input-group-text">0/30</p>
                                </div>
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" name="titulo12" id="titulo12">
                                <div class="input-group-append">
                                    <p id="counterT12" class="input-group-text">0/30</p>
                                </div>
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" name="titulo13" id="titulo13">
                                <div class="input-group-append">
                                    <p id="counterT13" class="input-group-text">0/30</p>
                                </div>
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" name="titulo14" id="titulo14">
                                <div class="input-group-append">
                                    <p id="counterT14" class="input-group-text">0/30</p>
                                </div>
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" name="titulo15" id="titulo15">
                                <div class="input-group-append">
                                    <p id="counterT15" class="input-group-text">0/30</p>
                                </div>
                            </div>                            
                        </div>                         
                    </div>

                    <label>Descrições <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Insira de 2 a 4 descrições. A descrição do anúncio é exibida abaixo do URL de visualização e pode ter até 90 caracteres."></i></label>

                    <div class="input-group input-group-sm mb-2">
                        <input type="text" class="form-control" name="descricao1" id="descricao1" required>
                        <div class="input-group-append">
                            <p id="counter1" class="input-group-text">0/90</p>
                        </div>
                    </div>

                    <div class="input-group input-group-sm mb-2">
                        <input type="text" class="form-control" name="descricao2" id="descricao2" required>
                        <div class="input-group-append">
                            <p id="counter2" class="input-group-text">0/90</p>
                        </div>
                    </div>

                    <div class="input-group input-group-sm mb-2">
                        <input type="text" class="form-control" name="descricao3" id="descricao3">
                        <div class="input-group-append">
                            <p id="counter3" class="input-group-text">0/90</p>
                        </div>
                    </div>

                    <div class="input-group input-group-sm mb-2">
                        <input type="text" class="form-control" name="descricao4" id="descricao4">
                        <div class="input-group-append">
                            <p id="counter4" class="input-group-text">0/90</p>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idMateriaContratadaAds" id="idMateriaContratadaAds" value="<?php echo $_GET['id']; ?>"/>
                    <input type="hidden" name="idAds" id="idAds"/>
                    <input type="hidden" name="operationAds" id="operationAds"/>
                    <input type="hidden" name="contaTitulos" id="contaTitulos"/>
                    <input type="hidden" name="contaDescricoes" id="contaDescricoes"/>
                    <input type="submit" name="actionAds" id="actionAds" class="btn btn-success" value="Adicionar"/>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="adsModalChamada" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="adsChamada_form" method="POST">    
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar Anúncio de Chamadas</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="form-row">
                        <div class="form-group col mb-2">
                            <label>Número de Telefone</label>
                            <input class="form-control form-control-sm" type="text" name="numeroTel" id="numeroTel" placeholder="(21) 0000-0000" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col mb-2">
                            <label>URL Final</label>
                            <input class="form-control form-control-sm" type="url" name="urlFinalChamada" id="urlFinalChamada">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col mb-2">
                            <label>URL de Visualização</label>
                            <input class="form-control form-control-sm" type="url" name="urlVisualizacaoChamada" id="urlVisualizacaoChamada">
                        </div>
                    </div>
                    
                    <label>Títulos <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Insira até 2 títulos. Eles são exibidos na parte superior do anúncio e podem ter até 30 caracteres."></i></label>

                    <div class="form-row">
                        <div class="form-group col-md-6 mb-2">
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" name="titulo1Chamada" id="titulo1Chamada" required>
                                <div class="input-group-append">
                                    <p id="counterT1Chamada" class="input-group-text">0/30</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" name="titulo2Chamada" id="titulo2Chamada">
                                <div class="input-group-append">
                                    <p id="counterT2Chamada" class="input-group-text">0/30</p>
                                </div>
                            </div>                                                       
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col mb-2">
                            <label>Nome da Empresa</label>
                            <input class="form-control form-control-sm" type="text" name="nomeEmpresa" id="nomeEmpresa" required>
                        </div>                        
                    </div>

                    <label>Descrições <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Insira até 2 descrições. A descrição do anúncio é exibida abaixo do URL de visualização e pode ter até 90 caracteres."></i></label>

                    <div class="input-group input-group-sm mb-2">
                        <input type="text" class="form-control" name="descricao1Chamada" id="descricao1Chamada" required>
                        <div class="input-group-append">
                            <p id="counter1Chamada" class="input-group-text">0/90</p>
                        </div>
                    </div>

                    <div class="input-group input-group-sm mb-2">
                        <input type="text" class="form-control" name="descricao2Chamada" id="descricao2Chamada">
                        <div class="input-group-append">
                            <p id="counter2Chamada" class="input-group-text">0/90</p>
                        </div>
                    </div>                    

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="idMateriaContratadaAdsChamada" id="idMateriaContratadaAdsChamada" value="<?php echo $_GET['id']; ?>"/>
                    <input type="hidden" name="idAdsChamada" id="idAdsChamada"/>
                    <input type="hidden" name="operationAdsChamada" id="operationAdsChamada"/>
                    <input type="hidden" name="contaTitulosChamada" id="contaTitulosChamada"/>
                    <input type="hidden" name="contaDescricoesChamada" id="contaDescricoesChamada"/>
                    <input type="submit" name="actionAdsChamada" id="actionAdsChamada" class="btn btn-success" value="Adicionar"/>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>
</div>