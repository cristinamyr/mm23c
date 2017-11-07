<!DOCTYPE html>
<html>
<head>
	<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Obetner Datos</title>
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
				<form id="fObtenerResultados">
					E-mail:<input type="text"  size="50" id="mail" name="mail" required /><br>
					Nombre: <input type="text" size="48"  id="name" name="name"  disabled /><br>
					Apellidos: <input type="text" size="48"  id="apellidos" name="apellidos" disabled /><br>
					Teléfono: <input type="text" size="48"  id="telefono" name="telefono" disabled /><br>
					<input type="button" id="obtenerDatos" name="obtenerDatos" value="obtener datos">
					<input type="reset" id="borrar" name="borrar" value="Borrar formulario">
				</form> 
			</div>
		</section>
		<footer class='main' id='f1'>
			<?php include "footer.php";?>
		</footer>
	</div>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	 <script type="text/javascript">
	 	$("#obtenerDatos").click(function(){
	 		if ($("#mail").val() != ""){
				$.get('usuarios.xml', function(d){
	 				var listaUsuarios = $(d).find('usuario');
	 				var int = 0;
	 				for (var i = 0; i<listaUsuarios.length; i++){
	 					if (listaUsuarios[i].children[0].textContent == $('#mail').val()) {
	 						int = 1;
	 						$("#mail").val(listaUsuarios[i].children[0].textContent);
	 						$("#name").val(listaUsuarios[i].children[1].textContent);
		 					$("#apellidos").val(listaUsuarios[i].children[2].textContent + " " + listaUsuarios[i].children[3].textContent);
		 					$("#telefono").val(listaUsuarios[i].children[4].textContent);
	 					}
	 				}
	 				if (int == 0){
	 					alert("Ese e-mail no estaba en el documento. Inténtelo de nuevo.");
	 				}
	 			});
	 		}else{
	 			alert("ha de introducir el e-mail para poder obtener los datos de alguna persona.");
	 		}
	 		
	 		});
	 </script>
</body>
</html>
