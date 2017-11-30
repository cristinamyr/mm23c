<?php 
session_start();
if (!isset($_SESSION['rol'])) {
	            echo '<script language="javascript">alert("Debes estar logeado para acceder a este conenido");</script>';
	            header('Location: layout.php');
	        }

	require_once("funciones.inc");
	include "conexion.php";

	if(valoresCompletos()){

		$id = $_POST['id'];
		$email = $_POST['email'];
		$enunciado = $_POST['enunciado'];
		$r_c = $_POST['r_correcta'];
		$r_i1 = $_POST['r_inc_1'];
		$r_i2 = $_POST['r_inc_2'];
		$r_i3 = $_POST['r_inc_3'];
		$complejidad = $_POST['complejidad'];
		$tema = $_POST['tema'];
		
		$sql = "UPDATE Preguntas SET enunciado='".$enunciado."', r_c='".$r_c."', r_i1='".$r_i1."', r_i2='".$r_i2."', r_i3='".$r_i3."', complejidad='".$complejidad."', tema='".$tema."' WHERE id='".$id."'";

		if (mysqli_query($conn, $sql)){
			echo "La pregunta se ha moficado correctamente.<br>";
		}else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			echo "Como puede observar ha habido un problema al modificar la pregunta en la base de datos. <br>";
		}

		mysqli_close($conn); 

	}else{
		echo "La que has liado pollito, hay algún campo incorrecto. Vuelve a intentar rellenar el formulario.";
	}	

?>