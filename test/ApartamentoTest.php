<?php
namespace WSD\Test;

use WSD\Entity\Apartamento;
use \Mockery as M;

class ApartamentoTest extends \PHPUnit_Framework_TestCase 
{
    public function setUp()
    {
        $this->connectionMock = M::mock('WSD\\Connection');
    }

    public function testCalculaSaldo()
    {
        $this->markTestSkipped();
        $apartamento = new Apartamento($this->connectionMock);
        $apartamento->setSaldo(300);
        $novoSaldo = $apartamento->calculaSaldo(600, $apartamento);
        $this->assertEquals(900, $novoSaldo);
    }

    public function testInsertData()
    {

        $apartamento = new Apartamento($this->connectionMock);
        $apartamento->setMorador('Bruna marquezine');
        $apartamento->setNumero(102);
        $apartamento->setSaldo(500);
        $apartamento->setMeses('Janeiro, Fevereiro');

        $this->connectionMock->shouldReceive('insert')
            ->with(M::type('string'), M::type('array'))
            ->andReturn(1)
            ->once()
            ->getMock();
        $this->assertTrue($apartamento->insertData($apartamento));
    } 

    public function testMostrarDados(){

        $apartamento = new Apartamento($this->connectionMock);
        $apartamento->setMorador('Bruna marquezine');
        $apartamento->setNumero(102);
        $apartamento->setSaldo(500);
        $apartamento->setMeses('Janeiro, Fevereiro');
        $apartamento->setId(1);

        $this->assertEquals($apartamento->getMorador(), 'Bruna marquezine');
        $this->assertEquals($apartamento->getNumero(), 102);
        $this->assertEquals($apartamento->getSaldo(), 500);
        $this->assertEquals($apartamento->getId(), 1); 

    }

    public function testUpdateData()
    {
        $apartamento = new Apartamento($this->connectionMock);
        $apartamento->setMorador('Bruna marquezine');
        $apartamento->setNumero(102);
        $apartamento->setSaldo(500);
        $apartamento->setMeses('Janeiro, Fevereiro');
        $apartamento->setId(1);

        $this->connectionMock->shouldReceive('update')
            ->with(M::type('string'), M::type('array'))
            ->andReturn(1)
            ->once()
            ->getMock();
        $this->assertTrue($apartamento->updateData($apartamento));	 
    }

    public function testDeleteData()
    {
        $apartamento = new Apartamento($this->connectionMock);
        $apartamento->setId(1);

        $this->connectionMock->shouldReceive('delete')
            ->with(M::type('string'), M::type('array'))
            ->andReturn(1)
            ->once()
            ->getMock();
        $this->assertTrue($apartamento->deleteData($apartamento));	 
    }

    public function testSelectData()
    {
        $apartamento = new Apartamento($this->connectionMock);

        $this->connectionMock->shouldReceive('select')
            ->with(M::type('string'))
            ->andReturn(true)
            ->once()
            ->getMock();
        $this->assertTrue($apartamento->selectData($apartamento));	 
    }
}
