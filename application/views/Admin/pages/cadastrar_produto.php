<div class="col-xs-9">
<h1 class="text-center"><ins>Cadastrar Produtos</ins>	</h1>
	<div class="col--xs-12" style="margin-top: 50px;">
	<form class="form-horizontal" method="post" action="<?php echo base_url("cadastrar/produto/"); ?>">

		<?php if($mensagem): ?>
		<div class="mensagem text-center  alert alert-info">
			<span><?php echo $mensagem;  ?></span>
		</div>
		<?php endif; ?>
			<div class="form-group">
			    
			    <label for="produto" class="col-xs-2 control-label">Produto</label>
			    <div class="col-xs-4">
			      <input type="text" name="produto" value="<?php echo set_value('produto'); ?>" class="form-control" id="produto" placeholder="Nome do Produto">
			    </div>


			     <label for="preco_venda" class="col-xs-2 control-label">Preço</label>
			    <div class="col-xs-4">
			      <input type="text" name="preco_venda" value="<?php echo set_value('preco_venda'); ?>" class="form-control" id="preco_venda" placeholder="Preço de Venda">
			    </div>
			</div>
			
			<div class="form-group">
			    
			    <label for="preco_custo" class="col-xs-2 control-label">Custo</label>
			    <div class="col-xs-4">
			      <input type="text" name="preco_custo" value="<?php echo set_value('preco_custo'); ?>" class="form-control" id="preco_custo" placeholder="Preço de Custo">
			    </div>


			     <label for="categoria" class="col-xs-2 control-label">Categoria</label>
			    <div class="col-xs-4">
			      <select multiple class="form-control" name="categoria">
			      <option selected="selected" value="">Selecione uma Categoria</option>
			      	<?php foreach ($categorias as $categoria): ?>
					  <option  value="<?php echo $categoria->id_categoria; ?> "><?php echo $categoria->categoria; ?></option>
					<?php endforeach; ?>
					</select>
			    </div>
			</div>
			
			<div class="form-group">
					<textarea class="form-control" name="descricao" rows="6" placeholder="Descrição do Produto"></textarea>
			</div>

			<div class="form-group">
			<input type="submit" name="cadastrar" value="Cadastrar Produto" class="btn  btn-primary pull-right">
			</div>

	</form>
	</div>
</div>