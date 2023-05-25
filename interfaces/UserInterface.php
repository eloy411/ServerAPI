<?php

/**
 *  CONSTRUCTOR PARAMS
 * ----------------------------------
 * $this->pwd = $pPwd;
 * $this->name = $pName;
 * $this->email = $pEmail;
 * 
 * 
 *  CLASS PARAMS
 * -----------------------------------
 * $this->cid;
 * $this->connect;
 * $this->controllerDB
 * 
 * 
 * 
 * PRIVATE FUNCTION
 * ----------------------------------
 * userConnectDB(): void;
 * userDisonnectDB():void;
 * register(): void;
 * login(): void;
 * logout(): void;
 * 
 */

interface UserInterface{

public function register(): void;
public function login(): void;

}

?>