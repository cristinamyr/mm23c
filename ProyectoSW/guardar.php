<?php 
session_start();

	if (!isset($_SESSION['rol'])) {
        echo '<script language="javascript">alert("Ya estás logeado, no intentes volvernos loco!");</script>';
        echo '<script language="javascript">alert("Para acceder a este contenido debes estar logeado");</script>';
        header('Location: layout.php');
    }
    
	include("funciones.inc");

	if(valoresCompletos()){

		include "conexion.php";

		//$email = trim($_POST['email']);
		$email = $_SESSION['email'];
		$enuc = $_POST['enunciado'];
		$r_c = $_POST['r_correcta'];
		$r_i1 = $_POST['r_inc_1'];
		$r_i2 = $_POST['r_inc_2'];
		$r_i3 = $_POST['r_inc_3'];
		$complejidad = $_POST['complejidad'];
		$tema = $_POST['tema'];

		if (isset($_FILES["fichero"]["tmp_name"])){
		    $imagen = mysqli_real_escape_string($conn, file_get_contents($_FILES["fichero"]["tmp_name"]));
		    $sql = "INSERT INTO Preguntas (email, enunciado, r_c, r_i1, r_i2, r_i3, complejidad, tema, foto) VALUES ('$email', '$enuc', '$r_c', '$r_i1', '$r_i2', '$r_i3', '$complejidad', '$tema','$imagen')";
		}else{
		    $sql = "INSERT INTO Preguntas (email, enunciado, r_c, r_i1, r_i2, r_i3, complejidad, tema) VALUES ('$email', '$enuc', '$r_c', '$r_i1', '$r_i2', '$r_i3', '$complejidad', '$tema')";
		}

		if (mysqli_query($conn, $sql)){
		    echo "La pregunta se ha añadido correctamente en nuestra base de datos. Gracias por su colaboración. <br> ";
		}else{
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		    echo "Como puede observar ha habido un problema al añadir la pregunta en la base de datos.";
		}

		mysqli_close($conn); 

	}else{
		echo "La que has liado pollito, hay algún campo incorrecto. Vuelve a intentar rellenar el formulario.";
	}				
?>