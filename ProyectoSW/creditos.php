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
<body onload="initialize()">
	<div id='page-wrap'>
		<?php 
			include "insertarNav.php";
	    ?>
		<section class="main" id="s1">
			<div>
				Autoras: Marina Acosta y Cristina Mayor<br>
				Especialidad: Computación<br>
				Foto:<br>
				<img src="fotos/foto_myc.JPG" alt="Foto de Marina y Cristina" width="20%">
			</div>
			Usted está aquí:
			<div id="map_canvas" style="height: 65px">
			</div>
		</section>
		<footer class='main' id='f1'>
			<?php include "footer.php";?>
		</footer>
	</div>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCM96tTCjdxo95KdoN7hmTwasb2ril1XI&callback=initMap" type="text/javascript"></script>
<script type="text/javascript"> 
  function initialize() {
    var latlng = new google.maps.LatLng(43.3072714698608, -2.010662449073834);
    var myOptions = {
      zoom: 17,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.SATELLITE
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    var marker = new google.maps.Marker({
      position: map.getCenter(),
      map: map,
      title: 'Haz click aquí para hacer Zoom'
    });

    google.maps.event.addListener(marker, 'click', function() {
      if (map.getZoom() == 2)
        map.setZoom(20);
      else
        map.setZoom(2);
    });

    google.maps.event.addListener(map, 'click', function(e) {
      alert('Latitud: ' + e.latLng.lat() + '\nLongitud: ' + e.latLng.lng());
    });
  }
</script>
</body>
</html>
