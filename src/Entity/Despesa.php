<?php
namespace WSD\Entity;

use WSD\Connection;

class Despesa 
{
	
	private $conexao;
	private $idDespesa;
	private $idMesRef;
	private $valor;
	private $descricao;
	private $table = 'mes';
	private $table2 = 'mes_despesa';

	public function __construct(Connection $conexao)
	{
		$this->conexao = $conexao;
	}
	
	public function selectDespesaById($id)
	{
		$sql = "SELECT * FROM " . $this->table . " 
				mes INNER JOIN " . $this->table2 . " despesa ON (mes.ID = despesa.idMesRef) 
				WHERE ID = ".$id."";

		return $this->conexao->select($sql);
	}

	public function insertDespesa(Despesa $despesa)
	{
		$total = count($despesa->getDescricao());

		$valor = $despesa->getValor();

		$descricao = $despesa->getDescricao();	

		for ($i = 0; $i < $total; $i++) 
		{
			if ($descricao[$i] != '' || $valor[$i] != ''){

				$sql = "INSERT INTO ". $this->table2 ." (descricao, valor, idMesRef) VALUES (:descricao, :valor, :idMesRef)";

				$params = array(
					':valor' => $valor[$i],
					':idMesRef' => $despesa->getIdMesRef(),
					':descricao' => $descricao[$i],
				);

				$this->conexao->insert($sql, $params);
			}	
		}	

		return true;
	}


	public function updateData(Despesa $despesa)
	{
		$total = count($despesa->getDescricao());

		$idDespesa = $despesa->getIdDespesa();

		$descricao = $despesa->getDescricao();

		$valor = $despesa->getValor();

		for ($i = 0; $i < $total; $i++)
		{
			$exist = "SELECT idDespesa FROM ". $this->table2 ." WHERE idDespesa = :idDespesa";

			$params = array( 'idDespesa' => $idDespesa[$i]);

			// DESPESA JA EXISTE, APENAS ATUALIZA DESCRICAO

			if($this->conexao->select($exist, $params)){

				$sql = "UPDATE ". $this->table2 ." SET valor = :valor, idMesRef = :idMesRef, descricao = :descricao WHERE idDespesa = :idDespesa";

				$params = array(
					':valor' => $valor[$i],
					':idMesRef' => $despesa->getIdMesRef(),
					':descricao' => $descricao[$i],
					':idDespesa' => $idDespesa[$i],
				);

				$this->conexao->update($sql, $params);

			} else {

				$sql = "INSERT INTO ". $this->table2 ." (descricao, valor, idMesRef) VALUES (:descricao, :valor, :idMesRef)";

				$params = array(
					':valor' => $valor[$i],
					':idMesRef' => $despesa->getIdMesRef(),
					':descricao' => $descricao[$i],
				);

				$this->conexao->insert($sql, $params);
			}

		} // FOR

		return true;
	}

	public function deleteData($id)
	{
		$sql = "DELETE FROM ". $this->table2 ." WHERE idMesref = :id";

		$params = array(
			':id' => $id,
		);

		return ($this->conexao->delete($sql, $params) > 0) ? true : false;
	}

	public function deleteById($id)
	{
		$sql = "DELETE FROM ". $this->table2 ." WHERE idDespesa = :id";

		$params = array(
			':id' => $id,
		);

		return ($this->conexao->delete($sql, $params) > 0) ? true : false;
	}

	public function getIdMesRef()
	{
	    return $this->idMesRef;
	}
	
	public function setIdMesRef($idMesRef)
	{
	    $this->idMesRef = $idMesRef;
	}

	public function getIdDespesa()
	{
	    return $this->idDespesa;
	}
	
	public function setIdDespesa($idDespesa)
	{
	    $this->idDespesa = $idDespesa;
	}

	public function getValor()
	{
	    return $this->valor;
	}
	
	public function setValor($Valor)
	{
	    return $this->valor = $Valor;
	}

	public function getDescricao()
	{
	    return $this->descricao;
	}
	
	public function setDescricao($Descricao)
	{
	    $this->descricao = $Descricao;
	}

}
