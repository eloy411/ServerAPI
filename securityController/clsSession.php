<?php

/*
    Use the static method getInstance to get the object.
*/

class Session
{
    private array  | null $xmlResponse;
    private object | null $connect;
    private object | null $controllerDB;
    private string | array $cookie;


    private function sessionConnectDB():void{

        $this->connect = new ConnectDB();

        $PDO = $this->connect->getPDODB();

        $this->controllerDB = new ControllerDB($PDO);

    }

    private function sessionDisconnectDB():void{

        $this->connect->disconnect();

        $this->connect = null;

        $this->controllerDB = null;

    }

    public function logout():void{

        $this->sessionConnectDB();

        $this->getCookie();
        $this->controllerDB->prepareProcedure('sp_sap_user_logout',[$this->cookie]);
        $this->controllerDB->executeProcedure();
        $this->controllerDB->fetchExecutionProcedure();

        $this->cid = null;
        $this->sessionDisconnectDB();
    }

    public function getResponse():array{
        return $this->xmlResponse;
    }

    public function getCookie(){
        $this->cookie = $_COOKIE['tokenID'];
    }

    public function setCookie($guid){
        setcookie("tokenID", $guid, time() - 86400 );
        header('Set-Cookie: tokenID=' . urlencode($guid) . '; expires=' . gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT; path=/');
    }
    

}



?>