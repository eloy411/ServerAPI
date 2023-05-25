<?php

class Errors{

    public  $num_error;
    public $element;
    public  $severity;
    public $description;
    public $message;
    public  $userMessage;

    public function __construct($error,$element,$userMessage=null){
        $this->defineError($error,$element,$userMessage);
    }


 private function defineError( $error, $element, $userMessage){

        $this->num_error = $error;
        $this->element = $element;
        $this->userMessage = $userMessage;


            switch ($error){
                case 1:
                    $this->severity = 'Higth';
                    $this->element = 'action';
                    $this->description = 'action no se encuentra en la URL';
                    $this->message = 'Error de sistema, consulte con el proveedor del dominio';
                    break;
                case 2:
                    $this->severity = 'Higth';
                    $this->description= $this->element.' no es un parámetro valido';
                    $this->message = 'Error de sistema, consulte con el proveedor del dominio';
                    break;
                case 3:
                    $this->severity = 'Medium';
                    $this->description = 'No se encuentra el parámetro '.$this->element;
                    $this->message = 'Error de sistema, consulte con el proveedor del dominio';
                    break;
                case 4:
                    $this->severity = 'Low';
                    $this->description = $this->element.' no cumple mandatory';
                    $this->message = 'Haga el favor de rellenar el campo';
                    break;
                case 5:
                    $this->severity = 'Low';
                    $this->description = $this->element.' no es del mismo tipo que la config';
                    $this->message = 'Haga el favor de no introducir cosas que no son';
                    break;
                case 6:
                    $this->severity = 'Low';
                    $this->description = $this->element.' no cumple con el minimo de carácteres';
                    $this->message = 'No se acompleje y añada más carácteres';
                    break;
                case 7:
                    $this->severity = 'Low';
                    $this->description = $this->element.' error';
                    $this->message = $this->userMessage ;
                    break;
            }
        }



}

?>