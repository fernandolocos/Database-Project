<?php

class Application_Model_DbTable_Professor extends Zend_Db_Table {

	protected $_name = 'PROFESSOR';
	
	public function getTodosProfessores(){
		$db = Zend_Registry::get('db');
	
		$sql = "
			SELECT *
			FROM PROFESSOR
		";
		
		$result = $db->FetchAll($sql);
		//var_dump($result);
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	
}