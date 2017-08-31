<?php 


	namespace app\core;
	
	use app\core\interfaces\inter_load;
	

	class load implements inter_load{

		

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
		public function model($model){
			

			$this->nome_model = "a";

			if(file_exists("app/model/{$model}.php")):
				require "app/model/{$model}.php";
				
				return $model = new $model;

				
				else:
					echo "model não encontrada";
			endif;
		}

		public function teste($id){
			echo "oi";
		}

	}