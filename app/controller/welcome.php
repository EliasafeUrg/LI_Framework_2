<?php 

	/**
	* 
	*/

	use Core\LI_Controller;

	class welcome extends LI_Controller
	{
		
		public function index(){
			$this->load->model("teste");
			$this->load->teste->index();
		}
	}



	?>