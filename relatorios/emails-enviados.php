<?php
session_start();
require_once '../init.php';
require '../check.php';
$pageTitle = 'E-mails Enviados';

require '../classes/emails.class.php';
$e = new Emails();
$emails = $e->getEmailsEnviados(); ?>

<?php include (HEADER_TEMPLATE);?>

<div class="container-fluid"> 
    <div class="table-responsive">
        <table class="table table-hover" id="tblEmailsEnviados">
            <thead>
                <tr>
                    <th scope="col">Data de Envio</th>
                    <th scope="col">Usuário</th>
                    <th scope="col">Assunto</th>
                    <th scope="col">Destinatário</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($emails as $email): ?>
                <tr>
                    <td><?php $dataEnvio = strtotime($email['dataEnvio']); echo date('d/m/Y H:i:s',$dataEnvio); ?></td>
                    <td><?php echo $email['nomeUsuario']; ?></td>
                    <td><?php echo $email['assunto'] == null ? 'E-mail de Contato' : $email['assunto']; ?></a></th>
                    <td><?php echo $email['destinatario']; ?></td>
                    
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>     
</div>

<a class="float bg-primary text-white" href="../cadastros/emails/" role="button" target="_blank" data-toggle="tooltip" data-placement="top" title="Redigir E-mail">
    <i class="fas fa-envelope float-button"></i>
</a>

<?php include (FOOTER_TEMPLATE);?>