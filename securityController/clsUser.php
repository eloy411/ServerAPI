<?php

require_once './interfaces/UserInterface.php';

class User implements UserInterface{


    private string | null $pwd;
    private string | null $name;
    private string | null $email;
    private string | null $cid;
    private object | null $cart;

    private array  | null $xmlResponse;
    private object | null $connect;
    private object | null $controllerDB;


    function __construct(string $email = null, string $pwd = null, string $name = null){

        $this->email = $email;
        $this->pwd = $pwd;
        $this->name = $name;
    }

    private function userConnectDB():void{

        $this->connect = new ConnectDB();

        $PDO = $this->connect->getPDODB();

        $this->controllerDB = new ControllerDB($PDO);

    }

    private function userDisconnectDB():void{

        $this->connect->disconnect();

        $this->connect = null;

        $this->controllerDB = null;

    }

    public function register():void{

        $this->userConnectDB();

        $this->controllerDB->prepareProcedure('sp_sap_user_register',[$this->email,$this->pwd,$this->name]);
        $this->controllerDB->executeProcedure();
        $this->xmlResponse = $this->controllerDB->fetchExecutionProcedure();

        $this->userDisconnectDB();

    }

    public function login():void{
       
        $this->userConnectDB();

        $this->controllerDB->prepareProcedure('sp_sap_user_login',[$this->email,$this->pwd]);
        $this->controllerDB->executeProcedure();
        $this->xmlResponse = $this->controllerDB->fetchExecutionProcedure();
        
        $this->userDisconnectDB();

    }

    public function getResponse():array{
        return $this->xmlResponse;
    }

}

?>