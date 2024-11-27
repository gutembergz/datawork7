<?php
session_start();
require '../init.php';  // configurar as variáveis de conexão
require '../check.php';
require '../vendor/autoload.php';
use PHPJasper\PHPJasper; 

$user = $_SESSION['user_name'] ? $_SESSION['user_name'] : null;
$reportTitle = "Relatório de Contratos";

$idCampanha = isset($_POST['idCampanha']) ? $_POST['idCampanha'] : null;
$idStatus = isset($_POST['idStatus']) ? $_POST['idStatus'] : null;
$dataInicial = isset($_POST['dataInicial']) ? $_POST['dataInicial'] : null;
$dataFinal = isset($_POST['dataFinal']) ? $_POST['dataFinal'] : null;
$contratoInicial = isset($_POST['contratoInicial']) ? $_POST['contratoInicial'] : null;
$contratoFinal = isset($_POST['contratoFinal']) ? $_POST['contratoFinal'] : null;

if (isset($_POST['idCampanha'])) {
    $campanhas = '';
    foreach ($_POST['idCampanha'] as $value) {
        if ($campanhas!='') $campanhas.=', ';
        $campanhas.= $value;
        } 
} else {
    $campanhas = '';
}

if (isset($_POST['idStatus'])) {
    $statuses = '';
    foreach ($_POST['idStatus'] as $value) {
        if ($statuses!='') $statuses.=', ';
        $statuses.= $value;
        } 
} else {
    $statuses = '';
}

$filtroString = array('1=1'); // para não dar erro no WHERE vazio

if(!empty($idCampanha)) {
    $filtroString[] = DB_NAME.".contratos.idCampanha IN (".$campanhas.")";
}

if(!empty($idStatus)) {
    $filtroString[] = DB_NAME.".contratos.idStatus IN (".$statuses.")";
}

if(!empty($dataInicial) && !empty($dataFinal)) {
    $filtroString[] = DB_NAME.".contratos.dataRegistro BETWEEN '".$dataInicial."' AND '".$dataFinal."'";
}

if(!empty($contratoInicial) && !empty($contratoFinal)) {
    $filtroString[] = DB_NAME.".contratos.nContrato BETWEEN ".$contratoInicial." AND ".$contratoFinal;
}

$query = "WHERE ".implode(" AND ", $filtroString);

$input = __DIR__ . '/arquivos/jasper/contratos.jrxml';  
$output = __DIR__ . '/arquivos/pdf';  
$options = [
    'format' => ['pdf'],
    'locale' => 'pt',        
    'params' => ['nome_usuario' => $user, 'titulo_relatorio' => $reportTitle, 'query' => $query],        
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
$filename = 'contratos';

// chama a função e abre o relatório no navegador
viewReport($output, $ext, $filename);

?>