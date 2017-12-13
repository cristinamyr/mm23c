<?php

	include "conexion.php";

	$resp = $_GET['respuesta'];
	$id = $_GET['id'];

	$sql = "SELECT * FROM Preguntas WHERE id = '$id'";

	$result = mysqli_query($conn, $sql);

	$row = mysqli_fetch_row($result);

	if($row[3] == $resp){
		echo "¡Enhorabuena has acertado! ¿otra pregunta? <br>";
	}else{
		echo "Parece que no eres muy bueno jugando a esto. Prueba otra vez. <br>";	
	}
	echo "<input type='button' id='nuevaPregunta' value='Pregunta' onclick='nuevaPreg();'>";

?>