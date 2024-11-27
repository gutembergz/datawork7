<?php
session_start();
require '../../../init.php';  // configurar as variáveis de conexão
require '../../../check.php';
require '../../../vendor/autoload.php';
use PHPJasper\PHPJasper; 

$user = $_SESSION['user_name'] ? $_SESSION['user_name'] : null;
$reportTitle = "Impressão de Postagens";
$idMateriaContratada = isset($_POST['idMateriaContratada']) ? $_POST['idMateriaContratada'] : null;
$empresa = isset($_POST['empresa']) ? $_POST['empresa'] : null;
$nContrato = isset($_POST['nContrato']) ? $_POST['nContrato'] : null;
$query = "WHERE idMateriaContratada = " . $idMateriaContratada;

$input = __DIR__ . '/arquivos/jasper/postagens.jrxml';  
$output = __DIR__ . '/arquivos/pdf';  
$options = [
    'format' => ['pdf'],
    'locale' => 'pt',        
    'params' => ['nome_usuario' => $user, 'titulo_relatorio' => $reportTitle, 'empresa' => $empresa, 'nContrato' => $nContrato, 'query' => $query],        
    'db_connection' => [
        'driver' => 'mysql', 
        'username' => DB_USER,
        'password' => DB_PASS,
        'host' => DB_HOSTB,
        'database' => DB_NAME,
        'port' => DB_PORT
    ]
];

$jasper = new PHPJasper;

$jasper->process(
    $input,
    $output,
    $options
)->execute();

//// testes e debug abaixo:

    // print $jasper->process(
    //     $input,
    //     $output,
    //     $options
    // )->output();

    // print_r($jasper) ;

//variáveis para abertura do relatório
$output = __DIR__ . '/arquivos/pdf';
$ext = 'pdf';
$filename = 'postagens';

// chama a função e abre o relatório no navegador
viewReport($output, $ext, $filename);

?>