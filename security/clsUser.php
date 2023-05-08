<?php


class User{


    private string $pwd;
    private string $name;
    private string $email;

    private object $connect;
    private object $controllerDB;


    function __construct(string $email, string $pwd, string $name){

        $this->name = $name;
        $this->pwd = $pwd;
        $this->email = $email;
    }

    private function userConnectDB():void{

        $this->connect = new ConnectDB();

        $PDO = $connect->getPDODB();

        $this->controllerDB = new ControllerDB($PDO);

    }

    private function userDisconnectDB():void{

        $this->connect->disconnect();

        $this->connect = null;

        $this->controllerDB = null;

    }

    public function register(){

        $this->userConnectDB();

        $this->controllerDB->prepareProcedure('sp_sap_user_register',[$this->email,$this->name,$this->pwd]);
        $this->controllerDB->executeProcedure();
        $this->controllerDB->fetchExecuteProcedure();

        $this->userDisconnectDB();

    }

    public function login(){

        $this->userConnectDB();

        $this->controllerDB->prepareProcedure('sp_sap_user_login',[$this->email,$this->pwd]);
        $this->controllerDB->executeProcedure();
        $this->controllerDB->fetchExecuteProcedure();

        $this->userDisconnectDB();

    }
}

?>