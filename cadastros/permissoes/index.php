<?php
session_start();
require_once '../../init.php';
require '../../check.php';
$pageTitle = 'Cadastro de Permissões';

require '../../classes/permissoes.class.php';
$p = new Permissoes();
$permissoes = $p->getPermissoes();
?>

<?php include (HEADER_TEMPLATE);?>

<div class="container-fluid">

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Permissão</th>
                    <th scope="col">Descrição</th>
                    <th scope="col" style="width:10px">Edição</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($permissoes as $permissao): ?>
                <tr>
                    <td><?php echo $permissao['role'];?></td>
                    <td><?php echo $permissao['descricao'];?></td>
                    <td scope="row"><a class="btn btn-warning btn-sm" href="form-edit.php?id=<?php echo $permissao['id'] ?>" role="button"><i class="far fa-edit"></i> Editar</a></td> 
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<?php include (FOOTER_TEMPLATE);?>