<?php 
require_once __DIR__.'/../header.inc.php'; 
?>
	<div class="container">
		<div class="form-group">
			<form action="" method="post" role="form" style="max-width:300px">
				<legend>Nova Despesa</legend>

				<?php if(isset($flash['error'])) { ?>
					<p class="text-error"><?php echo $flash['error']; ?></p>
				<?php } ?>
				<?php if(isset($flash['message'])) { ?>
					<p class="text-success"><?php echo $flash['message']; ?></p>
				<?php } ?>

				
				<label for="Mes">Mes de referência: </label>
				<input type="text" name="mes" id="mes" class="form-control" placeholder="Mes de referência">
				<br>
				<label for="Ano de referência">Ano de referência: </label>
				<input type="text" name="ano" id="ano" class="form-control" placeholder="ano">
				<br>
				<label for="Vencimento">Vencimento: </label>
				<input type="text" name="vencimento" id="vencimento" class="form-control" placeholder="vencimento">
				<br>
				<label for="Valor">Valor: </label>
				<input type="text" name="valor" id="valor" class="form-control" placeholder="valor">
				<br>
				<label for="Descricao da Despesa">Descricao da Despesa: </label>
				<input type="text" name="descricao[]" id="descricao" class="form-control" placeholder="descricao">
				<br>

				<button type="submit" class="btn btn-primary">Salvar</button>

				<a href="<?php echo DIR_ASSETS.'despesas/home'; ?>" class="btn btn-primary">Voltar</a>	

			</form>
		</div>	
	</div>	
<?php 
require_once __DIR__.'/../footer.inc.php'; 
?>