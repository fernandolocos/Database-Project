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

	public function getMembrosLab()
	{	
		$arrayNomes = null;
		$db = Zend_Registry::get('db');
		
		$sql = "
			SELECT P.NOME
			FROM PESQUISADOR P
			LEFT JOIN ALUNO A ON (A.CPF = P.CPF)
			LEFT JOIN PROFESSOR PROF ON (PROF.CPF = P.CPF)
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
		
		
		/*$arrayMembrosLab = null;
		$arrayAlunos = $this->aluno->getTodosAlunos();
		$arrayProfessores = $this->professor->getTodosProfessores();
		
		if(is_array($arrayAlunos))
		{
			foreach($arrayAlunos as $chave => $dados)
			{
				$arrayMembrosLab[] = $dados['CPF'];
			}
		}
		
		if(is_array($arrayProfessores))
		{
			foreach($arrayProfessores as $chave => $dados)
			{
				$arrayMembrosLab[] = $dados['CPF'];
			}
		}
		
		if(is_array($arrayMembrosLab))
		{
			foreach($arrayMembrosLab as $chave => $cpf)
			{
				$arrayNomes[]['NOME'] = $this->pesquisador->getNomePesquisador($cpf);
			}
			sort($arrayNomes);
		
			$cabecalho = array('Nome');
			return $this->tabela->criarTabela($cabecalho, $arrayNomes, 
					null, null, null, null, null, 1, null); 
		}
		else
		{
			return $this->view->mensagem = "<span>Não existem dados no banco!</span>";
		}*/
	}
	
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
		
		/*$arrayProfColaboradores = null;
		$arrayProfColaboradores = $this->profColaborador->getTodosProfColaboradores();
		
		if(is_array($arrayProfColaboradores))
		{
			foreach($arrayProfColaboradores as $chave => $dados)
			{
				$arrayNomes[]['NOME'] = $this->pesquisador->getNomePesquisador($dados['CPF']);
			}
			sort($arrayNomes);
		
			$cabecalho = array('Nome');
			return $this->tabela->criarTabela($cabecalho, $arrayNomes,
					null, null, null, null, null, 1, null);
		}
		else
		{
			return $this->view->mensagem = "<span>Não existem dados no banco!</span>";
		}*/
	}

}