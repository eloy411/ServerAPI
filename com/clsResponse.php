<?php

class Response{

    
    public static bool $condition;
    public static string $typeDebug;
    private int $server_id = 411;
    private string $server_time;
    private string $execution_time;
    private string $url;
    private array $arrDataHeader = array();
    // private $templateError;
    // private $templateResponse;

    public function __construct(bool $debug, string $typeDebug){
       Self::$condition = $debug;
       Self::$typeDebug = $typeDebug;
    }
    
    static function configDebug(string $text = '', mixed $param):void{

        if(Response::$condition && Response::$typeDebug == 'config'){
            Self::debug($param,$text);
        }
    }

    static function validationDebug(string $text = '', mixed $param):void{

        if(Response::$condition && Response::$typeDebug == 'validation'){
            Self::debug($param,$text);
        }
    }

    static function debug($param,$text){
        switch (gettype($param)){
            case 'array':
                echo $text;
                echo '<br>';
                echo '<br>';
                print_r($param);
                echo '<br>';
                echo '<br>';
                break;
            case 'string':
                echo $text;
                echo '<br>';
                echo '<br>';
                echo $param;
                echo '<br>';
                echo '<br>';
                break;
            case 'object':
                echo $text;
                echo '<br>';
                echo '<br>';
                var_dump($param);
                echo '<br>';
                echo '<br>';
                break;
            }
    }

    public function execute( array $data, string $execution_time){

        $obj_xml = new ClsXMLUtils;
        
        $this->url = ClsRequest::GetUrl();

        array_push($this->arrDataHeader,$this->server_id,$this->server_time,$this->execution_time,$this->url);

        echo $obj_xml->headXML($this->arrDataHeader)->asXML();

        if(count($this->data) == 0){

            $urlParams = ClsRequest::GetURLParams();

        }else{
         
            ClsXMLUtils::errorXML('');
        }
        
    }


}


?>