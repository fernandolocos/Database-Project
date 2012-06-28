<?php

class Application_Model_DbTable_Pesquisador extends Zend_Db_Table {

	protected $_name = 'PESQUISADOR';
	
	public function getTodosPesquisadores(){
		$db = Zend_Registry::get('db');
	
		$sql = "
			SELECT NOME
			FROM PESQUISADOR
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