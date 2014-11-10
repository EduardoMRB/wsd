<?php

require_once('autoload.php');

class Despesa 
{
	
	private $conexao;
	private $id;
	private $idDespesa;
	private $vencimento;
	private $ano;
	private $mes;
	private $valor;
	private $descricao;
	private $table = 'despesas';
	private $table2 = 'mes_despesa';

	public function __construct(Connection $conexao)
	{
		$this->conexao = $conexao;
	}
	
	public function selectData()
	{
		$sql = "SELECT * FROM " . $this->table . " 
				d LEFT JOIN " . $this->table2 . " m ON (d.ano = m.anoD AND d.mes = m.mesD) GROUP BY ID";

		return $this->conexao->select($sql);
	}

	public function selectById($id)
	{
		$sql = "SELECT * FROM " . $this->table . " 
				d LEFT JOIN " . $this->table2 . " m ON (d.ano = m.anoD AND d.mes = m.mesD) 
				WHERE ID = ".$id." GROUP BY ID";

		return $this->conexao->select($sql);
	}

	public function selectDespesaById($id)
	{
		$sql = "SELECT * FROM " . $this->table . " 
				d LEFT JOIN " . $this->table2 . " m ON (d.ano = m.anoD AND d.mes = m.mesD) 
				WHERE ID = ".$id."";

		return $this->conexao->select($sql);
	}

	public function insertDespesa(Despesa $despesa)
	{
		$total = count($despesa->getDescricao());

		for ($i = 0; $i < $total; $i++) 
		{
			$descricao = $despesa->getDescricao();	

			$sql = "INSERT INTO ". $this->table2 ." (mesD, anoD, descricao) VALUES (:mes, :ano, :descricao)";

			$params = array(
				':mes' => $despesa->getMes(),
				':ano' => $despesa->getAno(),
				':descricao' => $descricao[$i],
			);

			$this->conexao->insert($sql, $params);
		}	

		return true;
	}


	public function insertData(Despesa $despesa)
	{
		$sql = "INSERT INTO " . $this->table . " (mesD, anoD, vencimento, valor) VALUES (:mes, :ano, :vencimento, :valor)";

		$this->insertDespesa($despesa);

		$params = array(
			':mes' => $despesa->getMes(),
			':ano' => $despesa->getAno(),
			':vencimento' => $despesa->getVencimento(),
			':valor' => $despesa->getValor(),
		);

		return ($this->conexao->insert($sql, $params) > 0) ? true : false;
	}

	public function updateDespesas(Despesa $despesa)
	{
		$total = count($despesa->getDescricao());

		for ($i = 0; $i < $total; $i++)
		{
			$idDespesa = $despesa->getIdDespesa();

			$descricao = $despesa->getDescricao();

			$exist = "SELECT idDespesa FROM mes_despesa WHERE idDespesa = :idDespesa";

			$params = array( 'idDespesa' => $idDespesa[$i]);

			// DESPESA JA EXISTE, APENAS ATUALIZA DESCRICAO

			if($this->conexao->select($exist, $params)){

				$sql = "UPDATE ". $this->table2 ." SET mesD = :mes, anoD = :ano, descricao = :descricao WHERE idDespesa = :idDespesa";

				$params = array(
					':mes' => $despesa->getMes(),
					':ano' => $despesa->getAno(),
					':descricao' => $descricao[$i],
					':idDespesa' => $idDespesa[$i],
				);

				$this->conexao->update($sql, $params);

			} else {

				$sql = "INSERT INTO ". $this->table2 ." (mesD, anoD, descricao) VALUES (:mes, :ano, :descricao)";

				$params = array(
					':mes' => $despesa->getMes(),
					':ano' => $despesa->getAno(),
					':descricao' => $descricao[$i],
				);

				$this->conexao->insert($sql, $params);
			}

		} // FOR

		return true;
	}

	public function updateData(Despesa $despesa)
	{
		$sql = "UPDATE ". $this->table ." SET mes = :mes, ano = :ano, vencimento = :vencimento, valor = :valor WHERE ID = :id";

		$this->updateDespesas($despesa);

		$params = array(
			':mes' => $despesa->getMes(),
			':ano' => $despesa->getAno(),
			':vencimento' => $despesa->getVencimento(),
			':valor' => $despesa->getValor(),
			':id' => $despesa->getId()
		);

		return ($this->conexao->update($sql, $params) > 0) ? true : false;
	}

	public function deleteData($id)
	{
		$sql = "DELETE FROM ". $this->table ." WHERE ID = :id";

		$params = array(
			':id' => $id,
		);

		return ($this->conexao->delete($sql, $params) > 0) ? true : false;
	}

	public function deleteDespesa($id)
	{
		$sql = "DELETE FROM ". $this->table2 ." WHERE idDespesa = :id";

		$params = array(
			':id' => $id,
		);

		return ($this->conexao->delete($sql, $params) > 0) ? true : false;
	}

	public function getIdDespesa()
	{
	    return $this->idDespesa;
	}
	
	public function setIdDespesa($idDespesa)
	{
	    $this->idDespesa = $idDespesa;
	}

	public function getId()
	{
	    return $this->id;
	}
	
	public function setId($Id)
	{
	    $this->id = $Id;
	}

	public function getValor()
	{
	    return $this->valor;
	}
	
	public function setValor($Valor)
	{
	    return $this->valor = $Valor;
	}

	public function getVencimento()
	{
	    return $this->vencimento;
	}
	
	public function setVencimento($Vencimento)
	{
	    $this->vencimento = $Vencimento;
	}


	public function getDescricao()
	{
	    return $this->descricao;
	}
	
	public function setDescricao($Descricao)
	{
	    $this->descricao = $Descricao;
	}

	public function getMes()
	{
	    return $this->mes;
	}
	
	public function setMes($Mes)
	{
	    $this->mes = $Mes;
	}

	public function getAno()
	{
	    return $this->ano;
	}
	
	public function setAno($Ano)
	{
	    $this->ano = $Ano;
	}

	

}