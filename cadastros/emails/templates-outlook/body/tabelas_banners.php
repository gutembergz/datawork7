<?php
//session_start();
require_once '../../../init.php';
require '../../../check.php';

$PDO = db_connect();
$sql = "SELECT * FROM materias WHERE tabela = 3 ORDER BY id ASC";
$stmt = $PDO->prepare($sql);
$stmt->execute();				
	
?>		        

<table align="center">
	<tr>
		<?php $n = 0; ?>
		<?php while ($materias = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
			<td valign="top">

				<table id="tabelaPlanos" width="190" border="1" align="center" cellpadding="5" cellspacing="0">
					<?php $n++; // incrementa mais um a cada loop ?>
					<tr>
						<th bgcolor="#5E005E"><h3><font style="font-family: 'Roboto', Arial, Sans-serif; font-size: 17px; color: #FFF;"><?php echo $materias['materia']?></font></h3></th>		
					</tr>

					<tr>
						<td align="center" valign="top" width="190" height="90" style="font-family: 'Roboto', Arial, Sans-serif; font-size: 15px; color: #666666;">
							<?php 
							$featuresArray = preg_split ("/\|\|\|\|/", $materias['features']);
							foreach ($featuresArray as $features) :	?>
								<h4><span><?php echo $features; ?></span></h4> 
							<?php endforeach ?>
						</td>			
					</tr>

					<tr>
						<td align="center" valign="top" height="90" style="font-family: 'Roboto', Arial, Sans-serif; font-size: 15px; color: #666666;">
							<?php calculaParcelas("Período: Mensal",$materias['valorMensal'],$materias['descontoMensal'],$materias['parcelasMensal']); ?>							
						</td>			
					</tr>

					<tr>
						<td align="center" style="font-family: 'Roboto', Arial, Sans-serif; font-size: 15px; color: #666666;">
							<a href="<?php echo $materias['amostra']?>" target="_blank">Amostra <?php echo $materias['materia']?></a>
						</td>			
					</tr>

				</table>

				<?php 
				if ($n ==3) { // se o loop chegar a 3, exibe uma row para quebrar a tabela
					echo "<tr></tr>";
				} ?>

			</td>

		<?php endwhile; ?>

	</tr>
</table>

