			<div class="col-xs-9">
			<h1 class="text-center"><ins>Cadastrar Categoria</ins>	</h1>
				<div class="col--xs-12" style="margin-top: 50px;">
					<form class="form-horizontal" action="<?php echo base_url("Cadastrar/categoria/"); ?>" method="post">
					<div class="form-group">
					    
					    <label for="categoria" class="col-xs-2 control-label">Categoria</label>
					    <div class="col-xs-8">
					      <input type="text" name="categoria" class="form-control" id="categoria" placeholder="Categoria de Produtos">
					    </div>


					<div class="form-group">
						<input type="submit" name="cadastrar" value="Cadastrar Categoria" class="btn  btn-primary pull-right">
					</div>

					<?php if($mensagem): ?>
					<div class="mensagem text-center  alert alert-danger">
						<span><?php echo $mensagem;  ?></span>
					</div>
					<?php endif; ?>
					</form>
				</div>

				<div class="row">
					<table class="table table-hover table-bordered">
						<thead>
							<tr class="success">
								<td colspan="0" class="text-center"><h3 class=""><ins>CATEGORIAS</ins></h3></td>
							</tr>
						</thead>
						<?php foreach ($categorias as $categoria): ?>
						<tbody>
							<tr>
								<td class="text-center" colspan="2"><?php echo $categoria->categoria; ?></td>
							</tr>
						</tbody>
					<?php endforeach; ?>
					</table>
					<div class="pull-right">
						<?php echo $pagination; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

