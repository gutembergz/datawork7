<?php
session_start();
require_once '../../../init.php';
require '../../../check.php';
$pageTitle = 'Templates de E-mails';

require '../../../classes/emailsTemplates.class.php';
$et = new EmailsTemplates();
$emailsTemplates = $et->getEmailsTemplatesIndex();
?>

<?php include (HEADER_TEMPLATE);?>

<div class="container-fluid"> 
          
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>                        
                    <th scope="col">Assunto</th>
                    <th scope="col">Tipo de E-mail</th>
                    <th scope="col">Status</th>
                    <th scope="col">Edição</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($emailsTemplates as $emailTemplate): ?>
                    <tr>
                        <td scope="row"><?php echo $emailTemplate['assunto'] ?></td>
                        <td scope="row"><?php echo $emailTemplate['tipoEmail'] ?></td>
                        <td scope="row"><?php echo ($emailTemplate['idStatus'] == '1') ? '<span class="badge badge-success">Ativado</span>' : '<span class="badge badge-warning">Desativado</span>' ?></td>
                        <td scope="row"><a class="btn btn-warning btn-sm" href="form-edit.php?id=<?php echo $emailTemplate['id'] ?>" role="button"><i class="far fa-edit"></i> Editar</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<a class="float bg-primary text-white" href="form-add.php" role="button" target="_blank" data-toggle="tooltip" data-placement="top" title="Novo Template">
    <i class="fas fa-plus float-button"></i>
</a>

<?php include (FOOTER_TEMPLATE);?>