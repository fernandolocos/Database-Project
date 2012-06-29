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

    // consulta 01
    public function consultarMembrosLabAction()
    {
    	$this->view->tabela = $this->consultas->getMembrosLab();
    }
    
    // consulta 02
    public function consultarProfColaboradoresLabAction()
    {
    	$this->view->tabela = $this->consultas->getProfColaboradoresLab();
    }
    
    // consulta 03
    public function consultarProjetosLabAction()
    {
    	$this->view->tabela = $this->consultas->getProjetosLab();
    }
    
    // consulta 04
    public function consultarMembrosNaoEphenologyAction()
    {
    	$this->view->tabela = $this->consultas->getMembrosNaoEphenology();
    }
    
    // consulta 05
    public function consultarCoordenadorProjetosAction()
    {
    	$this->view->tabela = $this->consultas->getCoordenadorProjetos();
    }
    
    // consulta 06
    public function consultarInstFinanciaProjAction()
    {
    	$this->view->tabela = $this->consultas->getInstFinanciaProj();
    }
    
    // consulta 07
    public function consultarOrientadorJurandyAction()
    {
    	$this->view->tabela = $this->consultas->getOrientadorJurandy();
    }
    
    // consulta 08
    public function consultarOrientadosProfarochaDefenderamAction()
    {
    	$this->view->tabela = $this->consultas->getOrientadosProfarochaDefenderam();
    }
    
    // consulta 09
    public function consultarSubprojetosEphenologyAction()
    {
    	$this->view->tabela = $this->consultas->getSubprojetosEphenology();
    }
    
    // consulta 10
    public function consultarContribuicoesEphenologyAction()
    {
    	$this->view->tabela = $this->consultas->getContribuicoesEphenology();
    }
    
    // consulta 11
    public function consultarQualisInternacionaisAction()
    {
    	$this->view->tabela = $this->consultas->getQualisInternacionais();
    }
    
    // consulta 12
    public function consultarArtigosProfarochaAction()
    {
    	$this->view->tabela = $this->consultas->getArtigosProfarocha();
    }
    
    // consulta 13
    public function consultarAlunosEstgSanduicheAction()
    {
    	$this->view->tabela = $this->consultas->getAlunosEstgSanduiche();
    }
    
    // consulta 14
    public function consultarDadosJeferssonAction()
    {
    	$this->view->tabela = $this->consultas->getDadosJefersson();
    }
    
    // consulta 15
    public function consultarQtdeBancasHelioAction()
    {
    	$this->view->tabela = $this->consultas->getQtdeBancasHelio();
    }
    
    // consulta 16
    public function consultarPatentesProfarochaAction()
    {
    	$this->view->tabela = $this->consultas->getPatentesProfarocha();
    }
    
    // consulta 17
    public function consultarDataPalestraAction()
    {
    	$this->view->tabela = $this->consultas->getDataPalestra();
    }
    
    // consulta 18
    public function consultarPublicacoesDoutorandosAction()
    {
    	$this->view->tabela = $this->consultas->getPublicacoesDoutorandos();
    }
    
    // consulta 19
    public function consultarProjMaisPublicadoAction()
    {
    	$this->view->tabela = $this->consultas->getProjMaisPublicado();
    }
    
    // consulta 20
    public function consultarProfFapespNaoRtorresAction()
    {
    	$this->view->tabela = $this->consultas->getProfFapespNaoRtorres();
    }
}

