<?php
require('../vendor/autoload.php');
include_once "./config/systemConfig.php";
include_once "./db/clsConnect.php";
include_once "./db/clsControllerDB.php";
include_once "./security/clsUser.php";
include_once "./com/clsXMLUtils.php";
include_once "./com/clsParam.php";
include_once "./com/clsMethod.php";
include_once "./com/clsServer_API.php";
include_once "./com/clsRequest.php";
include_once "./com/clsError.php";
include_once "./com/clsResponse.php";

$time_start = microtime(true);

$response = new Response(false,'validation');

$obj_api= new clsServerApi("./xml/dbxml.xml");

$result = $obj_api->Validate();

$time_end = microtime(true);

////CALCULATE TIME-EXECUTE////////////////////////////////////
$time_exec = $time_end-$time_start;
$time_exec = substr($time_exec,0,-12);
//EXECUTE/////////////////////////////////////

$obj_connect=new ConnectDB;

$obj_connect->connectON();
// $response->execute(true,$result,$time_exec)



//GIT
?>