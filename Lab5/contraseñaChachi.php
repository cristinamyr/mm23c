<?php 

require_once("nusoap-master/src/nusoap.php");

$password = $_GET['password'];

$soapclient = new nusoap_client('http://localhost/Lab5/comprobarPass.php?wsdl', true);

$result = $soapclient->call('comprobar', array('x'=>$password));

echo $result;

?>