<?php

class clsParam{

    public $name;
    public $type;
    public $mandatory;
    public $default;
    public $min_length;
    private $paramInfo;

    function __construct($params) {
        $this -> paramInfo = $params;
        $this -> getParam();
    }

    private function getParam(){
        $this -> name = $this -> paramInfo -> xpath('@name');
        $this->name =(string)$this->name[0]["name"];

        $result = $this->paramInfo;
    
        foreach($result as $key => $value) {
            switch ($key) {
                case 'type':
                    $this -> type = $value;
                    break;      
                case 'mandatory':
                    $this -> mandatory = $value;
                    break;
                case 'default':
                    $this -> default = $value;
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
                    return [4,$this->name];
                }
            }
    
            if(gettype($value) != $this->type){
                return [5,$this->name];
  
            }
    
            if(strlen($value) < (int)$this->min_length){
                return [6,$this->name];
   
            }
    
            return [0,$this->name];
        }

       return [3,$this->name];
    }

}


?>