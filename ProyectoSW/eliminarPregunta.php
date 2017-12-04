<?php 

	require_once("funciones.inc");
	include "conexion.php";

		$id = $_POST['id'];
		
		$sql = "DELETE FROM Preguntas WHERE id='".$id."'";

		if (mysqli_query($conn, $sql)){
			echo "La pregunta se ha eliminado correctamente.<br>";
		}else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			echo "Como puede observar ha habido un problema al modificar la pregunta en la base de datos. <br>";
		}

		mysqli_close($conn); 

?>