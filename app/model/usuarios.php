<?php 



	use app\core\LI_Model;	
	class usuarios extends LI_Model{


		public function index(){

			// var_dump($this->connectDB());

			// var_dump($this->db);
			// $query = $this->db->get("cliente");
			// $this->db->where("email", "li_kill@hotmail.com");


			// if($query->num_rows() >= 1):
			// 	echo "Email já registrado";
			// else:
		

				$insert = [
					"login" => "likill",
					"email" => "li_kill3@hotmail.com",
					"senha" =>  1234,
					"PrimNome" => "Eliasafe",
					"UltNome" =>	"Duarte",
					"Endereco" => "",
					"Cidade" => null,
					"Cep" => null,
					"Telefone" => null
				];

				$this->db->insert("cliente", $insert);
				echo $this->db->insert_id();

	
			// endif;



			

		
				



		}


	}

 ?>