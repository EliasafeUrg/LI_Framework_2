<?php 


	namespace app\core;
	use \PDO;

	class db{
		

		// private $query;
		// private $table;
		// private $banco;
		// private $attr;

		function __construct(){

			$this->attr = new \app\core\config\AtributesCreate;

			
		}

	public function connectDB(){
		 try {
				 $banco =  new PDO('mysql:host=localhost;dbname=loja', "root", "");
			     $banco->exec("set names utf8");
                 $banco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 $banco->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
				 return $banco;
			 } catch (\PDOException $e) {
                    dump($e->getMessage());
                              
                    exit();
          }


		}

		
			// prepara query
		private function prepareQuery($bindParameters =null){
				$this->connect = $this->connectDB();

				if(!is_null($bindParameters)):
					
					$stmt = $this->connect->prepare($this->query);
					
					if($this->execQuery($stmt,$bindParameters,$this->connect)):
						return $this->connect;
					endif;
				else:
					
					$stmt = $this->connect->prepare($this->query);

					if($this->execQuery($stmt)):
						return $stmt;
					endif;

				endif;
			
		
		}

			// EXECUTA QUERY 
		private function execQuery($stmt, $bindParameters =null){
			if(!is_null($bindParameters)):
				


				   try {
                        $stmt->execute($bindParameters);
						return true;
                    } catch (\PDOException $e) {
                        dump($e->getMessage());



                    }
			else:
				if($stmt->execute()):
					return true;
				endif;
			endif;
		}

		protected function get($table){
				
			// $this->banco = new db;
			$this->table = $table;
			$this->query = "SELECT * FROM {$this->table}";
		
			return $this;
				
		}

		protected function where($field, $id){
			
			$this->query = "SELECT * FROM {$this->table} WHERE {$field} = '{$id}' ";
		}

		protected function insert($table, $atributes){
			
				// Prepara campos and valores
			$fields = $this->attr->createFields($atributes);
			$values =  $this->attr->createValues($atributes);
			$bindParameters = $this->attr->bindCreateParameters($atributes);

			// $this->banco = new db;
			$this->table = $table;
			$this->query = "INSERT INTO {$this->table} ({$fields}) VALUES ($values)";
			if($this->prepareQuery($bindParameters)):
				return true;
			else:
				return false;	
			endif;		
		}

				// Retorma o ultimo ID inserido
		protected function insert_id(){
				return $this->connect->lastInsertId();
		}




	
		protected function num_rows(){
			$stmt = $this->prepareQuery();
			return $stmt->rowCount();
		}


		protected function result(){
			
			$stmt = $this->prepareQuery();	
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		protected function row(){
			
			$stmt = $this->prepareQuery();
			return $stmt->fetch(PDO::FETCH_ASSOC);
			
		}

		protected function result_obj(){
			$stmt = $this->prepareQuery();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}


	}