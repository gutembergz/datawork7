<?php
require_once '../../init.php';
require '../../check.php';
$historicoContrato = $ct->getHistoricosContrato($id); //já instanciamos a classe no arquivo form-edit.php
?>

<div class="table-responsive">
    <table class="table table-hover" id="tblHistoricoCt">
        <thead>
            <tr>
                <th scope="col">Data de Registro</th>
                <th scope="col">Usuário</th>
                <th scope="col">Histórico</th>
                <th scope="col">Edição</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($historicoContrato as $historico): ?>
            <tr>
                <td><?php $dataRegistro = strtotime($historico['dataRegistro']); echo date('d/m/Y H:i:s',$dataRegistro); ?></td>
                <td><?php echo $historico['nomeUsuario'] ?> </a></td>
                <td><?php echo substrwords($historico['infoHistorico'],60);?></a></td>
                <td><a class="btn btn-warning btn-sm" href="historico/form-edit.php?id=<?php echo $historico['id']."&idContrato=".$historico['idContrato']."&nContrato=".$historico['nContrato']."&empresa=".urlencode($historico['empresa']);?>" role="button"><i class="far fa-edit"></i> Editar</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<form action="<?php echo BASEURL; ?>cadastros/contratos/historico/form-add.php" method="POST">
    <input type="hidden" name="idContrato" value="<?php echo $id; ?>">
    <input type="hidden" name="nContrato" value="<?php echo $contrato['nContrato']; ?>">  
    <input type="hidden" name="empresa" value="<?php echo $contrato['empresa']; ?>">  
    <button class="btn float bg-primary text-white" data-toggle="tooltip" data-placement="top" title="Adicionar Histórico" type="submit" value="Submit"><i class="fas fa-plus"></i></button>
</form>