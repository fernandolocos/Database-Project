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
		$array = null;
		$db = Zend_Registry::get('db');
		
		$sql = "
			SELECT P.NOME, PROJ.TITULO 
			FROM PROFESSOR_X_PROJETO PP
			JOIN PESQUISADOR P ON (P.CPF = PP.CPF_COORDENADOR)
			JOIN PROJETO PROJ ON (PROJ.NUMERO = PP.COD_PROJETO)
			WHERE 	(DATE(PP.DATA_INICIAL) >= '2009-04-01' AND
					DATE(PP.DATA_INICIAL) <= '2012-07-01') OR
					(DATE(PP.DATA_FINAL) >= '2009-04-01' AND
					DATE(PP.DATA_FINAL) <= '2012-07-01')
			ORDER BY P.NOME
		";
		
		$array = $db->FetchAll($sql);
		//var_dump($result);
		if($array)
		{
			$cabecalho = array('Coordenadores', 'Projeto');
			return $this->tabela->criarTabela($cabecalho, $array,
					null, null, null, null, null, 1, null);
		}
		else
		{
			return "<span>Não existem dados no banco!</span>";
		}
	}
	
	// consulta 06
	public function getInstFinanciaProj()
	{
		$array = null;
		$db = Zend_Registry::get('db');
		
		$sql = "
			SELECT F.SIGLA, F.NOME, FP.DESCRICAO 
			FROM FINANCIADORA F, FINANCIADORA_X_PROJETO FP, PROJETO P
			WHERE (
			P.TITULO = 'e-phenology'
			AND P.NUMERO = FP.COD_PROJETO
			AND F.CODIGO = FP.COD_FINANCIADORA
		)";
		
		$array = $db->FetchAll($sql);
		//var_dump($result);
		if($array)
		{
			$cabecalho = array('Sigla', 'Financiadora', 'Descricao');
			return $this->tabela->criarTabela($cabecalho, $array,
					null, null, null, null, null, 1, null);
		}
		else
		{
			return "<span>Não existem dados no banco!</span>";
		}
	}
	
	// consulta 07
	public function getOrientadorJurandy()
	{
		$array = null;
		$db = Zend_Registry::get('db');
		
		$sql = "
			SELECT ORI.NOME 
			FROM PESQUISADOR ORI, DISSERTACAO D, PESQUISADOR MES, PROFESSOR_X_DISSERTACAO PS
			WHERE (
				MES.NOME = 'Jurandy Gomes de Almeida Junior'
				AND D.CPF_MESTRANDO = MES.CPF
				AND PS.COD_DISSERTACAO = D.COD_CONTRIBUICAO
				AND PS.CPF_PROFESSOR = ORI.CPF
			)
			ORDER BY NOME
		";
		
		$array = $db->FetchAll($sql);
		//var_dump($result);
		if($array)
		{
			$cabecalho = array('Orientador');
			return $this->tabela->criarTabela($cabecalho, $array,
					null, null, null, null, null, 1, null);
		}
		else
		{
			return "<span>Não existem dados no banco!</span>";
		}
	}
	
	// consulta 08
	public function getOrientadosProfarochaDefenderam()
	{
		$array = null;
		$db = Zend_Registry::get('db');
		
		$sql = "
			SELECT P.NOME 
			FROM PESQUISADOR P, PESQUISADOR ORI, PROFESSOR_X_DISSERTACAO PD, DISSERTACAO DIS, DEFESA_DISSERTACAO DEF
			WHERE (
				ORI.NOME = 'Anderson de Rezende Rocha'
				AND ORI.CPF = PD.CPF_PROFESSOR
				AND PD.COD_DISSERTACAO = DIS.COD_CONTRIBUICAO
				AND DIS.CPF_MESTRANDO = P.CPF
				AND DEF.COD_DISSERTACAO = DIS.COD_CONTRIBUICAO
				AND DEF.DATA >= '2012-01-01'
				AND DEF.DATA <= '2012-12-31'
			)
			UNION
			SELECT P.NOME 
			FROM PESQUISADOR P, PESQUISADOR ORI, PROFESSOR_X_TESE PT, TESE T, DEFESA_TESE DEF
			WHERE (
				ORI.NOME = 'Anderson de Rezende Rocha'
				AND ORI.CPF = PT.CPF_PROFESSOR
				AND PT.COD_TESE = T.COD_CONTRIBUICAO
				AND T.CPF_DOUTORANDO = P.CPF
				AND DEF.COD_TESE = T.COD_CONTRIBUICAO
				AND DEF.DATA >= '2012-01-01'
				AND DEF.DATA <= '2012-12-31'
			)
			ORDER BY NOME
		";
		
		$array = $db->FetchAll($sql);
		//var_dump($result);
		if($array)
		{
			$cabecalho = array('Orientado');
			return $this->tabela->criarTabela($cabecalho, $array,
					null, null, null, null, null, 1, null);
		}
		else
		{
			return "<span>Não existem dados no banco!</span>";
		}
	}
	
	// consulta 09
	public function getSubprojetosEphenology()
	{
		$array = null;
		$db = Zend_Registry::get('db');
		
		$sql = "
			SELECT SUB.TITULO 
			FROM PROJETO SUB, PROJETO P
			WHERE (
				P.TITULO = 'e-phenology'
				AND SUB.NUM_SUPER_PROJ = P.NUMERO
			)
			ORDER BY TITULO
		";
		
		$array = $db->FetchAll($sql);
		//var_dump($result);
		if($array)
		{
			$cabecalho = array('Subprojetos E-phenology');
			return $this->tabela->criarTabela($cabecalho, $array,
					null, null, null, null, null, 1, null);
		}
		else
		{
			return "<span>Não existem dados no banco!</span>";
		}
	}
	
	// consulta 10
	public function getContribuicoesEphenology()
	{

	}
	
	// consulta 11
	public function getQualisInternacionais()
	{
		$array = null;
		$db = Zend_Registry::get('db');
		
		$sql = "
			SELECT A.TITULO
			FROM ARTIGO A
			WHERE (A.QUALIS = 'A1')
			ORDER BY TITULO
		";
		
		$array = $db->FetchAll($sql);
		//var_dump($result);
		if($array)
		{
			$cabecalho = array('Artigos');
			return $this->tabela->criarTabela($cabecalho, $array,
					null, null, null, null, null, 1, null);
		}
		else
		{
			return "<span>Não existem dados no banco!</span>";
		}
	}
	
	// consulta 12
	public function getArtigosProfarocha()
	{
		
	}
	
	// consulta 13
	public function getAlunosEstgSanduiche()
	{
		$array = null;
		$db = Zend_Registry::get('db');
		
		$sql = "
			SELECT P.NOME 
			FROM PESQUISADOR P
			LEFT JOIN INTERCAMBIO_MESTRADO IM ON (IM.CPF = P.CPF)
			LEFT JOIN INTERCAMBIO_DOUTORADO ID ON (ID.CPF = P.CPF)
			WHERE 	((DATE(ID.DATA_INICIAL) >= '2010-01-01' AND
				DATE(ID.DATA_INICIAL) <= '2010-12-31') OR
				(DATE(ID.DATA_FINAL) >= '2010-01-01' AND
				DATE(ID.DATA_FINAL) <= '2010-12-31')) OR
				((DATE(IM.DATA_INICIAL) >= '2010-01-01' AND DATE(IM.DATA_INICIAL) <= '2010-12-31') OR
				(DATE(IM.DATA_FINAL) >= '2010-01-01' AND DATE(IM.DATA_FINAL) <= '2010-12-31'))
			ORDER BY P.NOME
		";
		
		$array = $db->FetchAll($sql);
		//var_dump($result);
		if($array)
		{
			$cabecalho = array('Alunos');
			return $this->tabela->criarTabela($cabecalho, $array,
					null, null, null, null, null, 1, null);
		}
		else
		{
			return "<span>Não existem dados no banco!</span>";
		}
	}
	
	// consulta 14
	public function getDadosJefersson()
	{
		
	}
	
	// consulta 15
	public function getQtdeBancasHelio()
	{
		$array = null;
		$db = Zend_Registry::get('db');
		
		$sql = "
			SELECT COUNT(CB.COD_BANCA)
			FROM COLABORADOR_X_BANCA CB, EQ_DOUTORADO D
			WHERE CB.COD_BANCA = D.COD_BANCA
		";
		
		$array = $db->FetchAll($sql);
		//var_dump($result);
		if($array)
		{
			$cabecalho = array('Qtde de Bancas');
			return $this->tabela->criarTabela($cabecalho, $array,
					null, null, null, null, null, 1, null);
		}
		else
		{
			return "<span>Não existem dados no banco!</span>";
		}
	}
	
	// consulta 16
	public function getPatentesProfarocha()
	{
		$array = null;
		$db = Zend_Registry::get('db');
		
		$sql = "
			SELECT PAT.TITULO 
			FROM PATENTE PAT, PESQUISADOR P, PESQUISADOR_X_CONTRIBUICAO PC
			WHERE (
				P.NOME = 'Anderson de Rezende Rocha'
				AND P.CPF = PC.CPF
				AND PC.CODIGO = PAT.COD_CONTRIBUICAO
			)
			ORDER BY TITULO
		";
		
		$array = $db->FetchAll($sql);
		//var_dump($result);
		if($array)
		{
			$cabecalho = array('Patentes');
			return $this->tabela->criarTabela($cabecalho, $array,
					null, null, null, null, null, 1, null);
		}
		else
		{
			return "<span>Não existem dados no banco!</span>";
		}
	}
	
	// consulta 17
	public function getDataPalestra()
	{
		$array = null;
		$db = Zend_Registry::get('db');
		
		$sql = "
			SELECT O.DATA
			FROM OUTRO_EVENTO_X_APRESENTACAO O, APRESENTACAO A
			WHERE O.COD_CONTRIBUICAO = A.COD_CONTRIBUICAO
		";
		
		$array = $db->FetchAll($sql);
		//var_dump($result);
		if($array)
		{
			$cabecalho = array('Data');
			return $this->tabela->criarTabela($cabecalho, $array,
					null, null, null, null, null, 1, null);
		}
		else
		{
			return "<span>Não existem dados no banco!</span>";
		}
	}
	
	// consulta 18
	public function getPublicacoesDoutorandos()
	{
		$array = null;
		$db = Zend_Registry::get('db');
		
		$sql = "
			SELECT P.NOME, C.TIPO
			FROM CONTRIBUICAO C, PESQUISADOR_X_CONTRIBUICAO PC, DOUTORANDO D, PESQUISADOR P
			WHERE 	C.CODIGO = PC.CODIGO AND
					PC.CPF = D.CPF AND
					PC.CPF = P.CPF
			ORDER BY NOME
		";
		
		$array = $db->FetchAll($sql);
		//var_dump($result);
		if($array)
		{
			$cabecalho = array('Doutorando', 'Publicação');
			return $this->tabela->criarTabela($cabecalho, $array,
					null, null, null, null, null, 1, null);
		}
		else
		{
			return "<span>Não existem dados no banco!</span>";
		}
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