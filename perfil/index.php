<?php
session_start();
require_once '../init.php';
require '../check.php';
$pageTitle = 'Editar Perfil';

// pega o ID do usuário na sessão
$id = $_SESSION['user_id'];?>                

<?php include (HEADER_TEMPLATE); ?>

<div class="container-fluid">

    <?php 
    require '../classes/usuarios.class.php';
    $u = new Usuarios();

    if (isset($_POST['name']) && !empty($_POST['name'])) {

        $name = addslashes($_POST['name']);
        $email = addslashes($_POST['email']);
        $password = addslashes(make_hash($_POST['password']));
        $dataAlteracao = date("Y-m-d H:i:s"); // equivale à função now() em SQL        

        $u->editPerfilUsuario($name, $email, $password, $dataAlteracao, $id);

        ?>
            <div class="alert alert-success">
                Seu perfil foi alterado com sucesso!
            </div>
        <?php 
    }   
    
    if (isset($_GET['id']) && !empty($_GET['id']) || empty($usuario)) {
        $usuario = $u->getUsuario($id);

        if (empty($usuario)) {
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

    <ul class="nav nav-tabs mb-3" id="tabDadosUsuario" role="tablist">

        <li class="nav-item">
            <a class="nav-link active" id="principal-tab" data-toggle="tab" href="#principal" role="tab" aria-controls="principal" aria-selected="true">Principal</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="perfil-tab" data-toggle="tab" href="#perfil" role="tab" aria-controls="perfil" aria-selected="false">Imagem de Perfil</a>
        </li>
        
    </ul>

    <div class="tab-content" id="tabDadosUsuarioConteudo">
            
        <div class="tab-pane fade show active" id="principal" role="tabpanel" aria-labelledby="principal-tab">
          
            <form method="POST" autocomplete="off">

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="name">Nome do Usuário</label>
                        <input class="form-control" type="text" name="name" id="name" maxlength="25" value="<?php echo $usuario['name'] ?>" required>
                        
                    </div>

                    <div class="form-group col-md-4">
                        <label for="email">E-mail</label>
                        <input class="form-control" type="email" name="email" id="email" value="<?php echo $usuario['email'] ?>" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="password">Nova Senha</label>
                        <input class="form-control" type="password" name="password" id="password" value="<?php echo $usuario['password'] ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6"> 
                        <label for="dataRegistro">Data de Registro </label>
                        <?php $dataRegistro = strtotime($usuario['dataRegistro']);?>
                        <input class="form-control" type="text" name="dataRegistro" id="dataRegistro" value="<?php echo date('d/m/Y H:i:s',$dataRegistro); ?>" readonly>
                    </div>
                    <div class="form-group col-md-6"> 
                        <label for="dataAlteracao">Data de Alteração </label>
                        <?php $dataAlteracao = strtotime($usuario['dataAlteracao']);?>
                        <input class="form-control" type="text" name="dataAlteracao" id="dataAlteracao" value="<?php echo $usuario['dataAlteracao']== 0 ? 'Sem Alterações' : date('d/m/Y H:i:s',$dataAlteracao); ?>" readonly>
                    </div>
                </div>
                
                <!-- botões -->
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Salvar Alterações">
                </div>
            
            </form>
        </div>
    
        <div class="tab-pane fade" id="perfil" role="tabpanel" aria-labelledby="perfil-tab">
            <div class="container-fluid"> 

                <div class="row">
                    <div class="col">
                        <h3>Imagem do Perfil</h3>
                        
                        <?php 

                            $arquivo = $usuario['filename']; //arquivo único

                            if (!empty($arquivo)):$imagem = "../images/users/".$arquivo; ?>

                                <a href="<?php echo $imagem;?>" data-toggle="lightbox">

                                    <img src="<?php echo $imagem; ?>" class="img-thumbnail" height= "300px" width="300px" />

                                </a><br/><br/>

                                <form method="POST" action="delete-avatar.php">                                    
                                    <input type="hidden" name="filename" value="<?php echo $usuario['filename']; ?>">
                                    <input class="btn btn-danger" type="submit" name="excluir" value="Excluir Imagem" onclick="return confirm('Tem certeza de que deseja excluir?');">
                                </form>

                        <?php else: ?>
                           
                            <em>Sem imagem enviada.</em>

                        <?php endif; ?>

                    </div>

                    <div class="col">                      
                                                
                        <h3>Upload de Imagem</h3>
                        
                        <form method="POST" enctype="multipart/form-data" action="upload-avatar.php">
                            <div class="form-group">
                                <input type="hidden" name="filename" value="<?php echo $usuario['filename']; ?>">
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

<?php include (FOOTER_TEMPLATE);?>