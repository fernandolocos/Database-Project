<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->consultas = new Application_Model_Consultas();
    }

    public function indexAction()
    {
	
    }

    public function consultarMembrosLabAction()
    {
    	$this->view->tabela = $this->consultas->getMembrosLab();
    }
    
    public function consultarProfColaboradoresLabAction()
    {
    	$this->view->tabela = $this->consultas->getProfColaboradoresLab();
    }
}

