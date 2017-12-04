<?php 
	session_start();
	if (!isset($_SESSION['email'])) {
	            echo '<script language="javascript">alert("Para visualizar este contenido debes estar logeado.");</script>';
	            header('Location: layout.php');
	        }

	include "conexion.php";

	$Preguntas_FILE = 'preguntas.xml';

	$result = mysqli_query($conn, "SELECT * FROM Preguntas");

	echo ('<table id="preguntas" name="preguntas" border style="margin: 0 auto;">');
	echo ('<tr>');
	echo ('<th>Enunciado</th>');
	echo ('<th>Complejidad</th>');
	echo ('<th>Tema</th>');
	echo ('</tr>');

	while($row = mysqli_fetch_row($result)){
		echo "<tr>";
		echo "<td>".$row[2]."</td>";
		echo "<td>".$row[7]."</td>";
		echo "<td>".$row[8]."</td>";
		echo "</tr>";
	}

?>