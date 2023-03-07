<?php

class clsMethod{

    private object $objXml;
    private string $description;
    private string $endPoint;
    private object $paramsCollection;
    private string $action;
    private array $paramsList = [];
    public $result = [];

    function __construct($objXML)
    {
        $this->objXml = $objXML;
        $this->description = (string) $this->objXml->description; 
        $this->endPoint = (string) $this->objXml->endpoint;
        $this->paramsCollection = (object) $this->objXml->params_collection;
        $this->Init();
    }


    function Init(){
        $this->ParseWebParams();
    }

    private function ParseWebParams(){
        foreach($this->paramsCollection as $params){

            foreach($params as $param){

                if($param["name"]=='action'){
                    $this->AddAction($param);
                }else{
                    $this->AddParam($param);
                }

            }

        };
    }
   

    function AddParam($data){
        $obj_method = new clsParam($data);
        array_push($this->paramsList,$obj_method);
    }


    function AddAction($data){
        $this->action = $data->default;
    }


    public function ValidateAction($value){
        
        if($value === $this->action){

            foreach($this->paramsList as $param){
                
                    $result = $param->ValidateAttributes();

                    if(is_object($result)){
                        array_push($this->result,$result);
                    }
                    
                }

            return $this->result;
        }

        return false;
        
    }

};

?>