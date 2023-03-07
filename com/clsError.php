<?php

class Errors{

    public $num_error;
    public $element;
    public $severity;
    public $description;

    public function __construct($error=null,$element=null){
        $this->defineError($error,$element);
    }


 private function defineError($error,$element){

        $this->num_error = $error;
        $this->element = $element;

            switch ($error){
                case 1:
                    $this->severity = 'Higth';
                    $this->element = 'action';
                    $this->description = 'no se encuentra en la URL';
                    break;
                case 2:
                    $this->severity = 'Higth';
                    $this->description= 'no es un parámetro valido';
                    break;
                case 3:
                    $this->severity = 'Medium';
                    $this->description = 'no se encuentra en la url';
                    break;
                case 4:
                    $this->severity = 'Low';
                    $this->description = 'no cumple mandatory';
                    break;
                case 5:
                    $this->severity = 'Low';
                    $this->description = 'no es del mismo tipo que la config';
                    break;
                case 6:
                    $this->severity = 'Low';
                    $this->description = 'no cumple con el minimo de carácteres';
                    break;
            }
        }



}

?>