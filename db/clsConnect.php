<?php

include_once "./interfaces/ConnectionDbInterface.php";

class ConnectDB implements ConnectionDbInterface{


    private object | null $pdo ;

    function __construct()
    {
        $this->initConnection();
    }

    public function getPDODB(): PDO {
        return $this->pdo;
    }

    public function initConnection(): void  {
        $this->pdo = new PDO(
            "sqlsrv:Server=".
            $_ENV['DDBB_HOST'].",".
            $_ENV['DDBB_PORT'].
            ";Database=".$_ENV['DDBB_DATABASE'], 
            $_ENV['DDBB_USER'],
            $_ENV['DDBB_PASSWORD']
        );
    }

    public function disconnect():void{

        $this->pdo = null;

    }


}

?>