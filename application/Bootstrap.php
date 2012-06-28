<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	/**
	 * Fun��o faz a conex�o com o banco de dados e registra a vari�vel $db para
	 * que ela esteja dispon�vel em toda a aplica��o.
	 */
	protected function _initConexao()//Connection()
	{
		$registry = Zend_Registry::getInstance();
	
		//configura a conex�o com o BD LABORATORIO
		$options    = $this->getOption('resources');
		$db_adapter = $options['db']['adapter'];
		$params     = $options['db']['params'];
		try{
			$db = Zend_Db::factory($db_adapter, $params);
			$db->query ( "SET NAMES 'latin1'" );
			$db->getConnection();
			$registry->set('db', $db);
		}catch( Zend_Exception $e){
			echo "Estamos sem conex�o com o banco neste momento.
			Tente mais tarde por favor.";
			exit;
		}
	}
	
	
	protected function _initRegistry()
	{
		$registry = Zend_Registry::getInstance();
		$raizDefault = '/application';
		$registry->set('raizDefault', $raizDefault);
	}

}

