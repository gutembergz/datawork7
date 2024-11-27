<?php
require_once '../../init.php';
require '../../classes/contratos.class.php';

$ct = new Contratos();
$expirados = $ct->getContratosExpirados();

if ($expirados) {
	echo "Há contratos a expirar...<br>";
	$ct->updateContratosExpirados();
	foreach ($expirados as $row) {
        echo "Alterado status do contrato #$row[0]. Motivo: Expirado.<br>"; 
    }
} else { 
    echo "Sem alterações."; 
} 