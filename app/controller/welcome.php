<?php 

	/**
	* 
	*/

	use Core\LI_Controller;

	class welcome extends LI_Controller
	{
		
		public function index(){
			$model = $this->load->model("teste");
			$model->teste->index();
			


			// var_dump($retorno->teste->index());
			// var_dump($retorno->usuarios);

			// $retorno->index();
		}
		
	}



 ?>