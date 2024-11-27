<?php

session_start();
require_once '../../init.php';
require '../../check.php';

header('Content-Type: application/json');

// DB table to use
$table = 'materias_view';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. 

$columns = array(	

	array( 'db' => 'id',  'dt' => 'id' ),
	array( 'db' => 'materia', 'dt' => 'materia' ),
	array( 'db' => 'dataProducao',	'dt' => 'dataProducao',
		'formatter' => function( $d, $row ) {
			return date( 'd/m/Y', strtotime($d));
		}
	),
	array( 'db' => 'dataLimite',	'dt' => 'dataLimite',
		'formatter' => function( $d, $row ) {
			return date( 'd/m/Y', strtotime($d));
		}
	),
	array( 'db' => 'dataExpiracao',	'dt' => 'dataExpiracao',
		'formatter' => function( $d, $row ) {
			return date( 'd/m/Y', strtotime($d));
		}
	),
	array( 'db' => 'status',  'dt' => 'status' ),
	array( 'db' => 'pacote',  'dt' => 'pacote' ),
	array( 'db' => 'idContrato',  'dt' => 'idContrato' ) // coluna de filtro

);

$sql_details = array(
	'user' => DB_USER,
	'pass' => DB_PASS,
	'db'   => DB_NAME,
	'host' => DB_HOST
);

$query_string = $_SERVER['QUERY_STRING'];
parse_str($query_string, $query_string_array);

require( '../../classes/ssp.class.php' );
$where = "idContrato = '".htmlspecialchars($query_string_array['idContrato'], ENT_QUOTES)."'";

echo json_encode(
	SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $where ) // adicionando o COMPLEX e WHERE para especificar o contrato.
);

