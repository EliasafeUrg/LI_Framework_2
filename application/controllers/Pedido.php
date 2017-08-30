<?php 

	defined('BASEPATH') OR exit('No direct script access allowed');
	class Pedido extends CI_Controller{

		function __construct(){

			
			parent::__construct();
		}

		public function salvarPedido(){
			$reference = rand(1,10000000).$this->session->userdata('clienteId');
			echo $reference.'-'.$this->session->userdata('clienteId');

		}

		public function meus_pedidos(){
	
			if($this->session->userdata("logged_in") != true):
				redirect(base_url("login"));
			endif;

			$this->load->model("Model_Pedido");

			$dados = [
				"page" => "meus_pedidos",
				"title" => "PEDIDOS",
				'pedidos' => $this->Model_Pedido->meus_pedidos(),
			];

			// var_dump($dados['pedidos']);

			$this->load->view("loja", $dados);


		}

	}


 ?>