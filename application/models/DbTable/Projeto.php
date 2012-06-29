<?php

class Application_Model_DbTable_Projeto extends Zend_Db_Table {

	protected $_name = 'PROJETO';
	
	public function getTodosProjetos(){
		$db = Zend_Registry::get('db');
	
		$sql = "
			SELECT *
			FROM PROJETO
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