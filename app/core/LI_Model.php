<?php 

	
	namespace app\core;
	use app\core\db;
	


	class LI_Model extends db{
	
		


		function __construct(){


			$this->db = new db;
			
		

		}


	}