<?php
namespace WSD\Entity;

use WSD\Connection;

class Apartamento 
{
	
	private $numero;
	private $saldo;
	private $morador;
	private $meses;
	private $id;
	private $conexao;

	public function __construct(Connection $conexao)
	{
		$this->conexao = $conexao;
	}
	
	public function selectData()
	{
		$sql = "SELECT * FROM apartamento";

		return $this->conexao->select($sql);
	}

	public function editData($id)
	{
		$sql = "SELECT * FROM apartamento WHERE id_apartamento = ".$id." ";

		return $this->conexao->select($sql);
	}

	public function insertData(Apartamento $apartamento)
	{
		$sql = "INSERT INTO apartamento (morador, numero, saldo, meses_devedores) VALUES (:morador,:numero, :saldo, :meses)";

		$params = array(
			':morador' => $apartamento->getMorador(),
			':numero' => $apartamento->getNumero(),
			':saldo' => $apartamento->getSaldo(),
			':meses' => $apartamento->getMeses(),
		);

		return ($this->conexao->insert($sql, $params) > 0) ? true : false;
	}

	public function updateData(Apartamento $apartamento)
	{
		$sql = "UPDATE apartamento SET morador = :morador, numero = :numero, saldo = :saldo, meses_devedores = :meses WHERE id_apartamento = :id_apartamento";

		$params = array(
			':morador' => $apartamento->getMorador(),
			':numero' => $apartamento->getNumero(),
			':saldo' => $apartamento->getSaldo(),
			':meses' => $apartamento->getMeses(),
			':id_apartamento' => $apartamento->getId()
		);

		return ($this->conexao->update($sql, $params) > 0) ? true : false;
	}

	public function deleteData($id)
	{
		$sql = "DELETE FROM apartamento WHERE id_apartamento = :id_apartamento";

		$params = array(
			':id_apartamento' => $id,
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

	public function getNumero()
	{
	    return $this->numero;
	}
	
	public function setNumero($numero)
	{
	    $this->numero = $numero;
	}

	public function getSaldo()
	{
	    return $this->saldo;
	}
	
	public function setSaldo($saldo)
	{
	    $this->saldo = $saldo;
	}

	public function getMorador()
	{
	    return $this->morador;
	}
	
	public function setMorador($morador)
	{
	    $this->morador = $morador;
	}

	public function getMeses()
	{
	    return $this->meses;
	}
	
	public function setMeses($meses)
	{
	    $this->meses = $meses;
	}
}

