<!DOCTYPE html>
<html>
<head>
	<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Créditos</title>
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
				Autoras: Marina Acosta y Cristina Mayor<br>
				Especialidad: Computación<br>
				Foto:<br>
				<img src="fotos/foto_myc.png" alt="Foto de Marina y Cristina" width="15%">
			</div>
		</section>
		<footer class='main' id='f1'>
			<?php include "footer.php";?>
		</footer>
	</div>
</body>
</html>
