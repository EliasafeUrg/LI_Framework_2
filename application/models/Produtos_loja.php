<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Produtos_loja extends CI_Model{

		private $table = 'produto';
		// Lista produtos das loja
		public function lista_produtos($id_produto = null){

			
			if($id_produto !=  null):
				// Lista produto especifíco
			$this->db->from("produto");
			$this->db->where("ProdutoId", $id_produto);

			$query = $this->db->get();

				if($query->num_rows() > 0):
					return $query->row();
				else:
					return false;
				endif;

			else:

			$this->db->from("produto");
			$query = $this->db->get();

				if($query->num_rows() > 0):
					return $query->result();
				else:
					return false;
				endif;
			endif;

		}

		public function cadastrar_produto(){

				$produto = [
							'ProdNome' => $this->input->post('produto'),
							'Descricao' =>  $this->input->post('Descricao'),
							'PrecoVenda' => $this->input->post('preco_venda'),
							'PrecoCusto' =>  $this->input->post('preco_custo'),
							'Descricao' =>  $this->input->post('descricao'),
							'categoria_produtos_id_categoria' => $this->input->post('categoria'),
				];


				if($this->db->insert($this->table, $produto)):

					return true;;
				else:
					return false;
				endif;

		}




	}

 ?>