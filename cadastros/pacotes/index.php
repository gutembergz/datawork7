<?php
session_start();
require_once '../../init.php';
require '../../check.php';
$pageTitle = 'Cadastro de Pacotes de Matérias';

require '../../classes/pacotes.class.php';
$pc = new Pacotes();
$pacotes = $pc->getPacotes();
?>

<?php include (HEADER_TEMPLATE);?>

<div class="container-fluid"> 
          
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>                        
                    <th scope="col">Pacote</th>                    
                    <th scope="col">Status</th>
                    <th scope="col">Edição</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pacotes as $pacote): ?>
                    <tr>
                        <td scope="row"><?php echo $pacote['pacote'] ?></td>                        
                        <td scope="row"><?php echo ($pacote['idStatus'] == '1') ? '<span class="badge badge-success">Ativado</span>' : '<span class="badge badge-warning">Desativado</span>' ?></td>
                        <td scope="row"><a class="btn btn-warning btn-sm" href="form-edit.php?id=<?php echo $pacote['id'] ?>" role="button"><i class="far fa-edit"></i> Editar</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<?php include (FOOTER_TEMPLATE);?>