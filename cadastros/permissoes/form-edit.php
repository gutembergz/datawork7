<?php
session_start();
require_once '../../init.php';
require '../../check.php';

$PDO = db_connect();

// pega o ID da URL
$idRole = isset($_GET['id']) ? (int) $_GET['id'] : null;

// valida o ID
if (empty($idRole))
{
    echo "ID para alteração não definido";
    exit;
}

$sql = "SELECT roles.role, paginas.titulo, paginas.arquivo, paginas.secao, paginasAcessos.idAcesso, paginasAcessos.idRole, paginasAcessos.idPagina, paginasAcessos.consultar, paginasAcessos.incluir, paginasAcessos.editar, paginasAcessos.excluir   
FROM paginasAcessos
LEFT JOIN paginas ON paginas.idPagina = paginasAcessos.idPagina
LEFT JOIN roles ON roles.idRole = paginasAcessos.idRole 
WHERE paginasAcessos.idRole = :idRole
ORDER BY idAcesso";

$sql_count = "SELECT COUNT(*) AS total FROM paginasAcessos";

// conta o total de registros
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();
 
// seleciona os registros
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':idRole', $idRole, PDO::PARAM_INT);
$stmt->execute();

$pageTitle = 'Editar Permissão';
$parentPage = 'Permissões';
?>

<?php include (HEADER_TEMPLATE); ?>

<div class="container-fluid"> 
   <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Permissão</th>
                    <th>Página</th>
                    <th>Consultar</th>
                    <th>Incluir</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($acessos = $stmt->fetch(PDO::FETCH_ASSOC)): ?>

                <tr>
                    <td><input class="checkall" type="checkbox"></td>
                    <td><strong><?php echo $acessos["role"]; ?></strong></td>
                    <td><?php echo $acessos["titulo"]; ?></td>
                    <td><input class="flipswitch" type="checkbox" name="consultar" id="<?php echo $acessos["idAcesso"]; ?>" value=<?php echo $acessos["consultar"]==1?'"1" checked':''; ?>/></td>
                    <td><input class="flipswitch" type="checkbox" name="incluir" id="<?php echo $acessos["idAcesso"]; ?>" value=<?php echo $acessos["incluir"]==1?'"1" checked':''; ?>/></td>
                    <td><input class="flipswitch" type="checkbox" name="editar" id="<?php echo $acessos["idAcesso"]; ?>" value=<?php echo $acessos["editar"]==1?'"1" checked':''; ?>/></td>
                    <td><input class="flipswitch" type="checkbox" name="excluir" id="<?php echo $acessos["idAcesso"]; ?>" value=<?php echo $acessos["excluir"]==1?'"1" checked':''; ?>/></td>
                </tr>

                <?php endwhile; ?>
            </tbody>
        </table>
   </div>
</div>
<?php include (FOOTER_TEMPLATE);?>