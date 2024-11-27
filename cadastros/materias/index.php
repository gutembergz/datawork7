<?php
session_start();
require_once '../../init.php';
require '../../check.php';
$pageTitle = 'Cadastro de Matérias';

require '../../classes/materias.class.php';
$m = new Materias();
$materias = $m->getMaterias();
?>

<?php include (HEADER_TEMPLATE);?>

<div class="container-fluid"> 
       
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>                    
                    <th scope="col">Matéria</th>
                    <th scope="col">Descrição</th>
                    <th scope="col" style="width:10px">Edição</th>                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($materias as $materia): ?>
                <tr>                  
                    <td scope="row"><?php echo $materia['materia'] ?></td>
                    <td><?php echo $materia['descMateria'] ?></td> 
                    <td scope="row"><a class="btn btn-warning btn-sm" href="form-edit.php?id=<?php echo $materia['id'] ?>" role="button"><i class="far fa-edit"></i> Editar</a></td>                   
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<a class="float bg-primary text-white" href="form-add.php" role="button" target="_blank" data-toggle="tooltip" data-placement="top" title="Nova Matéria">
    <i class="fas fa-plus float-button"></i>
</a>

<?php include (FOOTER_TEMPLATE);?>