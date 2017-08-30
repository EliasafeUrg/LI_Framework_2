
        <script>
     
        function enviarPagseguro(event){
         	 var idProduto = new Array();
         	 var quantidade = new Array();
 
			$("input[name='idProduto[]']").each(function(){
			     idProduto.push($(this).val());
			  });

			$("input[name='quantidade[]']").each(function(){
			     quantidade.push($(this).val());
			 });



    
    		// console.log(idProduto);
            $.post('<?php echo base_url('pedido/salvarPedido'); ?>', {
            idProduto: idProduto,
            quantidade: quantidade
            }, function(idPedido){
            	console.log(idPedido);
            	 $("#loading").css("visibility","visible");


		            $.post('<?php echo base_url('pagamento/index'); ?>', {idPedido: idPedido}, function(data){
		                $("#code").val(data);
		                $("#comprar").submit();

		                 $("#loading").css("visibility","hidden");

            		})
          
           		 })
       
      	  }
        </script>


<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
			  <!-- Default panel contents -->
			  <div class="panel-heading">Carrinho</div>
			 <?php foreach($this->cart->contents() as $carrinho): ?>
			  <div class="panel-body">
	
					<div class="col-xs-3">
						IMG
					</div>
					<div class="col-xs-2">
						<?php echo $carrinho['name']; ?>
					</div>
					<form id="produto">
						<div class="col-xs-2">
							$ <span class="preco"><?php echo $this->cart->format_number($carrinho['subtotal']); ?></span>
						</div>
						<div class="col-xs-2">
							<input type="number" id="quantidade" name="quantidade[]" value="<?php echo $carrinho['qty']; ?>" min="1" style="width: 40px;">	
							<input type="hidden" id="idproduto" name="idProduto[]" value="<?php echo $carrinho['id']; ?>">
							
						</div>
					</form>
					<div class="col-xs-2">
						<a href="<?php echo base_url("carrinho/excluirProduto/".$carrinho['rowid']) ?>">Exlcuir</a>
					</div>
		
				
			  </div>
			<?php endforeach; ?>
			
				<div class="col-xs-12">
					<div class="col-xs-3 pull-right">
						<div class="panel-body">
							Total de: 	$ <?php echo $this->cart->format_number($this->cart->total()); ?>
						</div>
					</div>
				</div>
				
		<form id="comprar" action="https://pagseguro.uol.com.br/v2/checkout/payment.html" method="post" onsubmit="PagSeguroLightbox(this); return false;">
		    <input type="hidden" name="code" id="code" value="" />
		</form>

				<div class="col-xs-12">
					<div class="col-xs-3 pull-right">
						<div class="panel-body">
							<input type="submit" id="pagar" value="Pagar com Segurança" class="btn btn-warning">
							<img src="<?php echo base_url("assets/img/loading.gif"); ?>" id="loading"  width="100" alt="" style="visibility: hidden;">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	// click handler
function onClick(event) {

}

// attach button click listener on dom ready
$(function() {
  $('#pagar').click(enviarPagseguro);
});
</script>
<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>

