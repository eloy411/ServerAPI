<?php

class Response{

    private int $server_id = 411;
    private string $server_time;
    private string $execution_time;
    private string $url;
    private array $arrDataHeader = array();
    // private $templateError;
    // private $templateResponse;

    public function __construct(bool $debug , array $data, string $execution_time){

        $this->execution_time = $execution_time;
        $this->server_time =  date("Y/m/d");
        $this->data = $data;
        $debug ? $this->debug() : $this->execute();

    }

    private function debug():void{

        print_r($this->data);

    }

    private function execute(){

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