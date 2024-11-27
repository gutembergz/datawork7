<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta id="viewport" name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>lib/bootstrap/css/bootstrap.min.css">        
        <link rel="stylesheet" href="<?php echo BASEURL; ?>lib/css/styles.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>lib/fontawesome/css/all.css">        
        <link rel="stylesheet" href="<?php echo BASEURL; ?>lib/css/bootstrap-mod.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>lib/css/select2.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>lib/css/select2-bootstrap4.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>lib/ekko-lightbox/ekko-lightbox.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>lib/DataTables/datatables.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>lib/DataTables/RowGroup-1.1.2/css/rowGroup.dataTables.min.css"></script>
        <link rel="icon" href="<?php echo BASEURL . "images/brand/favicon.svg"; ?>">   
        <script src="<?php echo BASEURL; ?>lib/tinymce/tinymce.min.js"></script>
        <title>DataWork &middot; <?php echo $pageTitle = isset($pageTitle) ? $pageTitle : 'Página sem Título'; ?></title>
    </head>
    <body class="sb-nav-fixed<?php echo (isLoggedIn()) ? '' : ' sb-sidenav-toggled' ?>" onload="ocultaTabs()">
        
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="<?php echo BASEURL; ?>">DataWork <small><?php echo APPVERSION;?> Beta</small></a>
            
            <?php if (isLoggedIn()): ?>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></div>
            <!-- Navbar-->
            
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?php echo BASEURL; ?>perfil/">Editar Perfil</a>
                        <div class="dropdown-divider"></div>                           
                        <a class="dropdown-item" href="<?php echo BASEURL; ?>logout.php">Efetuar Logout</a>
                    </div>
                </li>
            </ul>
            <?php endif; ?>
        </nav>

        <div id="layoutSidenav">
            <?php if (isLoggedIn()): ?>

            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">

                    <div class="sb-sidenav-menu" id="NavMenu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Sistema</div>
                            <a class="nav-link" href="<?php echo BASEURL; ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Painel
                            </a>
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#encurtarLink">
                                <div class="sb-nav-link-icon"><i class="fa fa-link"></i></div>
                                Encurtar um Link
                            </a>
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#linkWhatsapp">
                                <div class="sb-nav-link-icon"><i class="fab fa-whatsapp"></i></div>
                                Gerar Link WhatsApp
                            </a>
                            <div class="sb-sidenav-menu-heading">Cadastros</div>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePortal" aria-expanded="false" aria-controls="collapsePortal">
                                <div class="sb-nav-link-icon"><i class="fas fa-globe"></i></div>
                                Portal de Negócios
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="collapsePortal" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link disabled" href="<?php echo BASEURL; ?>cadastros/portal/form-add.php">Nova Inserção</a>
                                    <a class="nav-link" href="<?php echo BASEURL; ?>cadastros/portal/">Todas as Inserções</a>
                                    <a class="nav-link disabled" href="<?php echo BASEURL; ?>cadastros/portal/banners/">Banners</a>
                                    <a class="nav-link disabled" href="<?php echo BASEURL; ?>cadastros/portal/categorias/">Categorias</a>
                                    <a class="nav-link disabled" href="<?php echo BASEURL; ?>cadastros/portal/localidades/">Localidades</a>
                                    <a class="nav-link disabled" href="<?php echo BASEURL; ?>cadastros/portal/mensagens/">Mensagens</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseContratos" aria-expanded="false" aria-controls="collapseContratos">
                                <div class="sb-nav-link-icon"><i class="far fa-file-alt"></i></div>
                                Contratos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="collapseContratos" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo BASEURL; ?>cadastros/contratos/form-add.php">Novo Contrato</a>
                                    <a class="nav-link" href="<?php echo BASEURL; ?>cadastros/contratos/">Todos os Contratos</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClientes" aria-expanded="false" aria-controls="collapseClientes">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>Clientes<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="collapseClientes" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="#" data-toggle="modal" data-target="#novoCliente">Novo Cliente</a>
                                    <a class="nav-link" href="<?php echo BASEURL; ?>cadastros/clientes/">Todos os Clientes</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOutros" aria-expanded="false" aria-controls="collapseCadastros">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>Mais Cadastros<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="collapseOutros" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo BASEURL; ?>cadastros/campanhas/">Campanhas</a>
                                    <a class="nav-link" href="<?php echo BASEURL; ?>cadastros/materias/">Matérias</a>
                                    <a class="nav-link" href="<?php echo BASEURL; ?>cadastros/pacotes/">Pacotes</a>  
                                    <a class="nav-link" href="<?php echo BASEURL; ?>cadastros/representantes/">Representantes</a>
                                    <a class="nav-link" href="<?php echo BASEURL; ?>cadastros/usuarios/">Usuários</a>
                                </nav>
                            </div> 

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>Configurações<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">

                                <a class="nav-link" href="<?php echo BASEURL; ?>cadastros/permissoes/">Permissões</a>                                

                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    	E-mails
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>

                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                        	<a class="nav-link" href="<?php echo BASEURL; ?>cadastros/emails/templates/">Templates</a>
                                    		<a class="nav-link" href="<?php echo BASEURL; ?>cadastros/emails/templates-outlook">Templates do Outlook</a>
                                        </nav>
                                    </div>

                                </nav>
                            </div>

                            <div class="sb-sidenav-menu-heading">Relatórios</div>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRelatorios" aria-expanded="false" aria-controls="collapseRelatorios">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Relatórios 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="collapseRelatorios" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo BASEURL; ?>relatorios/">Emitir Relatórios</a>
                                    <a class="nav-link" href="<?php echo BASEURL; ?>relatorios/emails-enviados.php">E-mails Enviados</a> 
                                </nav>
                            </div> 
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">

                        <?php if (isLoggedIn()): ?>

                        <div class="small">Logado como:</div>
                        <?php echo $_SESSION['user_name']; ?>

                        <?php else: ?>

                        <div class="small">Seja bem vindo,</div>
                        Visitante
            
                        <?php endif ?>
                    </div>

                </nav>
            </div>

            <?php endif; ?>

            <div id="layoutSidenav_content">

                <main>

                    <div class="container-fluid">

                        <?php if (isLoggedIn()): ?>

                        <h1 class="mt-4"><?php echo $pageTitle = isset($pageTitle) ? $pageTitle : 'Título da Página'; ?></h1>

                        <ol class="breadcrumb mb-4">
                            
                            <li class="breadcrumb-item"><a href="<?php echo BASEURL; ?>">Painel Inicial</a></li>
                            
                            <?php if (isset($parentPage)): ?>
                                <li class="breadcrumb-item"><a href="<?php echo $parentLink = isset($parentLink) ? $parentLink : 'index.php'; ?>"><?php echo $parentPage; ?></a></li>
                            <?php endif ?>

                            <li class="breadcrumb-item active" aria-current="page"><?php echo $pageTitle = isset($pageTitle) ? $pageTitle : 'Título da Página'; ?></li>
                        </ol>
                        
                        <?php else: ?>
                        <h1 class="mt-4">Efetuar Login</h1>
                        <?php endif; ?>

                    </div>