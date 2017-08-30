<?php 

	defined('BASEPATH') OR exit('No direct script access allowed');
	class Loja extends CI_Controller{

		function __construct(){

			
			parent::__construct();
		}

		public function index(){
			$dados = [
				"page" => "home",
				"title" => "HOME PAGE LOJA",
			];

			$this->load->model("Produtos_loja","produto");
			$dados['produtos'] = $this->produto->lista_produtos();

			// var_dump($_SESSION);
			$this->load->view("loja", $dados);


		}

	}


 ?>