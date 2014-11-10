<?php 
ini_set('display_errors', 1);
require_once __DIR__.'/../header.inc.php'; ?>



	<div class="container">
		<div class="form-group">
			<form action="" method="post" role="form" style="max-width:300px">
				<legend>Editar dados do morador</legend>

				<?php if(isset($flash['error'])) { ?>
					<p class="text-error"><?php echo $flash['error']; ?></p>
				<?php } ?>
				<?php if(isset($flash['message'])) { ?>
					<p class="text-success"><?php echo $flash['message']; ?></p>
				<?php } ?>	

				<?php foreach ($apartamentos as $key => $value) { ?>

				<label for="Nome do morador">Nome do morador: </label>
				<input type="text" name="morador" id="morador" class="form-control" placeholder="Nome do morador" value="<?php echo $value->morador ?>">
				<br>
				<label for="Numero do apartamento">Número do apartamento: </label>
				<input type="text" name="numero" id="numero" class="form-control" placeholder="numero" value="<?php echo $value->numero ?>">
				<br>
				<label for="Saldo">saldo: </label>
				<input type="text" name="saldo" id="saldo" class="form-control" placeholder="saldo" value="<?php echo $value->saldo ?>">
				<br>
				<label for="Meses Devedores">Meses Devedores: </label>
				<input type="text" name="meses" id="meses" class="form-control" placeholder="meses" value="<?php echo $value->meses_devedores ?>">
				<br>
				
				<?php } ?>

				<button type="submit" class="btn btn-primary">Actualizar</button>

				<a href="<?php echo DIR_ASSETS ?>" class="btn btn-primary">Voltar</a>	

			</form>
		</div>	
	</div>	
</body>
</html>