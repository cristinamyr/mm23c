<?php
include "conexion.php";

$local = 1;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<span class="right"><a href="registro">Registrarse</a></span>
      		<span class="right"><a href="login">Login</a></span>
      		<span class="right" style="display:none;"><a href="/logout">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.html'>Inicio</a></spam>
		<span><a href='pregunta.html'>Preguntas</a></spam>
		<span><a href='VerPreguntas.php'>Ver Preguntas</a></spam>
		<span><a href='creditos.html'>Creditos</a></spam>
	</nav>
    <section class="main" id="s1">
    
	<div id="preguntas_div" style="overflow:scroll; height:350px; width:95%;">
		<table id="preguntas" name="preguntas" border>
		<?php 
		
    	$result = mysqli_query($conn, "SELECT * FROM Preguntas");

		echo "<tr>";
		echo "<th>Email</th>";
		echo "<th>Enunciado</th>";
		echo "<th>Respuesta correcta</th>";
		echo "<th>Respuesta incorrecta 1</th>";
		echo "<th>Respuesta incorrecta 2</th>";
		echo "<th>Respuesta incorrecta 3</th>";
		echo "<th>Complejidad</th>";
		echo "<th>Tema</th>";
		echo "<th>Foto</th>";
		echo "</tr>";

		while($row = mysqli_fetch_row($result)){
			echo "<tr>";
			echo "<td>".$row[1]."</td>";
			echo "<td>".$row[2]."</td>";
			echo "<td>".$row[3]."</td>";
			echo "<td>".$row[4]."</td>";
			echo "<td>".$row[5]."</td>";
			echo "<td>".$row[6]."</td>";
			echo "<td>".$row[7]."</td>";
			echo "<td>".$row[8]."</td>";
			echo "<td>";
			if ($row[9]!= ""){
				echo "<img alt='imagen' width='150px'src='data:image/x-png;base64,".base64_encode($row[9]). "'/>"; 
			}else {
				echo " No hay imagen ";
			}
			echo "</td>";
			echo "</tr>";
		}

		?>
		</table>
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com/cristinamyr/mm23c/tree/master/Lab2b'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>

<?php
mysqli_close($conn);
?>