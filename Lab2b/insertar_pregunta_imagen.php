<?php 

	include "conexion.php";

	$email = $_POST['email'];
	$enuc = $_POST['enunciado'];
	$r_c = $_POST['r_correcta'];
	$r_i1 = $_POST['r_inc_1'];
	$r_i2 = $_POST['r_inc_2'];
	$r_i3 = $_POST['r_inc_3'];
	$complejidad = $_POST['complejidad'];
	$tema = $_POST['tema'];

	if ($_FILES["fichero"]["type"]){
	    $imagen=mysqli_real_escape_string($conn, file_get_contents($_FILES["fichero"]["tmp_name"]));
	    $sql = "INSERT INTO Preguntas (email, enunciado, r_c, r_i1, r_i2, r_i3, complejidad, tema, foto) VALUES ('$email', '$enuc', '$r_c', '$r_i1', '$r_i2', '$r_i3', '$complejidad', '$tema','$imagen')";
	}else{
	    $sql = "INSERT INTO Preguntas (email, enunciado, r_c, r_i1, r_i2, r_i3, complejidad, tema) VALUES ('$email', '$enuc', '$r_c', '$r_i1', '$r_i2', '$r_i3', '$complejidad', '$tema')";
	}


	if (mysqli_query($conn, $sql)){
	    echo "La pregunta se ha añadido correctamente en nuestra base de datos. Gracias por su colaboración <br>";
	    echo "Si desea ver las preguntas que forman la base de datos, por favor, pulse ";
	    echo '<a href="VerPreguntas.php"> aquí. </a>'; 
	}
	else{
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	    echo "Como puede observar ha habido un problema al añadir la pregunta en la base de datos. <br>";
	    echo "Si desea volver a intentar añadir la foto, pulse ";
	    echo '<a href="pregunta.html"> aquí. </a>';
	}
	mysqli_close($conn); 

?>