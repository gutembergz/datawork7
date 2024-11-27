<?php
session_start();
require_once '../../../init.php';
require '../../../check.php';
$pageTitle = 'Gerador de Templates para Outlook';

$PDO = db_connect();
$sql = "SELECT * FROM clientes ORDER BY empresa ASC";
$stmt = $PDO->prepare($sql);
$stmt->execute();

include (HEADER_TEMPLATE);

?>

<script type="text/javascript">
	tinymce.init({
		selector: '#mensagem',
		language: 'pt_BR',
		branding: false
	});
</script>

<div class="container-fluid">

	<form action="template.php" method="post">
		<div class="form-group">

			<label for="selCliente">Cliente</label>
			<select class="form-control" name="selCliente">
				<option value="">Selecionar Cliente</option>
				<?php while ($email = $stmt->fetch(PDO::FETCH_ASSOC)): ?>

				<option value="<?php echo $email['id'] ?>"><?php echo $email['empresa'] ?></option>

				<?php endwhile; ?>

			</select>

		</div>

		<div class="form-group">
		
			<label for="tipoEmail">Tipo de E-mail</label>

			<select class="form-control" name="tipoEmail">
				<option value="">Selecionar Tipo de E-mail</option>
				<option value="registro">Registre-se no Portal de Negócios</option>
				<option value="classificados">Bem Vindo aos Classificados</option>
				<option value="rede">Bem Vindo à Rede de Negócios</option>
				<option value="grupo-vip">Faça Parte do Grupo VIP do Portal de Negócios</option>
				<option value="aumente-possibilidades">Aumente Suas Possibilidades de Venda</option>
				<option value="redes-sociais">Deixe sua Empresa mais Visível</option>
				<option disabled>──────────</option>
				<option value="apresentacao">Apresentação do Portal de Negócios</option>
				<option value="proposta">Proposta Comercial</option>
				<option value="proposta2">Proposta Comercial 2</option>
				<option value="proposta-redes-sociais">Proposta Comercial com Redes Sociais</option>			
				<option value="visita">Confirmação de Visita</option>
				<option value="coronavirus">Campanha Coronavírus</option>
				<option disabled>──────────</option>
				<option value="contato">E-mail de Contato</option>
			</select>
		
		</div>
			
		<div class="form-group">	
			<label for="mensagem">Mensagem</label>
			<textarea class="form-control" rows="12" cols="50" name="mensagem" id="mensagem"></textarea>
					
			<div class="form-row">

			 	<div class="col">
					Data <input class="form-control" type="date" name="dataagenda">
			 	</div>	

				<div class="col">
					Horário <input class="form-control" type="time" name="horario">
				</div>

				<div class="col">
					Representante <input class="form-control" type="text" name="representante" placeholder="Nome da Representante">
				</div>

			</div>

			<div class="form-row">
				<div class="col">
				Local <input class="form-control" type="text" name="local">
				</div>
			</div>

		</div>

		<button class="btn btn-primary" type="submit" value="Submit">Gerar Template</button>

	<form>
		  
</div>

<?php include (FOOTER_TEMPLATE);?>