<?php 

defined('BASEPATH') OR exit('No direct script access allowed');



	class Login extends CI_Controller{
		function __construct(){
			
	
			parent::__construct();
		}

		public function index(){
			if($this->session->userdata("logged_in")):
				redirect(base_url("loja/"));
			endif;
			$dados = [
				"page" => "autenticacao/login",
				"title" => "HOME PAGE LOJA",
			];
			
			$this->load->view("loja",$dados);
		}

		public function login_in(){

			$this->load->model("Login_in");
			if($usuario = $this->Login_in->verifica_login()):

				$sessao_usuario = array(
				   'clienteId' => $usuario->ClienteId,
                   'username'  => $usuario->PrimNome." ".$usuario->UltNome,
                   'email'     => $usuario->email,
                   'logged_in' => TRUE
               );

				$this->session->set_userdata($sessao_usuario);

				if($this->session->userdata("__ci_last_regenerate")):
					redirect(base_url("loja/"));
				endif;


				else:
					echo "Falha no login";
			endif;
		}

		public function logout(){

			$this->session->sess_destroy();
				
			if(!$this->session->userdata("logged_in")):
				redirect(base_url("loja/"));

			endif;

				redirect(base_url("loja/"));
		}


	}