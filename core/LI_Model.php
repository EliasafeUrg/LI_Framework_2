<?php 


namespace Core;

abstract class LI_Model{
	protected $db;
	function __construct(){
		$this->db = new db;
	}
}