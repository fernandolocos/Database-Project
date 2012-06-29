<?php

class Application_Model_Consultas {
	
	public function __construct()
	{
		$this->raizDefault = Zend_Registry::get('raizDefault');
		$this->aluno = new Application_Model_DbTable_Aluno();
		$this->professor = new Application_Model_DbTable_Professor();
		$this->pesquisador = new Application_Model_DbTable_Pesquisador();
		$this->profColaborador = new Application_Model_DbTable_ProfessorColaborador();
		$this->tabela = new Application_Model_Tabela();
	}
	
	// consulta 01
	public function getMembrosLab()
	{	
		$arrayNomes = null;
		$db = Zend_Registry::get('db');
		
		$sql = "
			SELECT P.NOME
            FROM PESQUISADOR P
            JOIN ALUNO A ON (A.CPF = P.CPF)
            	UNION
                SELECT P.NOME
                FROM PESQUISADOR P
                JOIN PROFESSOR PROF ON (PROF.CPF = P.CPF)
            ORDER BY NOME
		";
		
		$arrayNomes = $db->FetchAll($sql);
		//var_dump($result);
		if($arrayNomes)
		{
			$cabecalho = array('Membros');
			return $this->tabela->criarTabela($cabecalho, $arrayNomes, 
					null, null, null, null, null, 1, null); 
		}
		else
		{
			return "<span>Não existem dados no banco!</span>";
		}
	}
	
	// consulta 02
	public function getProfColaboradoresLab()
	{
		$arrayNomes = null;
		$db = Zend_Registry::get('db');
		
		$sql = "
			SELECT P.NOME
			FROM PESQUISADOR P
			JOIN PROFESSOR_COLABORADOR C ON (C.CPF = P.CPF)
			ORDER BY NOME
		";
		
		$arrayNomes = $db->FetchAll($sql);
		//var_dump($result);
		if($arrayNomes)
		{
			$cabecalho = array('Nome');
			return $this->tabela->criarTabela($cabecalho, $arrayNomes,
					null, null, null, null, null, 1, null);
		}
		else
		{
			return "<span>Não existem dados no banco!</span>";
		}
	}
	
	// consulta 03
	public function getProjetosLab()
	{
		$arrayNomes = null;
		$db = Zend_Registry::get('db');
	
		$sql = "
			SELECT P.TITULO, P.DESCRICAO
			FROM PROJETO P
			WHERE DATA_FIM IS NULL
			ORDER BY DATA_INICIO
		";
	
		$arrayNomes = $db->FetchAll($sql);
		//var_dump($result);
		if($arrayNomes)
		{
			$cabecalho = array('Projeto', 'Descrição');
			return $this->tabela->criarTabela($cabecalho, $arrayNomes,
					null, null, null, null, null, 1, null);
		}
		else
		{
			return "<span>Não existem dados no banco!</span>";
		}
	}
	
	// consulta 04
	public function getMembrosNaoEphenology()
	{
		$arrayProjetos = null;
		$db = Zend_Registry::get('db');
	
		$sql = "
			SELECT DISTINCT(NOME)
			FROM PESQUISADOR
			WHERE CPF NOT IN(
							SELECT DISTINCT(CPF)
							FROM PROJETO PROJ, PESQUISADOR_X_EQUIPE PE 	
							WHERE 	(PROJ.NUMERO = 1 OR PROJ.NUM_SUPER_PROJ = 1) AND
							PE.COD_EQUIPE = PROJ.COD_EQUIPE
							)
		";
	
		$arrayProjetos = $db->FetchAll($sql);
		//var_dump($result);
		if($arrayProjetos)
		{
			$cabecalho = array('Membros');
			return $this->tabela->criarTabela($cabecalho, $arrayProjetos,
					null, null, null, null, null, 1, null);
		}
		else
		{
			return "<span>Não existem dados no banco!</span>";
		}
	}
	
	// consulta 05
 	public function getCoordenadorProjetos()
	{
		
	}
	
	// consulta 06
	public function getInstFinanciaProj()
	{
	
	}
	
	// consulta 07
	public function getOrientadorJurandy()
	{
	
	}
	
	// consulta 08
	public function getOrientadosProfarochaDefenderam()
	{
	
	}
	
	// consulta 09
	public function getSubprojetosEphenology()
	{
	
	}
	
	// consulta 10
	public function getContribuicoesEphenology()
	{
	
	}
	
	// consulta 11
	public function getQualisInternacionais()
	{
	
	}
	
	// consulta 12
	public function getArtigosProfarocha()
	{
	
	}
	
	// consulta 13
	public function getAlunosEstgSanduiche()
	{
	
	}
	
	// consulta 14
	public function getDadosJefersson()
	{
	
	}
	
	// consulta 15
	public function getQtdeBancasHelio()
	{
	
	}
	
	// consulta 16
	public function getPatentesProfarocha()
	{
	
	}
	
	// consulta 17
	public function getDataPalestra()
	{
	
	}
	
	// consulta 18
	public function getPublicacoesDoutorandos()
	{
	
	}
	
	// consulta 19
	public function getProjMaisPublicado()
	{
	
	}
	
	// consulta 20
	public function getProfFapespNaoRtorres()
	{
	
	}
}