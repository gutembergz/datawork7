<?php

session_start();
require_once '../../../init.php';
require '../../../check.php';

header('Content-Type: application/json');

// DB table to use
$table = 'materiasContratadas_googleAdsChamadas';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. 

$columns = array(	

	array( 'db' => 'id',  'dt' => 'id' ),
	array( 'db' => 'urlFinalChamada',  'dt' => 'urlFinalChamada' ),
	array( 'db' => 'urlVisualizacaoChamada', 'dt' => 'urlVisualizacaoChamada' ),
	array( 'db' => 'titulo1Chamada', 'dt' => 'titulo1Chamada' ),
	array( 'db' => 'titulo2Chamada', 'dt' => 'titulo2Chamada' ),	
	array( 'db' => 'descricao1Chamada', 'dt' => 'descricao1Chamada' ),
	array( 'db' => 'descricao2Chamada', 'dt' => 'descricao2Chamada' ),
	array( 'db' => 'contaTitulosChamada', 'dt' => 'contaTitulosChamada' ),		
	array( 'db' => 'numeroTel', 'dt' => 'numeroTel' ),
	array( 'db' => 'nomeEmpresa', 'dt' => 'nomeEmpresa' ),
	array( 'db' => 'idMateriaContratada',  'dt' => 'idMateriaContratada' ) // coluna de filtro
);

$sql_details = array(
	'user' => DB_USER,
	'pass' => DB_PASS,
	'db'   => DB_NAME,
	'host' => DB_HOST
);

$query_string = $_SERVER['QUERY_STRING'];
parse_str($query_string, $query_string_array);

require( '../../../classes/ssp.class.php' );
$where = "idMateriaContratada = '".htmlspecialchars($query_string_array['idMateriaContratada'], ENT_QUOTES)."'";

echo json_encode(
	SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $where ) // adicionando o COMPLEX e WHERE para especificar o contrato.
);

