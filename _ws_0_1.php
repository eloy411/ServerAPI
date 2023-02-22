<?php
/*
Verificar:
- Definición de datos privados en objetos
- Errores y su gestión
- Estrategia de funcionamiento
- Objetos vs tipos convencionales
- Strong typed data
*/
include_once __DIR__."./com/clsXMLUtils.php";
include_once "./com/clsParam.php";
include_once __DIR__."./com/clsMethod.php";
include_once "./com/clsRequest.php";
include_once "./com/clsServerApi.php";
include_once "./com/controlErrors.php";


$obj_api= new clsServerApi("./xml/dbxml.xml");

$result = $obj_api->Validate();

$errors = new ControlErrors($result);

print_r($errors->listDefined)

?>