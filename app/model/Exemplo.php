<?php 

use Core\LI_Model;

class exemplo extends LI_Model{

	public function index(){
	
		// Deleta dado no banco de dados
		$this->db->where("ClienteId", 2);
		$this->db->delete("cliente");
		 
		
		// Inseri dados no banco de dados
		$insert = [
			"login" => "Geovana",
			"email" => "Geovana@hotmail.com",
			"senha" => "123",
			"PrimNome" => "Geovana",
			"UltNome" => "Ribeiro",
		];
		$this->db->insert("cliente", $insert);
		 
		 // Atuliza dados
		$update = [
			"login" => "likill2",
			"email" => "li_kill@hotmail.com",
			"senha" => "1234",
			"PrimNome" => "Eliasafe",
			"UltNome" => "Duarte de Pinnho",
		];
		$this->db->where("ClienteId", "44");
		$this->db->update("cliente", $update);
				
		// Consulta dados
		$this->db->order_by("PrimNome", "ASC");
		$query = $this->db->get("cliente");
		
		//  Conta o numero de linhas
		if($query->num_rows() > 0):
			return $query->result_obj();
		endif;
		




	}


}

?>