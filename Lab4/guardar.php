<?php 
	require_once("funciones.inc");

	if(valoresCompletos()){

		include "conexion.php";

		$email = trim($_POST['email']);
		$enuc = $_POST['enunciado'];
		$r_c = $_POST['r_correcta'];
		$r_i1 = $_POST['r_inc_1'];
		$r_i2 = $_POST['r_inc_2'];
		$r_i3 = $_POST['r_inc_3'];
		$complejidad = $_POST['complejidad'];
		$tema = $_POST['tema'];

		$sql = "INSERT INTO Preguntas (email, enunciado, r_c, r_i1, r_i2, r_i3, complejidad, tema) VALUES ('$email', '$enuc', '$r_c', '$r_i1', '$r_i2', '$r_i3', '$complejidad', '$tema')";

		if (mysqli_query($conn, $sql)){
		    echo "La pregunta se ha añadido correctamente en nuestra base de datos. Gracias por su colaboración. <br> ";
		}else{
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		    echo "Como puede observar ha habido un problema al añadir la pregunta en la base de datos. <br>";
		}

		mysqli_close($conn); 

		if(!GuardarPreguntaXML($complejidad, $tema, $email, $enuc, $r_c, $r_i1, $r_i2, $r_i3))
			echo "No se ha podido guardar el comentario en el fichero xml.";

	}else{
		echo "La que has liado pollito, hay algún campo incorrecto. Vuelve a intentar rellenar el formulario.";
	}				
?>