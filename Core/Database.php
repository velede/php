<?php


namespace Core;

use PDO;


class Database{

    public $statement;
    public $connection;

    public function __construct($config, $username = 'root', $password = ''){

        //$dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";

        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn,$username,$password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

    }

    public function query($query, $params = []){



        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;

        //return $statement->fetch(PDO::FETCH_ASSOC);

    }

    public function fetch(){

        return $this->statement->fetch();

    }

    public function find(){
        return $this->statement->fetch();
    }

    public function fetchAll() {
        return $this->statement->fetchAll();
    }

}