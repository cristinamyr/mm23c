<?php 
	session_start();
	
	if (!isset($_SESSION['rol'])) {
        echo '<script language="javascript">alert("Para acceder aquí necesitas estar logeado");</script>';
        header('Location: layout.php');
    }

	include "conexion.php";

	$id = $_GET['id'];

	$result = mysqli_query($conn, "SELECT * FROM Preguntas WHERE id='".$id."'");

	echo "<form id='modifPregunta' name='modifPregunta'>";

	$row = mysqli_fetch_row($result);
	echo "<input type='text' id='id' name='id' value='". $row[0] ."' hidden>";
	echo "<input type='text' id='email' name='email' value='". $row[1] ."' hidden>";
	echo "Autor: ". $row[1] ."<br>";
	echo "Enunciado:<input type='text' size='80'  id='enunciado' name='enunciado' value='". $row[2] ."'><br>";
	echo "Respuesta correcta:<input type='text' size='80'  id='r_correcta' name='r_correcta' value='". $row[3] ."'><br>";
	echo "Respuesta incorrecta1:<input type='text' size='80'  id='r_inc_1' name='r_inc_1' value='". $row[4] ."'><br>";
	echo "Respuesta incorrecta2:<input type='text' size='80'  id='r_inc_2' name='r_inc_2' value='". $row[5] ."'><br>";
	echo "Respuesta incorrecta3:<input type='text' size='80'  id='r_inc_3' name='r_inc_3' value='". $row[6] ."'><br>";
	echo "Complejidad:<input type='text' size='80'  id='complejidad' name='complejidad' value='". $row[7] ."'><br>";
	echo "Tema:<input type='text' size='80'  id='tema' name='tema' value='". $row[8] ."'><br>";
	echo "<input type='button' id='modificarPreg' name='modificarPreg' value='Modificar' onclick='modifPreg();'>";
	echo "<input type='button' id='eliminarPreg' name='eliminarPreg' value='Eliminar' onclick='elimPreg();'>";
	//esto va a acabar siendo un array...

?>