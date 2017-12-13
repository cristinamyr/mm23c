<?php 

include "conexion.php";

require_once("nusoap-master/src/nusoap.php");

$password = $_GET['password'];

if ($local == 1){
	$soapclient = new nusoap_client('http://localhost/ProyectoSW/comprobarPass.php?wsdl', true);
} else {
	$soapclient = new nusoap_client('https://lab1-2223.000webhostapp.com/Lab7/comprobarPass.php?wsdl', true);
}

$result = $soapclient->call('comprobar', array('x'=>$password));

echo $result;

?>