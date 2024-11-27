<?php
session_start();
require_once '../../init.php';
require '../../check.php';
$pageTitle = 'Novo Usuário';
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
        $dataRegistro = date("Y-m-d H:i:s"); // equivale à função now() em SQL
        
        $u->addUsuario($name, $email, $password, $idStatus, $idRole, $gender, $dataRegistro);
        ?>
            <div class="alert alert-success">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Usuário adicionado com sucesso! Redirecionando...
                <script type="text/javascript">
                    setTimeout(function(){
                        window.location.href ='form-edit.php?id=<?php echo $lastId;?>';
                     }, 3000);
                </script>
            </div>
        <?php 
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
                        <label for="name">Nome do Usuário</label><br>
                        <input class="form-control" type="text" name="name" id="name" maxlength="25" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="email">E-mail</label><br>
                        <input class="form-control" type="email" name="email" id="email" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="password">Senha</label><br>
                        <input class="form-control" type="password" name="password" id="password" autocomplete="new-password" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">                                  
                        <label for="gender">Gênero</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="gender" id="gender_m" value="0" required>
                            <label class="custom-control-label" for="gender_m">Masculino</label>
                        </div>
                        
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="gender" id="gender_f" value="1" required>
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
                                <option value="<?php echo $role['id'];?>"><?php echo $role['role'];?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <div class="form-group col-md-4">                                  
                        <label for="idStatus">Status</label><br>
                        <select class="form-control" name="idStatus" id="idStatus" required>
                            <option value="0">Desativado</option>
                            <option value="1" selected="selected">Ativado</option>

                        </select>
                    </div>
                </div>

                <!-- botões -->
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Cadastrar">
                </div>
            </form>

        </div>

    </div>

</div>

<?php include (FOOTER_TEMPLATE);?>