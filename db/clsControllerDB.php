<?php

require_once "./interfaces/ControllerDataBaseInterface.php";



class ControllerDB implements ControllerDataBaseInterface{

    private object | null $pdo;
    private object $procedure;
    public $result;
  

    function __construct(PDO $pdo){

        $this->pdo = $pdo;
    }

    public function prepareProcedure(string $name_procedure, array $params = []): void {
        
        $formatParam = '';
    
        foreach ($params as $param) {
            $formatParam .= ' ?,';
        }
    
        $formatParam = trim($formatParam, ',');
  
  
        $sql = "{CALL $name_procedure($formatParam)}";

        $this->procedure = $this->pdo->prepare($sql);
  

        foreach ($params as $index => $value) {
            $this->procedure->bindParam(($index+1),$params[$index]);
        }
    }

    public function executeProcedure():void{

            
        $this->procedure->execute();    
  
    }
    

    public function fetchExecutionProcedure():array{

        if($this->procedure->rowCount()===1){
            $this->procedure->nextRowset();
        }
        $this->response = $this->procedure->fetchAll(PDO::FETCH_ASSOC);
 
        return $this->response;
   }




}



?>