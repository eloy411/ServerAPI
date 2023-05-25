<?php
class Response{

    
    public static bool $conditionDebug;
    public static string $typeDebug;
    private int $server_id = 411;
    private string $server_time;
    private string $execution_time;
    private string $url;
    private array $arrDataHeader = array();
    private object $response;
    private array $results;
    private $responseSQL;

    public function __construct(bool $debug, string $typeDebug){
       Self::$conditionDebug = $debug;
       Self::$typeDebug = $typeDebug;
    }
    
    static function configDebug(string $text = '', mixed $param):void{

        if(Response::$conditionDebug && Response::$typeDebug == 'config'){
            Self::debug($param,$text);
        }
    }

    static function validationDebug(string $text = '', mixed $param):void{

        if(Response::$conditionDebug && Response::$typeDebug == 'validation'){
            Self::debug($param,$text);
        }
    }

    static function debug($param,$text){

        $text = '<b>'.$text.'</b>';

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
    //--

    public function execute(bool $xsl, array $data, mixed $execution_time, mixed $responseSQL=null){

        $this->responseSQL = $responseSQL;
        $this->results = $data;

        if(!Self::$conditionDebug){

            $obj_xml = new ClsXMLUtils;

            $this->url = ClsRequest::GetUrl();

            $this->url = htmlspecialchars($this->url, ENT_XML1, 'UTF-8');

            $this->server_time = date('Y-m-d H:i:s');

            $this->execution_time = $execution_time;

            
            
            if($xsl){
                header('Content-Type:text/html');
                echo $obj_xml->renderStringToXSL($this->headXML().$this->outputsXML());
            }else{
                header('Content-Type:text/xml');
                echo $obj_xml->renderStringToXML($this->headXML().$this->outputsXML());
            }
            

        }

    }

    private function headXML():string{
        $str = "
        <head>
        <server_id>$this->server_id</server_id>
        <server_time>$this->server_time</server_time>
        <execution_time>$this->execution_time</execution_time>
        <url>$this->url</url>".
        $this->inputsXML().
        $this->errorsXML()
        ."</head>";

        return $str;
    }

    private function inputsXML():string{

        $params = ClsRequest::GetURLParams();
        if(ClsRequest::Exists('action')){
            $action = ClsRequest::GetValue('action');
        }else{
            $action = '';
        }
        
        $str = "<webmethod>
        <name>".$action."</name>
        <parameters>";

            foreach($params as $key => $value){

                $key!='action' && $str.='<parameter>
                <name>'.$key.'</name>
                <value>'.$value.'</value>
                </parameter>';

            }

        $str.="</parameters>
        </webmethod>";

        return $str;
    }

    private function errorsXML():string{
        $str = "<errors>";
        
        foreach( $this->results as $result){ 

            $str.="<error>
            <num_error>".$result->num_error."</num_error>
            <message_error>".$result->description."</message_error>
            <severity>".$result->severity."</severity>
            <user_message>".$result->message."</user_message>
        </error>";
        }

        $str.="</errors>";
        return $str;
    }




    private function outputsXML():string{

        $str="
        <body>
        <response_data>".$this->responseSQL."</response_data>
        </body>
        ";

        return $str;

    }

    private function outputsXML2():string{

        $str="
        <body>
        <response_data></response_data>
        </body>
        ";

        return $str;

    }
}


?>