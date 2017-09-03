<?php 


	namespace Core;
	


	class load implements interfaces\inter_load{


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
				$nome_model = $nome_model;
				$obj_model = new $nome_model;
				$obj_model->$nome_model = new $obj_model;

				return $obj_model;
		

				
			else:
					echo "model não encontrada";
			endif;
		}

	}