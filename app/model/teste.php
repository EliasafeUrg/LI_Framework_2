<?php 

use Core\LI_Model;

class teste extends LI_Model{

	public function index(){
	
	$this->db->do_where("ClienteId",1);
	$query = $this->db->get("cliente");
	var_dump($query->result());

	$update = [
		"login" => "Jandira",
		"email" => "jandira@hotmail.com"
	];
	$this->db->do_where("ClienteId","1");
	$this->db->update("cliente",$update);



	}


}

?>