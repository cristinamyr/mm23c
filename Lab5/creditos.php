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
				<img src="fotos/foto_myc.JPG" alt="Foto de Marina y Cristina" width="20%">
			</div>
            <form >
                Por favor, introduce una localidad para calcular su latitud y su longitud: <br>
                <input type="text" name ="sitio" required/>
                <input type="submit" value="enviar"/> 
            </form>
            <?php 
                if (isset($_GET['sitio'])){
	                  $urlMapa = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $_GET['sitio'];
	                  $contenido = file_get_contents($urlMapa);
	                  $resul = json_decode($contenido,true);
	                  $latitud = $resul['results'][0]['geometry']['location']['lat'];
	                  $longitud = $resul['results'][0]['geometry']['location']['lng'];
	                  echo "Las coordenadas de '" . $_GET['sitio'] . "' son: <br>";
	                  echo "Latitud: ". $latitud ."<br> Longitud: ". $longitud. "<p>";
              	}
			?>
		</section>
		<footer class='main' id='f1'>
			<?php include "footer.php";?>
		</footer>
	</div>

</body>
</html>
