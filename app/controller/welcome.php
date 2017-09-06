<?php 

	/**
	* 
	*/

	use Core\LI_Controller;

	class welcome extends LI_Controller
	{
		
		public function index(){
			function teste(){

			}

			$number = array(1,2,3,4,5,6);

			$filter_numbers = array_map( "teste", $number);	

		
			var_dump($filter_numbers);
			// function filter_number($data){

			// }
		}
	}



	?>