<?php
session_start();
require_once '../../init.php';
require '../../check.php';
$pageTitle = 'Editar Usuário';
$parentPage = 'Usuários';

include (HEADER_TEMPLATE); ?>

<div class="container-fluid">
    
    <?php 
    require '../../classes/usuarios.class.php';
    $u = new Usuarios();

    if (isset($_POST['name']) && !empty($_POST['name'])) {

        $name = addslashes($_POST['name']);
        $email = addslashes($_POST['email']);
        $password = addslashes(make_hash($_POST['password']));
        $idStatus = addslashes($_POST['idStatus']);
        $idRole = addslashes($_POST['idRole']);
        $gender = addslashes($_POST['gender']);
        $dataAlteracao = date("Y-m-d H:i:s"); // equivale à função now() em SQL        

        $u->editUsuario($name, $email, $password, $idStatus, $idRole, $gender, $dataAlteracao, $_GET['id']);

        ?>
            <div class="alert alert-success">
                Usuário alterado com sucesso!
            </div>
        <?php 
    }

    if (isset($_GET['id']) && !empty($_GET['id']) || empty($usuario)) {
        $usuario = $u->getUsuario($_GET['id']);

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
    </ul>

    <div class="tab-content" id="tabDadosUsuarioConteudo">
            
        <div class="tab-pane fade show active" id="principal" role="tabpanel" aria-labelledby="principal-tab">
          
            <form method="post" autocomplete="off">

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
                        <label for="password">Senha</label>
                        <input class="form-control" type="password" name="password" id="password" value="<?php echo $usuario['password'] ?>" autocomplete="off">
                    </div>
                </div>

                <div class="form-row">                    
                    <div class="form-group col-md-4">                                  
                        <label for="gender">Gênero</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="gender" id="gender_m" value="0" <?php if ($usuario['gender'] == '0'): ?> checked="checked" <?php endif; ?> required>
                            <label class="custom-control-label" for="gender_m">Masculino</label>
                        </div>
                        
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="gender" id="gender_f" value="1" <?php if ($usuario['gender'] == '1'): ?> checked="checked" <?php endif; ?> required>
                            <label class="custom-control-label" for="gender_f">Feminino</label>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="idRole">Nível de Permissão</label>
                        <select class="form-control" name="idRole" id="idRole" required>
                            <option value="">Selecionar Permissão</option>
                            <?php 
                            require '../../classes/permissoes.class.php';
                            $p = new Permissoes();
                            $roles = $p->getPermissoes();
                            foreach($roles as $role): ?>
                                <option value="<?php echo $role['id'];?>" <?php echo ($usuario['idRole']==$role['id'])?'selected="selected"':''; ?>><?php echo $role['role'];?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <div class="form-group col-md-4">                                  
                        <label for="idStatus">Status</label>
                        <select class="form-control" name="idStatus" id="idStatus" required>
                            <option value="0" <?php if ($usuario['idStatus'] == '0'): ?> selected="selected" <?php endif; ?>>Desativado</option>
                            <option value="1" <?php if ($usuario['idStatus'] == '1'): ?> selected="selected" <?php endif; ?>>Ativado</option>
                        </select>
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

                <!-- campos ocultos -->
                <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                

                <!-- botões -->
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Salvar Alterações">
                    <a class="btn btn-danger" href="delete.php?id=<?php echo $usuario['id']; ?>" onclick="return confirm('Tem certeza de que deseja excluir este usuário?');" role="button">Excluir Usuário</a>
                </div>
            
            </form>

        </div>

    </div>

</div>

<?php include (FOOTER_TEMPLATE);?>