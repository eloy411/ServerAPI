<?php

require_once './interfaces/UserInterface.php';

class User implements UserInterface{


    private string $pwd;
    private string $name;
    private string $email;
    private string $cid;
    private object $cart;

    private object | null $connect;
    private object | null $controllerDB;


    function __construct(string $email, string $pwd, string $name){

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
        $this->controllerDB->fetchExecutionProcedure();

        // $this->userDisconnectDB();

    }

    public function login():void{

        $this->userConnectDB();

        $this->controllerDB->prepareProcedure('sp_sap_user_login',[$this->email,$this->pwd]);
        $this->controllerDB->executeProcedure();
        $this->controllerDB->fetchExecutionProcedure();

        $this->userDisconnectDB();

    }

    public function logout():void{

        $this->userConnectDB();

        $this->controllerDB->prepareProcedure('sp_sap_user_logout',[$this->cid]);
        $this->controllerDB->executeProcedure();
        $this->controllerDB->fetchExecutionProcedure();

        $this->cid = null;
        $this->userDisconnectDB();
    }
}

?>


