<?php
require_once '../../init.php';
require '../../check.php';
require '../../classes/emails.class.php';
$e = new Emails();
$emailsContrato = $e->getEmailsContrato($id); 
?>

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
            <?php foreach ($emailsContrato as $emails): ?>
            <tr>
                <td><?php $dataEnvio = strtotime($emails['dataEnvio']); echo date('d/m/Y H:i:s',$dataEnvio); ?></td>
                <td><?php echo $emails['nomeUsuario']; ?></a></td>
                <td><?php echo $emails['assunto']; ?></td>
                <td><?php echo $emails['destinatario']; ?></td>                
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<form action="<?php echo BASEURL;?>cadastros/emails/index.php" method="GET">                  
    <input type="hidden" name="idContrato" value="<?php echo $id; ?>">
    <input type="hidden" name="nContrato" value="<?php echo $contrato['nContrato']; ?>">
    <input type="hidden" name="empresa" value="<?php echo $contrato['empresa']; ?>">
    <button class="btn float bg-primary text-white" data-toggle="tooltip" data-placement="top" title="Redigir E-mail" type="submit" value="Submit"><i class="fas fa-envelope"></i></button>
</form>