<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Login_in extends CI_Model{

		public function verifica_login(){

			$this->db->from("cliente");
			$this->db->where("login", $this->input->post("login"));
			$this->db->where("senha", $this->input->post("senha"));

			$query = $this->db->get();

			if($query->num_rows() > 0):
				return $query->row();
			else:
				return false;
			endif;
		}


	}

 ?>