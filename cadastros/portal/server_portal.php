<?php

session_start();
require_once '../../init.php';
require '../../check.php';

header('Content-Type: application/json');

// DB table to use
$table = 'portal_view';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. 

$columns = array(	

	array( 'db' => 'id',  'dt' => 'id' ),
	array( 'db' => 'nContrato', 'dt' => 'nContrato' ),
	array( 'db' => 'empresa',  'dt' => 'empresa' ),
	array( 'db' => 'dataRegistro',	'dt' => 'dataRegistro',
		'formatter' => function( $d, $row ) {
			return date( 'd/m/Y', strtotime($d));
		}
	),
	array( 'db' => 'dataExpiracao',	'dt' => 'dataExpiracao',
		'formatter' => function( $d, $row ) {
			return date( 'd/m/Y', strtotime($d));
		}
	),
	array( 'db' => 'nomeUsuario',  'dt' => 'nomeUsuario' ),
	array( 'db' => 'status',  'dt' => 'status' )	
);

$sql_details = array(
	'user' => DB_USER,
	'pass' => DB_PASS,
	'db'   => DB_NAME,
	'host' => DB_HOST
);

require( '../../classes/ssp.class.php' );

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);

