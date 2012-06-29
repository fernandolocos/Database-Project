<?php

class Application_Model_DbTable_Professor_Colaborador extends Zend_Db_Table {

	protected $_name = 'PROFESSOR_COLABORADOR';
	
	public function getTodosPesquisadores(){
		$db = Zend_Registry::get('db');
	
		$sql = "
			SELECT NOME
			FROM PROFESSOR_COLABORADOR
			ORDER BY NOME
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