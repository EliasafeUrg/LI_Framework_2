<?php 

	/**
	*  Class de Exemplo Controller
	*/

	use Core\LI_Controller;

	class welcome extends LI_Controller
	{
		
		public function index(){
			
			$this->load->model("exemplo");
			// $dados["usuario"] = $this->load->exemplo->index();

			$this->load->view("welcome");

		}
	}



	?>