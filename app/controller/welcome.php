<?php 

	/**
	* 
	*/

	use app\core\LI_Controller;

	class welcome extends LI_Controller
	{
		
		public function index(){
			$retorno = $this->load->model("usuarios");

			$retorno->index();
		}

		public function valida($id){


		}
	}



 ?>