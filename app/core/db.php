<?php 


	namespace app\core;
	use \PDO;
	class db{
		
		protected $db;
		protected $query;
		protected $stmt;
		protected $table;
		protected $banco;

		function __construct(){
	
			$this->db = new PDO('mysql:host=localhost;dbname=loja', "root", "");
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		}

		

		public function connectaDB(){

		}

		public function get($table){
			$this->banco = new db;
			$this->banco->table = $table;
			$this->banco->query = "SELECT * FROM {$this->banco->table}";
		
			return $this->banco;
				
		}

		public function where($campo, $id){
			
			$this->banco->query = "SELECT * FROM {$this->banco->table} WHERE {$campo} = {$id}";
			// var_dump($this->banco->query);

		}

	
		public function num_rows(){
			$stmt = $this->prepareQuery($this->query);
			return $stmt->rowCount();
		}


		public function result_array(){
			
			$stmt = $this->prepareQuery($this->query);
				
			// return $stmt->fetch(PDO::FETCH_ASSOC);

			 return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function result_obj(){
			$stmt = $this->prepareQuery($this->query);
			
			 return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function prepareQuery(){

				$stmt = $this->db->prepare($this->query);

				if($this->execQuery($stmt)):
					return $stmt;
				endif;
		}

		public function execQuery($stmt){
			if($stmt->execute()):
				return "a";
			endif;

		}



	}