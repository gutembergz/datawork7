<?php
// configurações para as conexões POO 

global $pdo;

try {
	$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=UTF8', DB_USER, DB_PASS,
	array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET lc_time_names="pt_BR"'));

} catch (pdoException $e) {
	echo "Houve um erro na conexão: ".$e->getMessage();
	exit;	
}
?>