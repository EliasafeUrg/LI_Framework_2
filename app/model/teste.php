<?php 

use Core\LI_Model;

class teste extends LI_Model{

	public function index(){
		
		$update = [
			"login" => "bb",
			"email" => "cc"
		];
		$this->db->do_where("ClienteId", "1");
		// $this->db->do_where("email", "1");
		// $this->db->do_where("email", "Teste");

		$this->db->update("cliente", $update);


	}


}

?>