<?php 

namespace Core;
use Core\config\AtributesCreate;
use Core\config\AtributesUpdate;
use \PDO;

class db{		

	private $where = null;
	private $query= null;
	private $and = null;
	private $or = null;
	private $sql_where = "WHERE";
	private $field;
	private $order_by = null;
	private $reference;


	function __construct(){
		$this->attrCreate = new AtributesCreate;
		$this->attrUpdate = new AtributesUpdate;
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
			if($this->execQuery($stmt,$bindParameters)):
				return true;
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
		$this->where = "WHERE";
		$this->query = null;
		$this->and = null;
		$this->field = null;
	try {
		if(!is_null($bindParameters)):
		
				$stmt->execute($bindParameters);

				return true;
			else:
				if($stmt->execute()):
					return true;
				endif;
			endif;
	
	} catch (\PDOException $e) {
		dump($e->getMessage());
	}
			}
			protected function update($table, $atributes){
				$campo = $this->attrUpdate->createFieldsUpdate($atributes);
				$fields =     $this->attrUpdate->createFieldsUpdate($atributes);
				$update = $this->attrUpdate->bindCreateParameters($atributes);
				
				$this->query = "UPDATE {$table} SET $fields";
				$this->query .= $this->where;

				// $this->query = substr($this->query, 0, -4);
				var_dump($this->query);
				if($this->prepareQuery($update)):
					return true;
				else:
					return false;
				endif;
			}


			protected function insert($table, $atributes){
				// Prepara campos and valores
				$fields = $this->attrCreate->createFields($atributes);
				$values =  $this->attrCreate->createValues($atributes);
				$bindParameters = $this->attrCreate->bindCreateParameters($atributes);

				$this->table = $table;
				$this->query = "INSERT INTO {$this->table} ({$fields}) VALUES ($values)";
				if($this->prepareQuery($bindParameters)):
					return true;
				else:
					return false;	
				endif;		
			}

			protected function delete($table){

				$this->query = "DELETE FROM $table $this->sql_where";
				$this->query .= $this->where;
				var_dump($this->query);
				if($this->prepareQuery()):
					
					return true;
				else:
					return false;	
				endif;	
			}
			protected function where($field, $id){
				
				$this->where .= " $this->and $this->sql_where $field = '$id'";
				$this->field = $field;
				$this->sql_where = null;
				$this->and =  "AND";
				$this->or =  "OR";
			}

			protected function or_where($field, $id){
				
				$this->where .= " $this->or $this->sql_where $field = '$id'";
				$this->field = $field;
				$this->sql_where = null;
				$this->or =  "OR";
			}

			protected function order_by($name, $option){
				// var_dump($this->where);
				$this->order_by = " ORDER BY {$name} {$option}";
				
				// order by CASE WHEN id = 100 THEN 1 ELSE 2 END, nome
			}
			protected function get($table){
				
				$this->table = $table;
				$this->query = "SELECT * FROM {$this->table}";
				
				
				$this->query .= $this->where." ". $this->order_by;
				var_dump($this->query);
				return $this;			
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