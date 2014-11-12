<?php
namespace WSD\Entity;

use WSD\Connection;
use WSD\Entity\Despesa;
use \StdClass;

class Mes 
{
	
	private $conexao;
	private $id;
	private $vencimento;
	private $valorCondominio;
	private $table = 'mes';
	private $table2 = 'mes_despesa';

	public function __construct(Connection $conexao)
	{
		$this->conexao = $conexao;
	}

	public function selectData()
	{
		$sql = "SELECT * FROM mes";

		return $this->conexao->select($sql);		

	}

	public function selectById($id)
	{
		$sql = "SELECT * FROM " . $this->table . " WHERE ID = ".$id."";

		return $this->conexao->select($sql);
	}
	
	public function insertData(Mes $mes)
	{
		$sql = "INSERT INTO " . $this->table . " (vencimento, valorCondominio) VALUES (:vencimento, :valorCondominio)";

		$params = array(
			':vencimento' => $mes->getVencimento(),
			':valorCondominio' => $mes->getValorCondominio(),
		);

		return $this->conexao->insert($sql, $params);
	}

	public function updateData(Mes $mes)
	{
		$sql = "UPDATE ". $this->table ." SET vencimento = :vencimento, valorCondominio = :valorCondominio WHERE ID = :id";

		$params = array(
			':vencimento' => $mes->getVencimento(),
			':valorCondominio' => $mes->getValorCondominio(),
			':id' => $mes->getId()
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

	public function getId()
	{
	    return $this->id;
	}
	
	public function setId($Id)
	{
	    $this->id = $Id;
	}

	public function getValorCondominio()
	{
	    return $this->valorCondominio;
	}
	
	public function setValorCondominio($Valor)
	{
	    return $this->valorCondominio = $Valor;
	}

	public function getVencimento()
	{
	    return $this->vencimento;
	}
	
	public function setVencimento($Vencimento)
	{
	    $this->vencimento = $Vencimento;
	}

}
