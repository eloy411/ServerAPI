<?php

class clsParam{

    public $name;
    public $type;
    public $mandatory;
    public $min_length;
    private $paramInfo;

    function __construct($params) {
        $this -> paramInfo = $params;

        $this -> getAtributtes();
    }

    private function getAtributtes(){
        $this -> name = $this -> paramInfo -> xpath('@name');
        $this->name =(string)$this->name[0]["name"];
    
        foreach($this->paramInfo as $key => $value) {
            switch ($key) {
                case 'type':
                    $this -> type = $value;
                    break;      
                case 'mandatory':
                    $this -> mandatory = $value;
                    break;
                case 'min_length':
                    $this -> min_length = $value;
                    break;
            }
        }
        
    }

    public function ValidateAttributes(){

        if(ClsRequest::Exists($this->name)){

            $value = ClsRequest::GetValue($this->name);

            if($this->mandatory == 'yes'){
                if($value == ''){
                    Response::validationDebug('El siguiente parámetro no cumple con mandatory: ',$this->name);                    
                    return new Errors(4,$this->name);
                }
            }
    
            if(gettype($value) != $this->type){

                    Response::validationDebug('El siguiente parámetro no cumple con el tipo de valor: ',$this->name);    
                    return new Errors(5,$this->name);
            }
    
            if(strlen($value) < (int)$this->min_length){

                    Response::validationDebug('El siguiente parámetro no cumple con el mínimo de longitud: ',$this->name);   
                    return new Errors(6,$this->name);
            }
    
            return 0;
        }

        Response::validationDebug('El siguiente parámetro no existe:',$this->name);

        return new Errors(3,$this->name);
    }

}


?>