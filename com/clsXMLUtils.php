<?php

class ClsXMLUtils{
    private $obj_simplexml_base;
    private $result;
    private $error_num;
    
//////////////////////////////////////////////////////////////////////////////
    function __construct(){
        //echo "-> clsXMLUtils constructor";
    }
//////////////////////////////////////////////////////////////////////////////
    public function ReadFile(string $pURL):bool {
        $this->obj_simplexml_base=simplexml_load_file($pURL);
        $this->result= $this->obj_simplexml_base;
        return true;
    }

    public function WriteXMLFile($pFilePath, $pXML):void{
        $f=fopen($pFilePath,"w");
        fwrite($f, $pXML);
        fclose($f);
    }
//////////////////////////////////////////////////////////////////////////////
    public function getXML(): string{
        return $this->result->asXML();
    }
//////////////////////////////////////////////////////////////////////////////
    public function ApplyXPath(string $pPath):bool{

        $arr=$this->obj_simplexml_base->xpath($pPath);
        $this->result=$this->arraytoXML($arr);
        return true;
    }
//////////////////////////////////////////////////////////////////////////////

public function ApplyXPath2(string $pPath,object $pXML):bool{

    $arr=$pXML->xpath($pPath);
    $this->result=$this->arraytoXML($arr);
    return true;
}
//////////////////////////////////////////////////////////////////////////////
    public function arraytoXML(array $pArr){     
        $str=$this->arraytoXMLString( $pArr);
        return simplexml_load_string($str);
    }
//////////////////////////////////////////////////////////////////////////////
    private function arraytoXMLString(array $pArr) : string{
        $str="<xpath_result>";
        foreach($pArr as $n){
            $str=$str . $n->asXML();
        }
        $str=$str . "</xpath_result>";
        return $str;
    }
//////////////////////////////////////////////////////////////////////////////

    public function getResult(){
        return $this->result;
    }

//////////////////////////////////////////////////////////////////////////////


    public function headXML(array $info) {

        $str = "<? xmlversion='1.0' encoding='UTF-8'?><movies>hola</movies>";
        // $xmlHeader = <<<XML 
       
        //     <head>
        //         <server_id>$info[0]</server_id>
        //         <server_time>$info[1]</server_time>
        //         <execution_time>$info[2]</execution_time>
        //         <url>$info[3]</url>
        //     </head>
        // XML;

        $xmlDoc = new DOMDocument();

        $root = $xmlDoc->appendChild($xmlDoc->createElement('ws_response'));
        $head = $xmlDoc->createElement('head');
        $serId =  $xmlDoc->createElement('server_id',$info[0]);
        $serTime = $xmlDoc->createElement('server_time',$info[1]);
        $execTime = $xmlDoc->createElement('execution_time',$info[2]);
        $url = $xmlDoc->createElement('url',$info[3]);

        $head->append($serId,$serTime,$execTime,$url);
        $root->appendChild($head);

        return $xmlDoc;
    }
    
    static function errorXML(){

    }

    static function responseXML(){

    }

}

?>