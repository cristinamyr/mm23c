<?php

	include "conexion.php";
<<<<<<< HEAD
	@session_start();
=======
>>>>>>> 6c4d46680fc55b0cae8fa53f96af9967e014edfe

	$resp = $_GET['respuesta'];
	$id = $_GET['id'];

	$sql = "SELECT * FROM Preguntas WHERE id = '$id'";

	$result = mysqli_query($conn, $sql);

	$row = mysqli_fetch_row($result);

	if($row[3] == $resp){
<<<<<<< HEAD
		if(isset($_SESSION['aciertos'])){
			$_SESSION['aciertos'] = $_SESSION['aciertos'] + 1;
		}else{
			$_SESSION['aciertos'] = 1;
		}
		echo "¡Enhorabuena has acertado! ¿otra pregunta? <br>";
	}else{
		if(isset($_SESSION['fallos'])){
			$_SESSION['fallos'] = $_SESSION['fallos'] + 1;
		}else{
			$_SESSION['fallos'] = 1;
		}
		echo "Parece que no eres muy bueno jugando a esto. Prueba otra vez. <br>";	
	}
	
=======
		echo "¡Enhorabuena has acertado! ¿otra pregunta? <br>";
	}else{
		echo "Parece que no eres muy bueno jugando a esto. Prueba otra vez. <br>";	
	}
>>>>>>> 6c4d46680fc55b0cae8fa53f96af9967e014edfe
	echo "<input type='button' id='nuevaPregunta' value='Pregunta' onclick='nuevaPreg();'>";

?>