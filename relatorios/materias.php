<?php
session_start();
require '../init.php';  // configurar as variáveis de conexão
require '../vendor/autoload.php';
use PHPJasper\PHPJasper; 

$user = $_SESSION['user_name'];
$reportTitle = "Relatório de Matérias";
$idMateria = isset($_POST['idMateria']) ? $_POST['idMateria'] : null;
$idStatusMateria = isset($_POST['idStatusMateria']) ? $_POST['idStatusMateria'] : null;
// $dataInicial = isset($_POST['dataInicial']) ? $_POST['dataInicial'] : null;
// $dataFinal = isset($_POST['dataFinal']) ? $_POST['dataFinal'] : null;
// $contratoInicial = isset($_POST['contratoInicial']) ? $_POST['contratoInicial'] : null;
// $contratoFinal = isset($_POST['contratoFinal']) ? $_POST['contratoFinal'] : null;

if (isset($_POST['idMateria'])) {
    $materias = '';
    foreach ($_POST['idMateria'] as $value) {
        if ($materias!='') $materias.=', ';
        $materias.= $value;
        } 
} else {
    $materias = '';
}

if (isset($_POST['idStatusMateria'])) {
    $statuses = '';
    foreach ($_POST['idStatusMateria'] as $value) {
        if ($statuses!='') $statuses.=', ';
        $statuses.= $value;
        } 
} else {
    $statuses = '';
}

$filtroString = array('1=1'); // para não dar erro no WHERE vazio

if(!empty($idMateria)) {
    $filtroString[] = DB_NAME.".materiasContratadas.idMateria IN (".$materias.")";
}

if(!empty($idStatusMateria)) {
    $filtroString[] = DB_NAME.".materiasContratadas.idStatus IN (".$statuses.")";
}

// if(!empty($dataInicial) && !empty($dataFinal)) {
//     $filtroString[] = DB_NAME.".contratos.dataRegistro BETWEEN '".$dataInicial."' AND '".$dataFinal."'";
// }

// if(!empty($contratoInicial) && !empty($contratoFinal)) {
//     $filtroString[] = DB_NAME.".contratos.nContrato BETWEEN ".$contratoInicial." AND ".$contratoFinal;
// }

$query = "WHERE ".implode(" AND ", $filtroString);

$input = __DIR__ . '/arquivos/jasper/materias.jrxml';  
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

// $jasper->process(
//     $input,
//     $output,
//     $options
// )->execute();

print $jasper->process(
    $input,
    $output,
    $options
)->output();

//variáveis para abertura do relatório
$output = __DIR__ . '/arquivos/pdf';
$ext = 'pdf';
$filename = 'materias';

// chama a função e abre o relatório no navegador
//viewReport($output, $ext, $filename);

?>