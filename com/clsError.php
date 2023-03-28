<?php

class Errors{

    public int $num_error;
    public string $element;
    public string $severity;
    public string $description;
    public string $message;

    public function __construct($error=null,$element=null){
        $this->defineError($error,$element);
    }


 private function defineError(int $error,string $element){

        $this->num_error = $error;
        $this->element = $element;

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
            }
        }



}

?>