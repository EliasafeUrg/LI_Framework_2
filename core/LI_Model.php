<?php 


namespace Core;


class LI_Model extends db{
	protected $db;
	function __construct(){
		$this->db = new db;
	}


}