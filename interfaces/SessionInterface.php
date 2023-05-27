<?php


interface SessionInterface {

    
    public function getResponse():array;
    
    public function getCookie():string;
    
    public function generateCookie($guid):void;
    
    public function purgue():void;
}

?>