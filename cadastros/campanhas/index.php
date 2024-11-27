<?php
session_start();
require_once '../../init.php';
require '../../check.php';
$pageTitle = 'Cadastro de Campanhas';

require '../../classes/campanhas.class.php';
$c = new Campanhas();
$campanhas = $c->getCampanhas();
?>

<?php include (HEADER_TEMPLATE);?>

<div class="container-fluid"> 
     
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Campanha</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Status</th>
                    <th scope="col" style="width:10px">Edição</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($campanhas as $campanha): ?>
                    <tr>
                        <td scope="row"><?php echo $campanha['campanha'] ?></td>
                        <td scope="row"><?php echo $campanha['descCampanha'] ?></td>
                        <td scope="row"><?php echo ($campanha['idStatus'] == '1') ? '<span class="badge badge-success">Ativado</span>' : '<span class="badge badge-warning">Desativado</span>' ?></td>
                        <td scope="row"><a class="btn btn-warning btn-sm" href="form-edit.php?id=<?php echo $campanha['id'] ?>" role="button"><i class="far fa-edit"></i> Editar</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<a class="float bg-primary text-white" href="form-add.php" role="button" target="_blank" data-toggle="tooltip" data-placement="top" title="Nova Campanha">
    <i class="fas fa-plus float-button"></i>
</a>

<?php include (FOOTER_TEMPLATE);?>