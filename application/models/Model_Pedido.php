<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Model_Pedido extends CI_Model{

			public function meus_pedidos(){

		
			$this->db->from("pedido");

			$this->db->where("cliente_ClienteId", $this->session->userdata('clienteId'));
			$this->db->join('pedido_has_produto', 'pedido_has_produto.pedido_PedidoId = pedido.PedidoId');
			$this->db->join('produto', 'produto.ProdutoId = pedido_has_produto.produto_ProdutoId');
			// $this->db->distinct("PedidoId");
			$query = $this->db->get();

				if($query->num_rows() > 0):
					
					return $query->result();
				else:
					return false;
				endif;
	
			}


		// Registra o pedido do cliente
		public function pedir($id_cliente,$status=null,$reference){

			 $anoMes = date("y-m-");

			 $frete = date("d") + 7;

			 $entrega =  $anoMes.$frete;

			$data = [
				"PedidoId" => $reference,
				"DataCompra" => date("y-m-d"),
				"DataEntrega" => $entrega,
				"Frete" => "Grátis",
				"cliente_ClienteId" => $id_cliente,
				"status" => $status,
			];
			$this->db->insert("pedido", $data);

		
			return $this->db->insert_id();

				

		}

		public function compra_tem_produto($idProduto,$quantidade, $idpedido){

		
			$i = 0;
			while($i < count($idProduto)){

			$compra_produto = [
					"pedido_PedidoId" => $idpedido,
					"quantidade" => $quantidade[$i],
					"produto_ProdutoId" => $idProduto[$i],
			];
			$this->db->insert("pedido_has_produto", $compra_produto);
			$i++;
			}

			$idpedido = $idpedido+1;
			return $idpedido.'-'.$this->session->userdata('clienteId');


		}

		// Altera status do pedido
		public function alteraStatusPedido($status,$reference){
			$data = [
				"status" => $status,
			];
			$this->db->where('PedidoId', $reference);
			if(	$this->db->update('pedido', $data)):
				return true;
			else:
				return false;
			endif;
		
		}

		public function delete_pedido($idPedido){
			$this->db->where("PedidoId",$idPedido);
			$this->db->delete("pedido");

			$this->db->where("PedidoId",$idPedido);
			$this->db->delete("pedido_has_produto");
		}



	}

 ?>