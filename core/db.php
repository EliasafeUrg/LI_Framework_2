<?php 

namespace Core;
use Core\config\AtributesCreate;
use Core\config\AtributesUpdate;
use \PDO;

class db{		
			// private $query;
			// private $table;
			// private $attr;
	private $where = null;
	private $query= null;


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
			protected function update($table, $atributes){

				$campo = $this->attrUpdate->createFieldsUpdate($atributes);
				$fields =     $this->attrUpdate->createFieldsUpdate($atributes);

				$update = $this->attrUpdate->bindCreateParameters($atributes);
				
				$this->query = "UPDATE {$table} SET $fields WHERE ";
				$this->query .= $this->where;
				$this->query = substr($this->query, 0, -3);
				var_dump($this->query);
				if($this->prepareQuery($update)):
					return true;
				else:
					return false;
				endif;
			}
			protected function do_where($field, $id){
				$this->where .= " $field = '$id' AND";
			}


			protected function get($table){
				$this->table = $table;
				$this->query = "SELECT * FROM {$this->table} WHERE";
				$this->query .= $this->where;
				$this->query = substr($this->query, 0, -3);
				
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