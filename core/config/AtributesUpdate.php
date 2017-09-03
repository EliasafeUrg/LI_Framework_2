<?php 
	namespace Core\config;
	class AtributesUpdate
	{
		public function bindCreateParameters($attributes){
			$keys = array_keys($attributes);
			$values = array_values($attributes);
			

			$separadorPorPontos = 	":".implode("=:", $keys);

			$combine = array_combine($keys, explode("=", $separadorPorPontos));
			
			// array_combine($combine, $keys);
			return array_combine($combine, $values);

		}

		public function createFieldsUpdate($atributes){
			$setValues = [];
			foreach ($atributes as $key => $value) {
				$setValues[] = "$key = :$key ";
			}

			$setQuery = implode(",",$setValues);
			return $setQuery;	
			// $implode = implode($array);
			


		}


	
	}


 ?>