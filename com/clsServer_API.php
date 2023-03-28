<?php
class clsServerApi{

    private string $configfile;
    private object $obj_xmlutil;
    private array $ArrMethods = array();
    private array $arrErrors = array();
    private int $numMethods = 0;

    function __construct($configfile){
 
        $this->obj_xmlutil= new ClsXMLUtils;
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

        $this->numMethods++;

        $obj_method= new clsMethod($XMLMethod);
        
        array_push($this->ArrMethods, $obj_method);

        Response::configDebug(
            'Api con '.$this->numMethods. ' métodos ',
            $this->ArrMethods);
       
    }
    
    public function Validate(){

        $cont=0;

        if(ClsRequest::Exists('action')){

            
            $value = ClsRequest::GetValue('action');

                foreach($this->ArrMethods as $method){

                    $result = $method->ValidateAction($value);

                    if(is_bool($result)){
                        $cont++;
                    }else{
                        $this->arrErrors = array_merge($this->arrErrors,$result);
                    }
                }
    
                if($cont == count($this->ArrMethods)){

                    Response::validationDebug('El action introducido no es válido: ', $value);

                    array_push($this->arrErrors,new Errors(2,$value));
                }

                Response::validationDebug('Ha habido un total de '.count($this->arrErrors).' errores',$this->arrErrors);

                return $this->arrErrors;
                
        }else{

            Response::validationDebug('No existe el action','');

            array_push($this->arrErrors,new Errors(1,'action'));

            return $this->arrErrors;
        }
    }

        
   
    }
