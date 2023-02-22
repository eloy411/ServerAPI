<?php

class ClsRequest{
    private string $configfile;
    private $obj_xmlutil;
   

    function __construct(){
       
    }
/////////////////////////////////////////////////////
    static function Exists($pParam){
        if (isset($_GET[$pParam])){
            return true;
        }else{
            return false;
        }
    }
/////////////////////////////////////////////////////
    static function GetValue($param){

        if(ClsRequest::Exists($param)){
            return $_GET[$param];}
    }

    static function GetURLParams(){
        return $_GET;
    }
}




?>