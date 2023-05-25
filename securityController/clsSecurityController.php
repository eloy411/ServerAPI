<?php


class SecurityController{

    private string $action;
    private array $params;
    private array $result = [];
    private array | object $response;
    private object $xml;
    private string $data = 'not Data';
    private $cookies;

    public function __construct($result){

        if(count($result) == 0){
            $this->params = ClsRequest::GetURLParams();
            $this->action = $this->params['action'];
            $this->routes();
        }else{
           $this->result = $result;
        }

    }


    private function routes(){
 
        switch ($this->action){

            case 'login':  
                $user = new User($this->params["email"],$this->params["pwd"]);
                $user->login();
                $this->response = $user->getResponse();
                $this->parseResponse(7,'Login');
                break;
            case 'register':
      
                $user = new User($this->params["email"],$this->params["pwd"],$this->params['name']);
                $user->register();
                $this->response = $user->getResponse();
                $this->parseResponse(7,'Register');
                break;
            case 'logout':
                $session = new Session($params['cid']);
                $session->logout();
                break;
        }

    }

    private function parseResponse($errorNumber,$type){

        $xml = new SimpleXMLElement('<root/>');
        foreach ($this->response as $row) {
            foreach ($row as $key => $value) {
                $xml->addChild($key, $value);
            }
        }
        
        $xmlString = $xml->asXML();

        $corrected_xml = html_entity_decode($xmlString);

        $parsed = new SimpleXMLElement($corrected_xml);

        $error = $parsed->xpath('//error');

        if($error[0]=='1'){

            $message =  $parsed->xpath('//message');
            $msg =(string) $message[0];
            
            array_push($this->result,new Errors($errorNumber,$type,$msg));

        }else{

            $this->data='';
            foreach($parsed as $value){
                
                foreach ($value as $val) {
                    
                    foreach($val as $key=>$value){

                        if($key!='error'){
                            $this->data.='<'.$key.'>'.$value.'</'.$key.'>';
                        };
                        if($key == 'conn_guid'){
                            $session = new Session();
                            $session->setCookie($value);
                        }
                    }
                }
            }


        };

}



    public function getResult(){
        return $this->result;
    }

    public function getData(){
        return $this->data;
    }
}





?>