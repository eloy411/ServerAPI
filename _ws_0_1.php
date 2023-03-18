<?php
include_once "./com/clsXMLUtils.php";
include_once "./com/clsParam.php";
include_once "./com/clsMethod.php";
include_once "./com/clsRequest.php";
include_once "./com/clsServer_API.php";
include_once "./com/clsError.php";
include_once "./com/clsResponse.php";

$time_start = microtime(true);
/////////////////////////////////////
$response = new Response(false,'config');

$obj_api= new clsServerApi("./xml/dbxml.xml");

$result = $obj_api->Validate();

// /////////////////////////////////////

$time_end = microtime(true);
// //CALCULATE////////////////////////////////////
$time_exec = $time_end-$time_start;

//EXECUTE/////////////////////////////////////

$response->execute($result,$time_exec);





?>