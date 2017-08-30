<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Carrinho extends CI_Controller{

		function __construc(){

			parent::__construct();	
		}

		public function index(){
			if($this->session->userdata("logged_in") != true):
				redirect(base_url("login"));
			endif;
			$dados = [
				"page" => "carrinho",
				"title" => "HOME PAGE LOJA",
			];
			// var_dump($this->cart->contents());
			// foreach ($this->cart->contents() as $teste) {
			// 	var_dump($teste);
			// }
			$this->load->view("loja", $dados);
		}




		public function AdicionarCarrinho(){
			$prodId = $this->uri->segment(3);
			$nomeProd = $this->uri->segment(4);


			$this->load->model("Produtos_loja", "produto");
			$produto = $this->produto->lista_produtos($prodId);
			$this->load->library("cart");
			
			$data = array(
               'id'      => $produto->ProdutoId,
               'qty'     => 1,
               'price'   => $produto->PrecoVenda,
               'name'    => $produto->ProdNome,
               'options' => array('Size' => 'L', 'Color' => 'Red')
            );

			if($this->cart->insert($data)):
				redirect("carrinho/");
			endif;
		}
	
		public function excluirProduto($rowid){
			$data = array(
               'rowid' => $rowid,
               'qty'   => 0
            );
			if($this->cart->update($data)):
				redirect("carrinho/");
			endif; 
		}

	}



 ?>