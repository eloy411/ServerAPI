<?php

class Cart{

    
    public $quantity;
    public $guid;
    public $product;

    private array  | null $xmlResponse;
    private object | null $connect;
    private object | null $controllerDB;


    function __construct($product=null,$guid=null,$quantity=null){

        $this->quantity = $quantity;
        $this->product = $product;
        $this->guid = $guid;
    }

    private function cartConnectDB():void{

        $this->connect = new ConnectDB();

        $PDO = $this->connect->getPDODB();

        $this->controllerDB = new ControllerDB($PDO);

    }

    private function cartDisconnectDB():void{

        $this->connect->disconnect();

        $this->connect = null;

        $this->controllerDB = null;

    }

    public function addToCart(){

        $this->cartConnectDB();
        $this->controllerDB->prepareProcedure('sp_add_to_cart',[$this->product,$this->guid,$this->quantity]);
        $this->controllerDB->executeProcedure();
        $this->xmlResponse = $this->controllerDB->fetchExecutionProcedure();


        $this->cartDisconnectDB();
    }

    
    public function dropFromCart(){
        
        $this->cartConnectDB();
        $this->controllerDB->prepareProcedure('sp_drop_from_cart',[$this->product,$this->guid]);
        $this->controllerDB->executeProcedure();
        $this->xmlResponse = $this->controllerDB->fetchExecutionProcedure();
        $this->cartDisconnectDB();
    }

    
    public function getCart(){
        
        $this->cartConnectDB();
        $this->controllerDB->prepareProcedure('sp_get_cart',[$this->guid]);
        $this->controllerDB->executeProcedure();
        $this->xmlResponse = $this->controllerDB->fetchExecutionProcedure();
        $this->cartDisconnectDB();
    }

    public function getResponse(){
        return $this->xmlResponse;
    }


}

?>