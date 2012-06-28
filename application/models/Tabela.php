<?php

class Application_Model_Tabela
{	
	
	/**
	 * Cria uma tabela com os parâmetros passados
	 * @param array $cabecalho
	 * @param array $linhas
	 * @param array $rodape
	 * @param string $id
	 * @param string $name
	 * @param string $class
	 * @param int $largura
	 * @param int $borda
	 * @return string|bool $retorno
	 */
	public function criarTabela( $cabecalho, $linhas, $rodape=null, $id=null, $name=null, $class=null, $larguraPx=null, $borda=null, $largura=null )
	
	{
		$th = '';
		if(!is_array($cabecalho) or !is_array($linhas))
		return false;
		
		//caso simples de cabeçalho:
		//cabeçalho com uma só coluna
		$th = '<tr>';
		foreach ($cabecalho as $chave => $valor)
		{ 	
			$th .= "<th>$valor</th>";
		}
		$th .= '</tr>';
		
		//cria as linhas
		$trTd = '';
		$ord = 0;
		//var_dump($linhas);
		foreach($linhas as $linha => $valores)
		{
			$ord++;
			if(($ord % 2) == (0)){$corDataGrid = "class='corDataGrid'";}else{$corDataGrid = null;}
			$trTd .= "<tr $corDataGrid>";
			foreach($valores as $valor)
			{
				
				$trTd .= "<td>$valor</td>";	
			}
			$trTd .= '</tr>';
		}
		
		//cria o rodapé se houver
		$rod='';
		if(is_array($rodape))	
		{
			$rod='<tr>';
			foreach($rodape as $valor)
			{
				$rod .= "<td>$valor</td>";
			}
			$rod='</tr>';
		}
		
		//seta atributos da tabela, caso exista
		if($id) $id="id='$id'";
		if($name) $name="name='$name'";
		if($class) $class="class='$class'";
		if($larguraPx) $largura="width='$larguraPx px'";
		if($borda) $borda="border='$borda'";
		//echo "largura:$largura";
		
		
		$tabela = "
			<table $id $name $class $largura $borda >
				$th
				$trTd
				$rod
			</table>
		";
		return $tabela;
	}
	
	
	
	
	function _getQtdLinhasEColunas($array)
	{
		if(is_array($array)){
			foreach($array as $chave => $valor)
			{
				if(is_array($valor)){
					return $this->_getQtdLinhasEColunas($valor);	
				}
				else
				{
					echo "<br>$valor<br><br>"; 
				}
			}
			
		}
		else
		{
			echo "<br>$valor<br><br>";
		}
		
	}
	
	function _criarElementoCoposto($tipoElemento, $parametros, $conteudo)
	{
		$colspan[][]=$valor;
		$rowspan[][]=$valor;	
	}
	
	function _criarElementoSimples($tipoElemento, $parametros, $conteudo){
		
		if(!is_array($conteudo))
		{
			$resultado = "<$tipoElemento ";
			foreach ($parametros as $parametro => $valor)
			{
				$resultado .= " $parametro='$valor'";	
			}
			$resultado .= ">$conteudo</$tipoElemento>";
			return $resultado;
		}
		else
		{
			
		}
	}
	
	
}