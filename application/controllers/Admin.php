<?php 

	defined('BASEPATH') OR exit('No direct script access allowed');
	class Admin extends CI_Controller{

		function __construct(){

			
			parent::__construct();
		}

		public function index(){
			$dados = [
				"page" => "index",
				"title" => "HOME PAGE LOJA",
			];

			$this->load->model("Produtos_loja","produto");
			$dados['produtos'] = $this->produto->lista_produtos();

			// var_dump($_SESSION);
			$this->load->view("Admin/Admin", $dados);


		}

	}


 ?>