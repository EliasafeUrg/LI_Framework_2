<?php 



	use app\core\LI_Model;	
	class usuarios extends LI_Model{


		public function index(){
		
			$query = $this->db->get("cliente");
			$this->db->where("ClienteId", 1);

		
				var_dump($query->result_obj());


		
				



		}


	}

 ?>