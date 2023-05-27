<?php


interface CartInterface {

    public function addToCart(): void;

    public function dropFromCart():void;

    public function getCart():void;

    public function getResponse():array;

}

?>