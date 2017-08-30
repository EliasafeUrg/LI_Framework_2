<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Model_Categoria extends CI_Model{
			private $table = 'categoria_produtos';

			public function cadastrar(){

				if($this->db->insert($this->table, array("categoria" => $this->input->post('categoria')))):

					return true;;
				else:
					return false;
				endif;
			}

			public function listar_categoria($quantidade=0, $inicio = 0){
				
				if($quantidade > 0) $this->db->limit($quantidade, $inicio);
				$this->db->order_by("id_categoria","DESC");
				
				$query = $this->db->get($this->table);

				if($query->num_rows() > 0):
					return $query->result();
				else:
					return false;
				endif;
			}

	}
