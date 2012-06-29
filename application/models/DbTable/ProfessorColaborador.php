<?php

class Application_Model_DbTable_ProfessorColaborador extends Zend_Db_Table {

	protected $_name = 'PROFESSOR_COLABORADOR';
	
	public function getTodosProfColaboradores(){
		$db = Zend_Registry::get('db');
	
		$sql = "
			SELECT *
			FROM PROFESSOR_COLABORADOR
		";
		
		$result = $db->FetchAll($sql);
		//	var_dump($result);
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	
}