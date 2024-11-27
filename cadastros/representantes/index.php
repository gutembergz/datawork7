<?php
session_start();
require_once '../../init.php';
require '../../check.php';
$pageTitle = 'Cadastro de Representantes';

require '../../classes/representantes.class.php';
$r = new Representantes();
$representantes = $r->getRepresentantes();
?>

<?php include (HEADER_TEMPLATE);?>

<div class="container-fluid"> 

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>                    
                    <th scope="col">Representante</th>
                    <th scope="col">Data de Nascimento</th> 
                    <th scope="col">CPF</th>
                    <th scope="col" style="width:10px">Edição</th>                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($representantes as $representante): ?>
                <tr>                                     
                    <td scope="row"><?php echo $representante['nome'] ?></td>                
                    <td><?php echo dateConvert($representante['dataNascimento']) ?></td>                   
                    <td><?php echo $representante['cpf'] ?></a></td>
                    <td scope="row"><a class="btn btn-warning btn-sm" href="form-edit.php?id=<?php echo $representante['id'] ?>" role="button"><i class="far fa-edit"></i> Editar</a></td>                     
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
</div>

<a class="float bg-primary text-white" href="form-add.php" role="button" target="_blank" data-toggle="tooltip" data-placement="top" title="Novo Representante ">
    <i class="fas fa-plus float-button"></i>
</a>

<?php include (FOOTER_TEMPLATE);?>