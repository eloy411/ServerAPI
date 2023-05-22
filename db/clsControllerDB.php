<?php

require_once "./interfaces/ControllerDataBaseInterface.php";



class ControllerDB implements ControllerDataBaseInterface{

    private object | null $pdo;
    private object $procedure;
    public $result;

    function __construct(PDO $pdo){

        $this->pdo = $pdo;
    }


    public function prepareProcedure(string $name_procedure, array $params=[]):void{

        $formatParam = '';

        foreach($params as $param){

            $formatParam .= ' ?,'; 
        }

        
        $formatParam = trim($formatParam,',');
        
        $this->procedure = $this->pdo->prepare($name_procedure.$formatParam.';');

        foreach($params as $index => $value){

            $this->procedure->bindParam(($index+1),$params[$index]);
            
        }

        
    }

    public function executeProcedure():void{
        try {
            $this->procedure->execute();
            
        } catch (PDOException $e) {
            echo "Información adicional: " . $e->errorInfo;
            echo "Error al ejecutar el procedimiento almacenado: " . $e->getMessage();
            //throw $th;
        }
    }
    

    public function fetchExecutionProcedure():void{

            $response = $this->procedure->fetchAll(PDO::FETCH_ASSOC); 
            var_dump($response);

   }




}



?>