<?php

$time_start = microtime(true);
include_once __DIR__."./com/clsXMLUtils.php";
include_once "./com/clsParam.php";
include_once __DIR__."./com/clsMethod.php";
include_once "./com/clsRequest.php";
include_once "./com/clsServerApi.php";
include_once "./com/clsError.php";
include_once "./com/clsResponse.php";

$obj_api= new clsServerApi("./xml/dbxml.xml");
$result = $obj_api->Validate();

$time_end = microtime(true);
global $time_exec;
$time_exec = $time_end-$time_start;
new Response(false,$obj_api->arrErrors,$time_exec);


?>