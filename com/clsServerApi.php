<?php


class clsServerApi{

    private string $configfile;
    private $obj_xmlutil;
    private $ArrMethods = array();

    function __construct($configfile){
        $this->obj_xmlutil= new clsXMLUtils;
        $this->configfile=$configfile;
        $this->Init();
    }

    function Init(){
        $this->ReadConfigurationFile();
        $this->ParseWebMethods();
    }

    function ReadConfigurationFile():void{
        $this->obj_xmlutil->ReadFile($this->configfile);
    }


    function ParseWebMethods(){

        $this->obj_xmlutil->ApplyXpath('//web_methods_collection/web_method');
        $arrMethods = $this->obj_xmlutil->getResult();
       
        foreach ($arrMethods as $Method) {
            
            $this->AddMethod($Method);
       
        }
    }

    public function AddMethod(SimpleXMLElement $XMLMethod): void{
        $obj_method= new clsMethod($XMLMethod);
        
        array_push($this->ArrMethods, $obj_method);
       
    }

    function Print(): void{
        echo $this->obj_xmlutil->getXML();

    }
    

    public function Validate(){

        $cont=0;

        if(ClsRequest::Exists('action')){

            $value = ClsRequest::GetValue('action');

                foreach($this->ArrMethods as $method){

                    $result=$method->ValidateAction($value);

                    if(!$result){
                        $cont++;
                    }else{
                        return $result;
                    }
                }
    
                if($cont == count($this->ArrMethods)){
                    return [[2,$value]];
                }
                
        }else{
            return [[1,'action']];
        }
    }

   
    }






?>