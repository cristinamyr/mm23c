<!DOCTYPE html>
<html>
<head>
	<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Registro</title>
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
			if(isset($_GET['email'])){
				$email = $_GET['email'];
				$path = $_GET['path'];		        
	         	include "header_nav_logged.php";
	        }else{
	        	include "header_nav_unlogged.php";
	    	}
	    ?>
		<section class="main" id="s1">
			<div>
				<form id="fObtenerNumPreg" name="obtenerNumPreg" method="get">
					Número de pregunta(*):<input type="text"  size="10" id="numero" name="numero" pattern="[0-9]+" required/><br>
					<input type="button" id="buscar" name="buscar" value="Buscar pregunta"/>
				</form>
			</div>
			<div id="resultado"></div>
		</section>
		<footer class='main' id='f1'>
			<?php include "footer.php";?>
		</footer>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript">

		$("#buscar").click(function(event){
			$.ajax({
				url:'ObtenerPreguntaSW.php?id='+ $("#numero").val(),
				success:function(pregunta){
					$("#resultado").fadeIn().html(pregunta);			
				}
			});
		});
	</script>
</body>
</html>
