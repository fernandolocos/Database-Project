<?php

class Application_Model_DbTable_Aluno extends Zend_Db_Table {

	protected $_name = 'ALUNO';
	
	public function getTodosAlunos(){
		$db = Zend_Registry::get('db');
	
		$sql = "
			SELECT *
			FROM ALUNO
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