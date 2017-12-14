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
	<?php
		include "insertarNav.php";
		@session_start();
<<<<<<< HEAD
		 	$_SESSION['arrayPreguntas'] = array();		
	?>
	<section class="main" id="s1">
		<div id="jugar">
			¿Quieres probar suerte pregunta a pregunta?<br>
			<input type='button' id='nuevaPregunta' value='Pregunta' onclick='nuevaPreg();'>
			<br>
			<br>
			<br>
			¿O prefieres probar por tema?<br>
			<select id="tema">
				<?php 

					include "conexion.php";

					$result = mysqli_query($conn, "SELECT DISTINCT tema FROM Preguntas ");
					
					while($row = mysqli_fetch_row($result)){
						echo "<option value='".$row[0]."'>".$row[0]."</option>";
					}

				?>
		    </select>
		    <br>
			<input type='button' id='nuevaPregunta' value='Preguntas' onclick='nuevaPregTema();'>
=======
		if (!isset($_SESSION['arrayPreguntas'][])){
			$array = array();
		 	$_SESSION['arrayPreguntas'][] = $array;
		}
	?>
	<section class="main" id="s1">
		<div id="jugar">
			¿Quieres probar suerte?<br>
			<input type='button' id='nuevaPregunta' value='Pregunta' onclick='nuevaPreg();'>
>>>>>>> 6c4d46680fc55b0cae8fa53f96af9967e014edfe
		</div>
	</section>
	<footer class='main' id='f1'>
		<?php include "footer.php";?>
	</footer>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript">
	function likes(){
		$.ajax({
			url:'likesDislikes.php?like=1&dislike=0&id=' + $("#idPreg").val(),
			success:function(n){
				$('#likes').fadeIn().html(n);}
		});
	}	

	function dislikes(){
		$.ajax({
			url:'likesDislikes.php?like=0&dislike=1&id=' + $("#idPreg").val(),
			success:function(n){
				$('#dislikes').fadeIn().html(n);}
		});
	}

	function nuevaPreg(){
		$.ajax({
			url:'nuevaPregunta.php',
			success:function(n){
				$('#jugar').fadeIn().html(n);}
		});
	}	

<<<<<<< HEAD
	function nuevaPregTema(){
		$.ajax({
			url:'nuevaPregunta.php?tema='+ $("#tema").val(),
			success:function(n){
				$('#jugar').fadeIn().html(n);}
		});
	}	

	function enviarResp(){
		$.ajax({
			url:'aciertoFallo.php?respuesta='+ $("#resp:checked").val() + '&id=' + $("#idPreg").val() ,
=======
	function enviarResp(){
		$.ajax({
			url:'aciertoFallo.php?respuesta='+ $("#resp:checked").val() + '&id=' + $("#idPreg").val(),
>>>>>>> 6c4d46680fc55b0cae8fa53f96af9967e014edfe
			success:function(n){
				$('#jugar').fadeIn().html(n);}
		});
	}	
</script>
</body>
</html>