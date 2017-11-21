<?php 

require_once("nusoap-master/src/nusoap.php");

$id = $_GET['id'];

$soapclient = new nusoap_client('http://localhost/Lab5/obtenerPregunta.php?wsdl', true);

$result = $soapclient->call('obtener', array('id'=>$id));

echo "Enunciado :". $result['enunciado'] ."<br>";
echo "Respuesta correcta :". $result['r_correcta']."<br>";
echo "Complejidad :". $result['complejidad'];
//esto va a acabar siendo un array...

?>