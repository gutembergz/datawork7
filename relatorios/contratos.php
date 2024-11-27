<?php
session_start();
require '../init.php';  // configurar as variáveis de conexão
require '../check.php';
require '../vendor/autoload.php';
use PHPJasper\PHPJasper; 

$user = $_SESSION['user_name'] ? $_SESSION['user_name'] : null;
$subreport_dir = __DIR__ . "/arquivos/jasper";
$resources = __DIR__ . "/arquivos/jasper/resources";

$idCampanha = isset($_POST['idCampanha']) ? $_POST['idCampanha'] : null;
$idStatus = isset($_POST['idStatus']) ? $_POST['idStatus'] : null;
$idMateria = isset($_POST['idMateria']) ? $_POST['idMateria'] : null;
$idStatusMateria = isset($_POST['idStatusMateria']) ? $_POST['idStatusMateria'] : null;
$dataInicial = isset($_POST['dataInicial']) ? $_POST['dataInicial'] : null;
$dataFinal = isset($_POST['dataFinal']) ? $_POST['dataFinal'] : null;
$contratoInicial = isset($_POST['contratoInicial']) ? $_POST['contratoInicial'] : null;
$contratoFinal = isset($_POST['contratoFinal']) ? $_POST['contratoFinal'] : null;
$dataExpiracaoInicial = isset($_POST['dataExpiracaoInicial']) ? $_POST['dataExpiracaoInicial'] : null;
$dataExpiracaoFinal = isset($_POST['dataExpiracaoFinal']) ? $_POST['dataExpiracaoFinal'] : null;
$dataProducaoInicial = isset($_POST['dataProducaoInicial']) ? $_POST['dataProducaoInicial'] : null;
$dataProducaoFinal = isset($_POST['dataProducaoFinal']) ? $_POST['dataProducaoFinal'] : null;

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

if (isset($_POST['idMateria'])) {
    $materias = '';
    foreach ($_POST['idMateria'] as $value) {
        if ($materias!='') $materias.=', ';
        $materias.= $value;
        } 
} else {
    $materias = '';
    $tipo_materia = '';
}

if (isset($_POST['idStatusMateria'])) {
    $statusesMaterias = '';
    foreach ($_POST['idStatusMateria'] as $value) {
        if ($statusesMaterias!='') $statusesMaterias.=', ';
        $statusesMaterias.= $value;
        } 
} else {
    $statusesMaterias = '';
    $status_materia = '';
}

$filtroString = array('1=1'); // para não dar erro no WHERE vazio

if(!empty($dataInicial) && !empty($dataFinal)) {
    $filtroString[] = DB_NAME.".contratos.dataRegistro BETWEEN '".$dataInicial."' AND '".$dataFinal."'";
}

if(!empty($contratoInicial) && !empty($contratoFinal)) {
    $filtroString[] = DB_NAME.".contratos.nContrato BETWEEN ".$contratoInicial." AND ".$contratoFinal;
}

if(!empty($dataExpiracaoInicial) && !empty($dataExpiracaoFinal)) {
    $filtroString[] = DB_NAME.".contratos.dataExpiracao BETWEEN '".$dataExpiracaoInicial."' AND '".$dataExpiracaoFinal."'";
}

if(!empty($idCampanha)) {
    $filtroString[] = DB_NAME.".contratos.idCampanha IN (".$campanhas.")";
}

if(!empty($idStatus)) {
    $filtroString[] = DB_NAME.".contratos.idStatus IN (".$statuses.")";
}

if(!empty($dataProducaoInicial) && !empty($dataProducaoFinal)) {
    $filtroString[] = DB_NAME.".materiasContratadas.dataProducao BETWEEN '".$dataProducaoInicial."' AND '".$dataProducaoFinal."'";
    $producao_materia = "AND ".DB_NAME.".materiasContratadas.dataProducao BETWEEN '".$dataProducaoInicial."' AND '".$dataProducaoFinal."'";
} else {
    $producao_materia = ""; 
}

if(!empty($idMateria)) {
    $filtroString[] = DB_NAME.".materiasContratadas.idMateria IN (".$materias.")";
    $tipo_materia = "AND ".DB_NAME.".materiasContratadas.idMateria IN (".$materias.")";
}

if(!empty($idStatusMateria)) {
    $filtroString[] = DB_NAME.".materiasContratadas.idStatus IN (".$statusesMaterias.")";
    $status_materia = "AND ".DB_NAME.".materiasContratadas.idStatus IN (".$statusesMaterias.")";
}

$query = "WHERE ".implode(" AND ", $filtroString);

$input = __DIR__ . '/arquivos/jasper/contratos-materias_v3.jrxml';  
$output = __DIR__ . '/arquivos/pdf';  
$options = [
    'format' => ['pdf'],
    'locale' => 'pt_BR',
    'params' => [
        'nome_usuario' => $user, 
        'producao_materia' => $producao_materia,  
        'tipo_materia' => $tipo_materia, 
        'status_materia' => $status_materia, 
        'query' => $query,
        'subreport_dir' => $subreport_dir
    ], 
    'resources' => $resources, //place of resources               
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

//variáveis para abertura do relatório
$output = __DIR__ . '/arquivos/pdf';
$ext = 'pdf';
$filename = 'contratos-materias_v3';

// chama a função e abre o relatório no navegador
viewReport($output, $ext, $filename);

?>