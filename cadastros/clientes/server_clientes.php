 <?php

session_start();
require_once '../../init.php';
require '../../check.php';

header('Content-Type: application/json');

// DB table to use
$table = 'clientes';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. 

$columns = array(	

	array( 'db' => 'id',  'dt' => 'id' ),
	array( 'db' => 'empresa', 'dt' => 'empresa' ),
	array( 'db' => 'razaoSocial',  'dt' => 'razaoSocial' ),
	array( 'db' => 'email',  'dt' => 'email' ),
	array( 'db' => 'autorizante',  'dt' => 'autorizante' ),
	array( 'db' => 'telefone',  'dt' => 'telefone' ),
	array( 'db' => 'celular',  'dt' => 'celular' ),
	array( 'db' => 'cpf',  'dt' => 'cpf' ),
	array( 'db' => 'cnpj',  'dt' => 'cnpj' ),
	array( 'db' => 'dataRegistro',	'dt' => 'dataRegistro',
		'formatter' => function( $d, $row ) {
			return date( 'd/m/Y', strtotime($d));
		}
	),
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

