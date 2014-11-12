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
				input += '<input type="text" name="valorDespesa[]" id="valorDespesa" class="form-control" placeholder="valor">';
				input += '</li>';

				$('#despesas').append(input);

			});

			$('#despesas li #remove').on('click', function() {
				if(confirm('Tem certeza que deseja excluir esta despesa')) {
					var id = $(this).attr('data-id');
					$.get('/wsd/despesas/delete/single/'+id, function(){
						console.log('/despesas/delete/single/' +id);
					});
	        		$(this).parent().remove(); // Remove o item
	        	}	
    		});

		});
	</script>
	<div class="container">
		<div class="form-group">
			<form action="" method="post" role="form" style="max-width:300px">
				<legend>Editando Lançamento de Despesa do Condomínio</legend>

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

				<label for="Vencimento">Vencimento: </label>
				<input type="text" name="vencimento" id="vencimento" class="form-control" placeholder="vencimento" value="<?php echo $value->vencimento ?>">
				<br>
				<label for="Valor">Valor: </label>
				<input type="text" name="valor" id="valor" class="form-control" placeholder="valor" value="<?php echo $value->valorCondominio ?>">
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
							<br/>
							<label for="Valor da Despesa">Valor da Despesa: </label>
							<input type="text" name="valorDespesa[]" id="valorDespesa" class="form-control" placeholder="valor" value="<?php echo $d->valor ?>">
							<br>
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

				<br/>

				<br/>

				<button type="submit" class="btn btn-primary">Actualizar</button>

				<a href="<?php echo DIR_ASSETS.'despesas/home' ?>" class="btn btn-primary">Voltar</a>	

			</form>
		</div>	
	</div>	
</body>
</html>