<?php

class ClsRequest{
    private string $configfile;
    private $obj_xmlutil;
   

    function __construct(){
       
    }
/////////////////////////////////////////////////////
    static function Exists(string $pParam):bool{
        if (isset($_GET[$pParam])){
            return true;
        }else{
            return false;
        }
    }
/////////////////////////////////////////////////////
    static function GetValue(string $param):string{

            return $_GET[$param];
    }


    static function GetUrl():string{
        $url = 'http://';
        $url.= $_SERVER['HTTP_HOST'];
        $url.= $_SERVER['REQUEST_URI'];  
        return $url;
    }
    static function GetURLParams():array{
        return $_GET;
    }
}




?>