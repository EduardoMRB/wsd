<?php 
require_once __DIR__.'/../header.inc.php'; 
?>
	<div class="container">
		<div class="form-group">
			<form action="" method="post" role="form" style="max-width:300px">
				<legend>Novo Morador</legend>

				<?php if(isset($flash['error'])) { ?>
					<p class="text-error"><?php echo $flash['error']; ?></p>
				<?php } ?>
				<?php if(isset($flash['message'])) { ?>
					<p class="text-success"><?php echo $flash['message']; ?></p>
				<?php } ?>

				
				<label for="Nome do morador">Nome do morador: </label>
				<input type="text" name="morador" id="morador" class="form-control" placeholder="Nome do morador">
				<br>
				<label for="Numero do apartamento">Número do apartamento: </label>
				<input type="text" name="numero" id="numero" class="form-control" placeholder="numero">
				<br>
				<label for="Saldo">saldo: </label>
				<input type="text" name="saldo" id="saldo" class="form-control" placeholder="saldo">
				<br>
				<label for="Meses Devedores">Meses Devedores: </label>
				<input type="text" name="meses" id="meses" class="form-control" placeholder="meses">
				<br>

				<button type="submit" class="btn btn-primary">Guardar</button>

				<a href="<?php echo DIR_ASSETS; ?>" class="btn btn-primary">Voltar</a>	

			</form>
		</div>	
	</div>	
<?php 
require_once __DIR__.'/../footer.inc.php'; 
?>