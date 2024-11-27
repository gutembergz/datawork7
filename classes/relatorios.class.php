<?php 
class Relatorios {

	public function getTotalMaterias() {
		global $pdo;
		$array = array();

		$sql = $pdo->query("SELECT COUNT(*) AS contagem, materias.materia, materiasContratadas.id
        FROM materiasContratadas
        LEFT JOIN materias ON materiasContratadas.idMateria = materias.id 
        GROUP BY materias.materia 
        ORDER BY contagem DESC LIMIT 6");

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getMateriasMes() {
		global $pdo;
		$array = array();

		$sql = $pdo->query("SELECT CONCAT(SUBSTRING(DATE_FORMAT(`dataRegistro`, '%M'),1,3),DATE_FORMAT(`dataRegistro`,'/%Y')) as MONTH, COUNT(*) AS contagem
		FROM contratos
		WHERE PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(`dataRegistro`, '%Y%m'))<12
		GROUP BY YEAR(`dataRegistro`), MONTH(`dataRegistro`)");

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getContratosMes() {
		global $pdo;
		$array = array();

		$sql = $pdo->query("SELECT CONCAT(SUBSTRING(DATE_FORMAT(`dataRegistro`, '%M'),1,3),DATE_FORMAT(`dataRegistro`,'/%Y')) as MONTH, sum(valor) as vendasTotais
		FROM contratos
		WHERE PERIOD_DIFF(DATE_FORMAT(NOW(), '%Y%m'), DATE_FORMAT(`dataRegistro`, '%Y%m'))<12
		GROUP BY YEAR(`dataRegistro`), MONTH(`dataRegistro`)");

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}
	
}