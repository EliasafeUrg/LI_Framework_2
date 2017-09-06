<?php 

use Core\LI_Model;

class teste extends LI_Model{

	public function index(){
	
		$this->db->get("cliente");
		$this->db->do_where("ClienteId",1);



	}


}

?>