<?php
require('../vendor/autoload.php');
include_once "./config/systemConfig.php";
include_once "./db/clsConnect.php";
include_once "./db/clsControllerDB.php";
include_once "./securityController/clsUser.php";
include_once "./securityController/clsSession.php";
include_once "./com/clsXMLUtils.php";
include_once "./com/clsParam.php";
include_once "./com/clsMethod.php";
include_once "./com/clsServer_API.php";
include_once "./com/clsRequest.php";
include_once "./com/clsError.php";
include_once "./com/clsResponse.php";
include_once "./securityController/clsSecurityController.php";
include_once "./business_model/clsCart.php";

$time_start = microtime(true);

$response = new Response(false,'config');

$obj_api= new clsServerApi("./xml/dbxml.xml");

$result = $obj_api->Validate();

//EXECUTE/////////////////////////////////////

$obj_segurityController = new SecurityController($result);




$time_end = microtime(true);

////CALCULATE TIME-EXECUTE////////////////////////////////////
$time_exec = $time_end-$time_start;
$time_exec = substr($time_exec,0,-12);

$errors_result =$obj_segurityController->getResult();
$responseSQL = $obj_segurityController->getData();

$response->execute(false,$errors_result,$time_exec,$responseSQL);

// var_dump($responseSQL);


?>