<?php

class clsMethod{

    private object $objXml;
    private string $description;
    private string $endPoint;
    private object $paramsCollection;
    private string $action;
    private int $numParams = 0;
    private array $paramsList = [];
    public $result = [];

    function __construct($objXML)
    {
        $this->objXml = $objXML;
        $this->description = (string) $this->objXml->description; 
        $this->endPoint = (string) $this->objXml->endpoint;
        $this->paramsCollection = (object) $this->objXml->params_collection;

        Response::configDebug('End-Point', $this->endPoint);
        Response::configDebug('Description', $this->description);
        Response::configDebug('Objeto XML', $this->paramsCollection);

        $this->Init();
    }


    function Init(){
        $this->ParseWebParams();
    }

    private function ParseWebParams():void{
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
   

    function AddParam(object $data){
        $this->numParams++;

        $obj_method = new clsParam($data);
        array_push($this->paramsList,$obj_method);

        Response::configDebug(
            'parametros añadidos ' .$this->numParams,
            $this->paramsList
        );
    }


    function AddAction(object $data){

        $this->action = $data->default;

        Response::configDebug(
            'Action method',
            $this->action
        );
    }


    public function ValidateAction(string $value){
        
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