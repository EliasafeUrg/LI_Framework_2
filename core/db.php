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
	const INIFILE =  "app/config/database.ini";
	


	function __construct(){
		
		
		$this->attrCreate = new AtributesCreate;
		$this->attrUpdate = new AtributesUpdate;
	}

	public function connectDB(){
		$this->iniData = parse_ini_file(self::INIFILE);

		try {

			$banco =  @new PDO("{$this->iniData['driver']}:host={$this->iniData['host']}; dbname={$this->iniData['dbname']}", "{$this->iniData['username']}", "{$this->iniData['password']}" );
			$banco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$banco->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			$banco->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
			return $banco;
		} catch (\PDOException $e) {

			require "core/errors/database_error.php";
			die();
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
		require "core/errors/query_error.php";
	}
			}
			public function update($table, $atributes){
				$campo = $this->attrUpdate->createFieldsUpdate($atributes);
				$fields =     $this->attrUpdate->createFieldsUpdate($atributes);
				$update = $this->attrUpdate->bindCreateParameters($atributes);
				
				$this->query = "UPDATE {$table} SET $fields";
				$this->query .= $this->where;

				if($this->prepareQuery($update)):
					$this->resetAtrubutes();
					return true;
				else:
					return false;
				endif;
			}


			public function insert($table, $atributes){
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

			public function delete($table){
				// Deleta Registro
				$this->query = "DELETE FROM $table $this->sql_where";
				$this->query .= $this->where;
				if($this->prepareQuery()):
					
					$this->resetAtrubutes();
					return true;
				else:
					return false;	
				endif;	
			}
			private function resetAtrubutes(){
				 $this->where = null;
				 $this->query= null;
				 $this->and = null;
				 $this->or = null;
				 $this->sql_where = "WHERE";
				 $this->field;
				 $this->order_by = null;

			}
			public function where($field, $id){
				// Seta Where
				$this->where .= " $this->and $this->sql_where $field = '$id'";
				$this->field = $field;
				$this->sql_where = null;
				$this->and =  "AND";
				$this->or =  "OR";
			}

			public function or_where($field, $id){
				//  Seta OR
				$this->where .= " $this->or $this->sql_where $field = '$id'";
				$this->field = $field;
				$this->sql_where = null;
				$this->or =  "OR";
			}

			public function order_by($name, $option){
				// Seta Order by
				$this->order_by = " ORDER BY {$name} {$option}";
			}
			public function get($table){
				// Meodo responsável por executar Select
				$this->table = $table;
				$this->query = "SELECT * FROM {$this->table}";
				$this->query .= $this->where." ". $this->order_by;
				// var_dump($this);
				return $this;			
			}
				
			public function insert_id(){
				// Retorma o ultimo ID inserido
				return $this->connect->lastInsertId();
			}
			public function num_rows(){
				// retorna numero de linhas encontrada;
				$stmt = $this->prepareQuery();
				return $stmt->rowCount();
			}
			public function result(){
				// retorna todas a linha encontradas em array
				$stmt = $this->prepareQuery();	
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			}
			public function row(){
				// retorna somente uma linha
				$stmt = $this->prepareQuery();
				return $stmt->fetch(PDO::FETCH_ASSOC);

			}
			public function result_obj(){
				// retorna todas linha encontradas em objeto
				$stmt = $this->prepareQuery();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			}
		}