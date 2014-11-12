<?php
namespace WSD;

use \PDO;
use WSD\Config\ConfigContainer;

class Connection
{
    /**
     * @var ConfigContainer
     */
    private $container;
    
    public function __construct(ConfigContainer $container)
    {
        $this->container = $container;
    }
    
    public function connect()
    {
        try
        {
            $params = $this->container->getDBParams();
            $dsn = sprintf("%s:host=%s;dbname=%s", $params['adapter'], $params['host'], $params['database']);
            $this->conexao = new PDO($dsn, $params['user'], $params['pass']);
        }
        catch (PDOException $i)
        {
            //se houver exceção, exibe
            echo ("Erro: <code>" . $i->getMessage() . "</code>");
        }

        return ($this->conexao);
    }

    public function disconnect()
    {
        $this->conexao = null;
    }

    /*Método select que retorna um VO ou um array de objetos*/
    public function select($sql,$params=null,$class=null){
        $query=$this->connect()->prepare($sql);
        $query->execute($params);

        if ($query->rowCount() > 0)
            $rs = $query->fetchAll(PDO::FETCH_OBJ) or die(print_r($query->errorInfo(), true));
        else
            $rs = false;

        self::disconnect();
        return $rs;
    }

    /*Método insert que insere valores no banco de dados e retorna o último id inserido*/
    public function insert($sql,$params=null){
        $conexao=$this->connect();
        $query=$conexao->prepare($sql);
        $query->execute($params);
        $rs = $conexao->lastInsertId() or die(print_r($query->errorInfo(), true));
        self::disconnect();
        return $rs;
    }

    /*Método update que altera valores do banco de dados e retorna o número de linhas afetadas*/
    public function update($sql,$params=null){
        $query=$this->connect()->prepare($sql);
        $query->execute($params);
        if ($query->rowCount() > 0)
            $rs = $query->rowCount() or die(print_r($query->errorInfo(), true));
        else
            $rs = true;
        self::disconnect();
        return $rs;
    }

    /*Método delete que excluí valores do banco de dados retorna o número de linhas afetadas*/
    public function delete($sql,$params=null){
        $query=$this->connect()->prepare($sql);
        $query->execute($params);
        $rs = $query->rowCount() or die(print_r($query->errorInfo(), true));
        self::disconnect();
        return $rs;
    }

}

