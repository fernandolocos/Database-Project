<?php

class Application_Model_DbTable_Pesquisador extends Zend_Db_Table {

	protected $_name = 'PESQUISADOR';
	
	public function getTodosPesquisadores(){
		$db = Zend_Registry::get('db');
	
		$sql = "
			SELECT *
			FROM PESQUISADOR
		";
		
		$result = $db->FetchAll($sql);
		//var_dump($result);
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	
	public function getNomePesquisador($cpf){
		$db = Zend_Registry::get('db');
	
		$sql = "
			SELECT NOME
			FROM PESQUISADOR
			WHERE CPF = '{$cpf}'
		";
	
		$result = $db->FetchOne($sql);
		//var_dump($result);
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	
}