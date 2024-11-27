<p><h2>Planos de Figuração</h2></p>

<table id="tabelaPlanos" border="1" align="center" cellpadding="5" cellspacing="0">
	<tbody>
		<tr id="tabelaTituloPlanos">
			<th width="200" align="center" bgcolor="#5E005E" scope="col"><font color="#fff">Plano Light</font></th>
			<th width="200" align="center" bgcolor="#5E005E" scope="col"><font color="#fff">Plano Plus</font></th>
			<th width="200" align="center" bgcolor="#5E005E" scope="col"><font color="#fff">Plano Premium</font></th>
		</tr>
		<tr>
			<td width="200" align="center">Dados de Contato</td>
			<td width="200" align="center">Dados de Contato</td>
			<td width="200" align="center">Dados de Contato</td>
		</tr>
		<tr>
			<td width="200" align="center">Seleção de Categoria</td>
			<td width="200" align="center">Seleção de Categoria</td>
			<td width="200" align="center">Seleção de Categoria</td>
		</tr>
		<tr>
			<td width="200" align="center">Avaliações de Usuários</td>
			<td width="200" align="center">Avaliações de Usuários</td>
			<td width="200" align="center">Avaliações de Usuários</td>
		</tr>
		<tr>
			<td width="200" align="center">Logomarca</td>
			<td width="200" align="center">Logomarca</td>
			<td width="200" align="center">Logomarca</td>
		</tr>
		<tr>
			<td width="200" align="center">1 Palavra Chave</td>
			<td width="200" align="center">3 Palavras Chave</td>
			<td width="200" align="center">6 Palavras Chave</td>
		</tr>
		<tr>
			<td width="200" align="center">3 Produtos / Serviços</td>
			<td width="200" align="center">6 Produtos / Serviços</td>
			<td width="200" align="center">9 Produtos / Serviços</td>
		</tr>
		<tr>
			<td width="200" align="center">1 Foto</td>
			<td width="200" align="center">3 Fotos</td>
			<td width="200" align="center">6 Fotos</td>
		</tr>
		<tr>
			<td width="200" align="center">Produção de 1 Peça de Mídia <a href="https://portaldenegocios.com/images/hotlink-ok/apresentacao_banners/light.jpg" target="_blank">Amostra</a></td>
			<td width="200" align="center">Produção de 2 Peças de Mídia <a href="https://portaldenegocios.com/images/hotlink-ok/apresentacao_banners/plus.jpg" target="_blank">Amostra</a></td>
			<td width="200" align="center">Produção de 4 Peças de Mídia <a href="https://portaldenegocios.com/images/hotlink-ok/apresentacao_banners/premium.jpg" target="_blank">Amostra</a></td>
		</tr>
		<tr>			
			<td width="200" rowspan="7" align="center">&nbsp;</td>
			<td width="200" align="center">Apresentação da Empresa</td>
			<td width="200" align="center">Apresentação da Empresa</td>
		</tr>
		<tr>
			<td width="200" align="center">2 Anúncios Classificados</td>
			<td width="200" align="center">4 Anúncios Classificados</td>
		</tr>
		<tr>
			<td width="200" align="center">Redes Sociais</td>
			<td width="200" align="center">Redes Sociais</td>
		</tr>
		<tr>
			<td width="200" rowspan="4" align="center">&nbsp;</td>
			<td width="200" align="center">Destaque no Topo</td>
		</tr>
		<tr>
			<td width="200" align="center">Destaque em Coluna</td>
		</tr>
		<tr>
			<td width="200" align="center">Frase no Destaque</td>
		</tr>
		<tr>
			<td width="200" align="center">Publicação de Vídeo</td>
		</tr>
		<tr>
			

			<?php 
				
				function calculaParcelas ($valor, $desconto, $parcelas) {

					$valor = $valor; // valor original
					$desconto = $desconto; // percentual de desconto
					$percentual = $desconto / 100.0; // cálculo do desconto
					$valor_final = $valor - ($percentual * $valor); // cálculo do desconto 2
					$parcelas = $parcelas; 
					$valor_parcelas = $valor_final / $parcelas;

					echo "Valor de Tabela:<br>R$ " . $valor . ",00<br>";
					echo "<em>Valor com desconto de " . $desconto . "%:</em><br>";
					echo "<strong>R$ " . $valor_final . ",00 ou </strong><br>";
					echo "<strong>" . $parcelas . "x de R$ " . (round($valor_parcelas)) . ",00</strong><br>";
					echo "<hr>";
				}
				
				calculaParcelas(2000,40,6);
				calculaParcelas(3000,40,6);
				calculaParcelas(5000,40,6);
			?>

			<td width="200" align="center">
				<strong>ANUAL</strong><br>
				Valor de Tabela:<br>
				R$ 1.800,00<br>
				<em>Valor com desconto:</em><br>
				<strong>R$ 1.080,00</strong><br>
				<strong>Desconto de 40%</strong><br>
				<strong>6x R$ 180,00</strong><br>
			</td>

			<td width="200" align="center">
				<strong>ANUAL</strong><br>
				Valor de Tabela:<br>
				R$ 2.800,00<br>
				<em>Valor com desconto:</em><br>
				<strong>R$ 1.960,00</strong>
			</td>

			<td width="200" align="center">
				<strong>ANUAL</strong><br>
				Valor de Tabela:<br>
				R$ 4.550,00<br>
				<em>Valor com desconto:</em><br>
				<strong>R$ 2.990,00</strong>
			</td>
		</tr>

		<tr>
			<td width="200" align="center" >
				<strong>SEMESTRAL</strong><br>
				Valor de Tabela:<br>
				R$ 910,00<br>
				<em>Valor com Desconto:</em><br>
				<strong>R$ 590,00</strong><br>
			</td>
			
			<td width="200" align="center">
				<strong>SEMESTRAL</strong><br>
				Valor de Tabela:<br>
				R$ 1.749,00<br>
				<em>Valor com Desconto:</em><br>
				<strong>R$ 1.255,00</strong>
			</td>

			<td width="200" align="center">
				<strong>SEMESTRAL</strong><br>
				Valor de Tabela:<br>
				R$ 2.800,00<br>
				<em>Valor com Desconto:</em><br>
				<strong>R$ 1.960,00</strong>
			</td>
		</tr>		

		<tr>
			<td width="200" align="center" bgcolor="#5E005E">
				<a href="https://portaldenegocios.com/industrias/rj/cadastro-industrial/empresas/ebge-editora-brasileira-de-guias-especiais-plano-basico/" target="_blank"><font color="#fff">Amostra Plano Light</font></a>
			</td>
			<td width="200" align="center" bgcolor="#5E005E">
				<a href="https://portaldenegocios.com/industrias/rj/cadastro-industrial/empresas/ebge-editora-brasileira-de-guias-especiais-plano-plus/" target="_blank"><font color="#fff">Amostra Plano Plus</font></a>
			</td>
			<td width="200" align="center" bgcolor="#5E005E">
				<a href="https://portaldenegocios.com/industrias/rj/cadastro-industrial/empresas/ebge-editora-brasileira-de-guias-especiais-plano-premium/" target="_blank"><font color="#fff">Amostra Plano Premium</font></a>
			</td>
		</tr>
	</tbody>
</table>