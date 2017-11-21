<?php  

require_once("nusoap-master/src/nusoap.php");

$ns="http://localhost/Lab5/nusoap-master/samples"; 
$server = new soap_server;
$server->configureWSDL('comprobarPass',$ns);
$server->wsdl->schemaTargetNamespace=$ns;

$server->register('comprobar', array('x'=>'xsd:string'), array('z'=>'xsd:string'), $ns);

function comprobar($pass){ 
	$file = fopen("toppasswords.txt", "r") or die("Unable to open file!");
	while(!feof($file)) {
		if(strcmp(trim(fgets($file)),$pass) == 0){
			return "INVALIDA";
		}
	}
	if(feof($file)){
		return "VALIDA";
	}
	fclose($file);
}

if (!isset($HTTP_RAW_POST_DATA)){
	$HTTP_RAW_POST_DATA = file_get_contents('php://input');
}

$server->service($HTTP_RAW_POST_DATA);

?>