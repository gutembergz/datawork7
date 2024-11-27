<?php
require_once '../../init.php';
require '../../check.php';
require '../../classes/contratos.class.php';
$ct = new Contratos();
$clienteContratos = $ct->getContratosCliente($idCliente);
?>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Contrato</th>
                <th scope="col">Campanha</th>
                <th scope="col">Data do Contrato</th>
                <th scope="col">Prazo</th>                    
                <th scope="col">Valor</th>
                <th scope="col">Status</th>
                <th scope="col">Edição</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clienteContratos as $clienteContrato): ?>
            <tr>
                <th scope="row"><?php echo $clienteContrato['nContrato']; ?></th>
                <td><?php echo $clienteContrato['campanha']; ?></td>
                <td><?php echo dateConvert($clienteContrato['dataRegistro']); ?></td>
                <td><?php echo $clienteContrato['prazo']; ?> dias</td>
                <td><?php echo "R$ ". number_format($clienteContrato['valor'], 2, ',', '.'); ?></td>                   
                <td><span class="badge badge-<?php echo statusColor($clienteContrato['status']); ?>"><?php echo $clienteContrato['status']; ?></span></td>
                <td><a class="btn btn-warning btn-sm" href="../contratos/form-edit.php?id=<?php echo $clienteContrato['id']; ?>" role="button"><i class="far fa-edit"></i> Editar</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<form action="<?php echo BASEURL; ?>cadastros/contratos/form-add.php" method="GET">
    <input type="hidden" name="idCliente" value="<?php echo $cliente['id']; ?>">
    <input type="hidden" name="nomeCliente" value="<?php echo $cliente['empresa']; ?>">  
    <button class="btn float bg-primary text-white" data-toggle="tooltip" data-placement="top" title="Novo Contrato" type="submit" value="Submit"><i class="fas fa-plus"></i></button>
</form>