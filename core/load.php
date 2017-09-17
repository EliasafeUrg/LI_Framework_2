<?php 
	namespace Core;

	class load{


		// function __construct($nome_model){
		// 	require "app/model/{$nome_model}.php";
		// 	$this->model = new $nome_model;
		// }


		public function view($view, $dados = []){
			if(file_exists("app/views/{$view}.php")):
				if(is_array($dados) and $dados):
					extract($dados);
			
					require "app/views/{$view}.php";
				endif;
			else:
				echo "view não encotrada";
			endif;
		}


		public function model($nome_model){
			if(file_exists("app/model/{$nome_model}.php")):
				require "app/model/{$nome_model}.php";
				$this->$nome_model = new $nome_model;
			else:
				exit("Não foi encontrado nenhuma model com nome {$nome_model}");
			endif;
	
		}


	}