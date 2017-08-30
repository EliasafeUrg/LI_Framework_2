<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
			  <!-- Default panel contents -->
			  <?php if($pedidos): ?>
			  <?php foreach ($pedidos as $pedido_cliente): ?>
			  <div class="panel-heading"><?php echo $pedido_cliente->ProdNome; ?></div>
				
				
			  <div class="panel-body">
				<table class="table table-bordered table-hover">
					<thead>
						<tr cl>
							<td class="text-center"><strong>Data da Compra:</strong></td>
							<td class="text-center"><strong>Data Prevista Para Entrega:</strong></td>
							<td class="text-center"><strong>Preço:</strong></td>
							<td class="text-center"><strong>Quantidade:</strong></td>
							<td class="text-center"><strong>Frete</strong></td>
							<td class="text-center"><strong>Status do Pedido</strong></td>
						</tr>
					</thead>
					<tbody>
						<tr class="active">
							<td class="text-center"><?php echo $pedido_cliente->DataCompra; ?></td>
							<td class="text-center"><?php echo $pedido_cliente->DataEntrega; ?></td>
							<td class="text-center">R$: <?php echo $this->cart->format_number($pedido_cliente->PrecoVenda); ?></td>
							<td class="text-center"><?php echo $pedido_cliente->Quantidade; ?></td>
							<td class="text-center"><?php echo $pedido_cliente->Frete; ?></td>
							<td class="text-center alert 

								<?php 
									switch ($pedido_cliente->Status) {
									    case 1:
									        echo "alert-danger";
									        break;
									    case 2:
									        echo "alert-warning";
									        break;
									    case 3:
									        echo "alert-success";
									        break;
									    default:
									        echo "alert-info";
									    	break;
									}
								 ?>

							"><strong><?php
									switch ($pedido_cliente->Status) {
									    case 1:
									        echo "Aguardando pagamento";
									        break;
									    case 2:
									        echo "Em análise";
									        break;
									    case 3:
									        echo "Paga";
									        break;
									    case 4:
									        echo "Disponível";
									        break;
									    case 5:
									        echo "Em disputa";
									        break;
									    case 6:
									        echo "Devolvida";
									    case 7:
									        echo "Cancelada";
									    case 8:
									        echo "Debitado";
									    case 9:
									        echo "Retenção temporária";
									    break;
									}
							 	?></strong>						 	
							 </td>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
				<?php endforeach; ?>
			<?php else: ?>
				<div class="panel-heading"><h3 class="text-center">Não há pedidos</h3></div>
			<?php endif; ?>
		</div>
	</div>
</div>

<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>

