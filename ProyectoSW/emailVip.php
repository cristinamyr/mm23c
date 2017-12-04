<?php 

require_once("nusoap-master/src/nusoap.php");

$email = $_GET['email'];

$soapclient = new nusoap_client('http://ehusw.es/jav/ServiciosWeb/comprobarmatricula.php?wsdl', true);

$result = $soapclient->call('comprobar', array('x'=>$email));

echo $result;

?>