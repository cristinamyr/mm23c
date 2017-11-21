<?php 

require_once("nusoap-master/src/nusoap.php");

$ns="http://localhost/Lab5/nusoap-master/samples"; 
$server = new soap_server;
$server->configureWSDL('obtenerPregunta',$ns);
$server->wsdl->schemaTargetNamespace=$ns;

$server->register('obtener', array('id'=>'xsd:string'), array('enunciado'=>'xsd:string', 'r_correcta'=>'xsd:string', 'complejidad'=>'xsd:int'), $ns);


	function obtener($id){ 
		include "conexion.php";

		$sql = "SELECT * FROM Preguntas WHERE id='".$id."'";

		$resul = mysqli_query($conn, $sql);
		if (mysqli_num_rows($resul) == 0){ //No hay ninguna pregunta con ese id
			$resultado = array('enunciado' => '', 'r_correcta' => '', 'complejidad' => 0);

		}else{ //Existe una pregunta con ese id
			$row = mysqli_fetch_row($resul);
			$enunciado = $row[2];
			$r_correcta = $row[3];
			$complejidad = $row[7];
			$resultado = array('enunciado' => $enunciado, 'r_correcta' => $r_correcta, 'complejidad' => $complejidad);
		}
		mysqli_close($conn);

		return $resultado;
	}

	if (!isset($HTTP_RAW_POST_DATA)){
		$HTTP_RAW_POST_DATA = file_get_contents('php://input');
	}

$server->service($HTTP_RAW_POST_DATA);

?>