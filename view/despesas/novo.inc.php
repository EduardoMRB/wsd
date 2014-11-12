<?php 
require_once __DIR__.'/../header.inc.php'; 
?>
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
					$.get('/wsd/despesas/delete/single/='+id, function(){
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
				<legend>Lançamento de Despesas Do Condomínio</legend>

				<?php if(isset($flash['error'])) { ?>
					<p class="text-error"><?php echo $flash['error']; ?></p>
				<?php } ?>
				<?php if(isset($flash['message'])) { ?>
					<p class="text-success"><?php echo $flash['message']; ?></p>
				<?php } ?>

				
				<label for="Vencimento">Vencimento: </label>
				<input type="text" name="vencimento" id="vencimento" class="form-control" placeholder="vencimento">
				<br>
				<label for="Valor">Valor: </label>
				<input type="text" name="valor" id="valor" class="form-control" placeholder="valor">
				<br>
				<ul id="despesas">
					<li>
						<label for="Descricao da Despesa">Descricao da Despesa: </label>
						<input type="text" name="descricao[]" id="descricao" class="form-control" placeholder="descricao"> 
						<br/>
						<label for="Valor da Despesa">Valor da Despesa: </label>
						<input type="text" name="valorDespesa[]" id="valorDespesa" class="form-control" placeholder="valor">
						<br>
					</li>
				</ul>

				<a id="add" href="" class"btn btn-primary">Adicionar Despesa</a>	

				<br/>

				<br/>

				<button type="submit" class="btn btn-primary">Salvar</button>

				<a href="<?php echo DIR_ASSETS.'despesas/home'; ?>" class="btn btn-primary">Voltar</a>	

			</form>
		</div>	
	</div>	
<?php 
require_once __DIR__.'/../footer.inc.php'; 
?>