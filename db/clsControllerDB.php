<?php

require_once "../interfaces/ControllerDataBaseInterface.php";



class ControllerDB implements ControllerDataBaseInterface{

    private object $pdo;
    private object $procedure;
    public $result;

    function __construct(PDO $pdo){

        $this->pdo = $pdo;
    }


    public function prepareProcedure(string $name_procedure, array $params=[]):void{

        $i = 1;
        $formatParam = '';

        foreach($params as $param){

            $formatParam .= ' ?,'; 
        }

        $formatParam = trim($formatParam,',');

        $this->procedure = $this->pdo->prepare("SET NOCOUNT ON;".$name_procedure.$formatParam.';');

        foreach($params as $param){

            $this->procedure->bindParam($i,$param);
            $i++;
        }

        
    }

    public function executeProcedure(){

        $this->result = $this->procedure->execute();
    }

   function fetchExecutionProcedure(){



   }




}



?>