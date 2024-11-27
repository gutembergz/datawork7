<?php
//session_start();
require_once '../../../init.php';
require '../../../check.php';

$PDO = db_connect();
$sql = "SELECT * FROM materias WHERE tabela = 2 ORDER BY id ASC";
$stmt = $PDO->prepare($sql);
$stmt->execute();				
	
?>		        

<table align="center">
	<tr>

		<?php while ($materias = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
			<td valign="top">

				<table id="tabelaPlanos" border="1" align="center" cellpadding="5" cellspacing="0">

					<tr>
						<th bgcolor="#5E005E"><h3><font style="font-family: 'Roboto', Arial, Sans-serif; font-size: 17px; color: #FFF;"><?php echo $materias['materia']?></font></h3></th>		
					</tr>

					<tr>
						<td align="center" valign="middle" width="190" height="130" style="font-family: 'Roboto', Arial, Sans-serif; font-size: 15px; color: #666666;">
							<?php 
							$featuresArray = preg_split ("/\|\|\|\|/", $materias['features']);
							foreach ($featuresArray as $features) :	?>
								<h4><span><?php echo $features; ?></span></h4> 
							<?php endforeach ?>
						</td>			
					</tr>

					<tr>
						<td align="center" valign="top" height="300" style="font-family: 'Roboto', Arial, Sans-serif; font-size: 15px; color: #666666;">
							<?php calculaParcelas("Período: Anual",$materias['valorAnual'],$materias['descontoAnual'],$materias['parcelasAnual']); ?>
							<?php calculaParcelas("Período: Semestral",$materias['valorSemestral'],$materias['descontoSemestral'],$materias['parcelasSemestral']); ?>
							<?php calculaParcelas("Período: Trimestral",$materias['valorTrimestral'],$materias['descontoTrimestral'],$materias['parcelasTrimestral']); ?>
						</td>			
					</tr>					

				</table>

			</td>

		<?php endwhile; ?>

	</tr>
</table>