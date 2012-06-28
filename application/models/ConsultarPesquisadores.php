<?php

class Application_Model_ConsultarPesquisadores {
	
	public function __construct()
	{
		$this->raizDefault = Zend_Registry::get('raizDefault');
		$this->pesquisador = new Application_Model_DbTable_Pesquisador();
		$this->tabela = new Application_Model_Tabela();
	}

	public function getPesquisadores()
	{	
		$arrayPesquisadores = $this->pesquisador->getTodosPesquisadores();
		$cabecalho = array('Nome');
		return $this->tabela->criarTabela($cabecalho, $arrayPesquisadores, 
				null, null, null, null, null, 1, null); 
	}

}