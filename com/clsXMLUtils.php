<?php
class ClsXMLUtils{
    private $obj_simplexml_base;
    private $result;
    private $error_num;
    
//////////////////////////////////////////////////////////////////////////////
    function __construct(){

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


    public function renderStringToXML(string $info): string {

        $str=<<<XML
        <ws_response>
        $info
        </ws_response>
        XML;
        

        $this->obj_simplexml_base = new SimpleXMLElement($str);

        return  $this->obj_simplexml_base->asXML();
    }
    


   public function renderStringToXSL(string $info): string {

        $str=<<<XML
        <ws_response>
        $info
        </ws_response>
        XML;
        
       $xml = new DOMDocument;
       $xml->loadXML($str);
       
       $xsl = new DOMDocument;
       $xsl->load('./xml/prueba.xslt');

       $proc = new XSLTProcessor;
       $proc->importStyleSheet($xsl);

       return $proc->transformToXML($xml);
    }
    
}

?>