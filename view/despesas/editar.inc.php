<?php 
ini_set('display_errors', 1);
require_once __DIR__.'/../header.inc.php'; ?>
	
	<script>
		$(document).ready(function(){
			$('#add').on('click', function(e){

				e.preventDefault();

				var input = '<li><label for="Descricao da Despesa">Descricao da Despesa: </label>';
				input += '<input type="text" name="descricao[]" id="valor" class="form-control" placeholder="descricao">';
				input += '<input type="hidden" name="idDespesa[]" id="idDespesa" class="form-control">';
				input += '</li>';

				$('#despesas').append(input);

			});

			$('#despesas li #remove').on('click', function() {
				if(confirm('Tem certeza que deseja excluir esta despesa')) {
					var id = $(this).attr('data-id');
					$.get('/sistema/controller/ajax.php?action=1&id='+id, function(){
						console.log('removido com sucesso');
					});
	        		$(this).parent().remove(); // Remove o item
	        	}	
    		});

		});
	</script>
	<div class="container">
		<div class="form-group">
			<form action="" method="post" role="form" style="max-width:300px">
				<legend>Editar Despesa</legend>

				<?php if(isset($flash['error'])) { ?>
					<p class="text-error"><?php echo $flash['error']; ?></p>
				<?php } ?>
				<?php if(isset($flash['message'])) { ?>
					<p class="text-success"><?php echo $flash['message']; ?></p>
				<?php } ?>	

				<?php 
					if($despesas != null) {
					foreach ($despesas as $key => $value) { 
				?>

				<label for="Mes">Mes de referência: </label>
				<input type="text" name="mes" id="mes" class="form-control" placeholder="Mes de referência" value="<?php echo $value->mes ?>">
				<br>
				<label for="Ano de referência">Ano de referência: </label>
				<input type="text" name="ano" id="ano" class="form-control" placeholder="ano" value="<?php echo $value->ano ?>">
				<br>
				<label for="Vencimento">Vencimento: </label>
				<input type="text" name="vencimento" id="vencimento" class="form-control" placeholder="vencimento" value="<?php echo $value->vencimento ?>">
				<br>
				<label for="Valor">Valor: </label>
				<input type="text" name="valor" id="valor" class="form-control" placeholder="valor" value="<?php echo $value->valor ?>">
				<br>
				<?php } // end foreach 1 ?>
				<?php } // end if 1 ?>
				<ul id="despesas">
					<?php 
						if($allDespesas != null) {
							$i = 0;
							foreach($allDespesas as $d) { 
					?>							
						<li>
							<label for="Descricao da Despesa">Descricao da Despesa: </label>
							<input type="text" name="descricao[]" id="descricao" class="form-control" placeholder="descricao" value="<?php echo $d->descricao ?>">
							<input type="hidden" name="idDespesa[]" id="idDespesa" class="form-control" value="<?php echo $d->idDespesa ?>">	
							<span id="remove" data-id="<?php echo $d->idDespesa;?>">Excluir</span>
						</li>
						<?php 
							$i++; 
							} // end foreach 2
						} // end if 2
						?>
				</ul>

				<a id="add" href="" class"btn btn-primary">Adicionar Despesa</a>	

				<br>

				<button type="submit" class="btn btn-primary">Actualizar</button>

				<a href="<?php echo DIR_ASSETS.'despesas/home' ?>" class="btn btn-primary">Voltar</a>	

			</form>
		</div>	
	</div>	
</body>
</html>