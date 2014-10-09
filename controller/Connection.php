<?php

/**
* 
*/
class Connection
{
	private static $dbtype   = "mysql";
    private static $host     = "localhost";
    private static $port     = "3306";
    private static $user     = "root";
    private static $password = "q1w2e3";
    private static $db       = "apptest";
     
    /*Metodos que trazem o conteudo da variavel desejada
    @return   $xxx = conteudo da variavel solicitada*/
    private function getDBType()  {return self::$dbtype;}
    private function getHost()    {return self::$host;}
    private function getPort()    {return self::$port;}
    private function getUser()    {return self::$user;}
    private function getPassword(){return self::$password;}
    private function getDB()      {return self::$db;}

	public function connect()
	{
        try
        {
            $dsn = sprintf("%s:host=%s;dbname=%s", $this->getDBType(), $this->getHost(), $this->getDB());
            $this->conexao = new PDO($dsn, $this->getUser(), $this->getPassword());
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
         
        if(isset($class)){
            $rs = $query->fetchAll(PDO::FETCH_CLASS,$class) or die(print_r($query->errorInfo(), true));
        }else{
            $rs = $query->fetchAll(PDO::FETCH_OBJ) or die(print_r($query->errorInfo(), true));
        }
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
        $rs = $query->rowCount() or die(print_r($query->errorInfo(), true));
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

