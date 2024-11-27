<?php
session_start();
require_once '../../init.php';
require '../../check.php';
$pageTitle = 'Cadastro de Usuários';
 
require '../../classes/usuarios.class.php';
$u = new Usuarios();
$usuarios = $u->getUsuarios();
?>

<?php include (HEADER_TEMPLATE);?>

<div class="container-fluid"> 
     
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Usuário</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Data de Registro</th>
                    <th scope="col">Nível de Permissão</th>
                    <th scope="col">Status</th>
                    <th scope="col" style="width:10px">Edição</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo $usuario['name'] ?></td>
                    <td><?php echo $usuario['email'] ?></td>
                    <td><?php echo dateConvert($usuario['dataRegistro']); ?></td>
                    <td><?php echo $usuario['role'] ?></td>
                    <td><?php echo ($usuario['idStatus'] == '1') ? '<span class="badge badge-success">Ativado</span>' : '<span class="badge badge-danger">Desativado</span>' ?></td>
                    <td><a class="btn btn-warning btn-sm" href="form-edit.php?id=<?php echo $usuario['id'] ?>" role="button"><i class="far fa-edit"></i> Editar</a></td>                    
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
</div>

<a class="float bg-primary text-white" href="form-add.php" role="button" data-toggle="tooltip" data-placement="top" title="Novo Usuário">
    <i class="fas fa-plus float-button"></i>
</a>

<?php include (FOOTER_TEMPLATE);?>