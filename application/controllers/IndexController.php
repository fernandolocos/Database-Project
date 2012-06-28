<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
    	
    }

    public function indexAction()
    {
	
    }

    public function consultarPesquisadoresAction()
    {
    	$this->consultarPesquisadores = new Application_Model_ConsultarPesquisadores();
    	$this->view->tabela = $this->consultarPesquisadores->getPesquisadores();
    }
}

