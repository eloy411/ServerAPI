<?php

class ControlErrors{

    private $listErrors = [];
    public $listDefined = [];

    function __construct($errors){
        $this->listErrors = $errors;
        $this->iteryErrors();
    }


    public function iteryErrors(){
        
        foreach ($this->listErrors as $error) {
            $this->defineError($error);
        }
    }

    private function defineError($error){

            switch ($error[0]){
                case 0:
                    array_push($this->listDefined,$error[1],true);
                    break;
                case 1:
                    array_push($this->listDefined,['action','no se encuentra en la URL']);
                    break;
                case 2:
                    array_push($this->listDefined,[$error[1],'no se encuentra en la configuración de la API papi']);
                    break;
                case 3:
                    array_push($this->listDefined,[$error[1],'no se encuentra en la url']);
                    break;
                case 4:
                    array_push($this->listDefined,[$error[1],'no cumple mandatory']);
                    break;
                case 5:
                    array_push($this->listDefined,[$error[1],'no es del mismo tipo que la config']);
                    break;
                case 6:
                    array_push($this->listDefined,[$error[1],'no cumple con el minimo de carácteres']);
                    break;
            }
        }
        
}








?>