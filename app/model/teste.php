<?php 

use Core\LI_Model;

class teste extends LI_Model{

	public function index(){
	
		
		
		$this->db->where("senha", 1234);
		$this->db->or_where("ClienteId", 1);
		$this->db->order_by("PrimNome", "ASC");
		$query = $this->db->get("cliente");

		var_dump($query->result());




	}


}

?>