<?php
session_start();
require_once '../init.php';
require '../check.php';
$pageTitle = 'Relatório de Contratos';
$parentPage = 'Relatórios';
 
// abre a conexão
$PDO = db_connect();
 
// SQL para contar o total de registros
// A biblioteca PDO possui o método rowCount(), mas ele pode ser impreciso.
// É recomendável usar a função COUNT da SQL
// Veja o Exemplo 2 deste link: http://php.net/manual/pt_BR/pdostatement.rowcount.php
       
        $idCampanha = $_GET["idCampanha"];
        $idStatus = $_GET["idStatus"];

        $sql = "SELECT clientes.id, clientes.empresa, contratos.id, 
        contratos.nContrato, contratos.idCliente, contratos.idCampanha, contratos.idStatus,
        contratos.prazo, contratos.dataRegistro, contratos.idStatus, contratos.valor, 
        contratos.idCampanha, campanhas.campanha
        FROM clientes 
        RIGHT JOIN contratos ON clientes.id = contratos.idCliente
        LEFT JOIN campanhas ON contratos.idCampanha = campanhas.id
        WHERE (campanhas.id LIKE '%".$idCampanha."%') AND
              (contratos.idStatus LIKE '%".$idStatus."%')

        ORDER BY empresa ASC";

        // ainda vamos exibir o número incorreto de linhas. ajustar conforme a pesquisa.
        $sql_count = "SELECT COUNT(*) AS total 
        FROM clientes
        RIGHT JOIN contratos ON clientes.id = contratos.idCliente
        LEFT JOIN campanhas ON contratos.idCampanha = campanhas.id
        WHERE (campanhas.id LIKE '%".$idCampanha."%') AND
              (contratos.idStatus LIKE '%".$idStatus."%') ";

// conta o total de registros
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();
 
// seleciona os registros
$stmt = $PDO->prepare($sql);
$stmt->execute();

?>

<?php include (HEADER_TEMPLATE);?>

<div class="container-fluid">
  <div class="row">
    <div class="col p-3">
      <h2>Relatório de Contratos <?php echo $idCampanha;?></h2>
    </div>
  </div>
</div>

<div class="container-fluid"> 

    <?php if ($total > 0): ?>        
 
        <div class="table-responsive">
            <table class="table table-hover" id="tblRelatorio___">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Contrato</th>
                        <th scope="col">Empresa</th>
                        <th scope="col">Campanha</th>
                        <th scope="col">Prazo</th>
                        <th scope="col">Data</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($contrato = $stmt->fetch(PDO::FETCH_ASSOC)): ?>

                    <?php 
                        $idContrato = $contrato['id'];
                        $sql2 = "SELECT * FROM materiasContratadas WHERE idContrato = $idContrato";
                        $stmt2 = $PDO->prepare($sql2);
                        $stmt2->execute();

                        $sql_count2 = "SELECT COUNT(*) AS total FROM materiasContratadas WHERE idContrato = $idContrato";
                        $stmt_count2 = $PDO->prepare($sql_count2);
                        $stmt_count2->execute();
                        $total2 = $stmt_count2->fetchColumn();
                    ?>
                        
                    <tr class="clickable" data-toggle="collapse" data-target="#group-of-rows-<?php echo $idContrato;?>" aria-expanded="false" aria-controls="group-of-rows-<?php echo $idContrato;?>">
                        <td><div id="button-materias"><i class="fa fa-plus <?php echo ($total2 == 0) ? 'text-secondary' : 'text-primary' ?>" aria-hidden="true"></i></div></td>
                        
                        <th scope="row"><a href="../cadastros/contratos/form-edit.php?id=<?php echo $contrato['id'] ?>"> <?php echo $contrato['nContrato'] ?></a></th>
                        <th scope="row"><a href="../cadastros/clientes/form-edit.php?id=<?php echo $contrato['idCliente'] ?>"> <?php echo $contrato['empresa'] ?></a></th>  

                        <td><?php echo $contrato['campanha'] ?></td>
                        <td><?php echo $contrato['prazo'] ?> dias</td>
                        <td><?php echo dateConvert($contrato['dataRegistro']) ?></td>
                        <td><?php echo "R$ ". number_format($contrato['valor'], 2, ',', '.') ?></td>
                        <td><?php echo ($contrato['idStatus'] == '1') ? '<span class="badge badge-success">Vigente</span>' : '<span class="badge badge-warning">Expirado</span>'?></td>
                    </tr>
       
                    <tbody id="group-of-rows-<?php echo $idContrato; ?>" class="collapse"> 
                        <?php
                        while ($materias = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr><td></td>";
                        echo '<td colspan="7">Plano Plus ' . $idContrato . "  " . $materias['id'] . ' ';

                        echo '<a target= "_blank" href="../cadastros/contratos/materias/form-edit.php?id=' . $materias['id'] . '">' . $contrato['nContrato'] . '</a></td>';
                        
                        echo '</tr>';
                        
                        }
                    ?>
                         
                    </tbody>

                    <?php endwhile; ?>
               
                </tbody>

            </table>
        </div>

        <?php else: ?>
 
        <p>Nenhum contrato encontrado.</p>

        </div>
 
        <?php endif; ?>

        </div>

<?php include (FOOTER_TEMPLATE);?>