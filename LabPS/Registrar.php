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
			include "header_nav_unlogged.php";
	    ?>
		<section class="main" id="s1">
			<div>
				<form id="fregistro" method="post" name="registro" action="Registrar.php" method="post" enctype="multipart/form-data">
					E-mail(*):<input type="text"  size="50" id="email" name="email" pattern="[a-zA-Z]+[0-9]{3}@ikasle\.ehu\.eu?s" required /><br>
					Nombre y Apellidos(*): <input type="text" size="80"  id="nombre" name="nombre" pattern="[a-zA-Z]+[ ][a-zA-Z]+" required /><br>
					Nick(*): <input type="text" size="80" id="nick" name="nick" pattern="[a-zA-Z]+" required /><br>
					Password(*): <input type="password" size="80"  id="password" name="password" pattern=".{6,}" required /><br>
					Repetir password(*): <input type="password"  size="80" id="password2" name="password2" required /><br>
					Foto: <input typ="uploadedfile" type="file" id="fichero" name="fichero"><br>
					<input type="submit" id="enviar" name="enviar">
					<input type="reset" id="BorrarDatos" name="BorrarDatos"><br>
				</form> 
				<?php 
					if(isset($_POST['email'])){

						include "conexion.php";

						function is_valid_email($str)
						{
						  $matches = null;
						  return (1 === preg_match('/[a-zA-Z]+[0-9]{3}@ikasle\.ehu\.eu?s/', $str, $matches));
						}

						function is_valid_nombre($str)
						{
						  $matches = null;
						  return (1 === preg_match('/[a-zA-Z]+([ ][a-zA-Z]+)+/', $str, $matches));
						}

						function is_valid_nick($str)
						{
						  $matches = null;
						  return (1 === preg_match('/[a-zA-Z]+/', $str, $matches));
						}

						function passwords_iguales($pass1, $pass2)
						{
							if(strcmp($pass1, $pass2) == 0){
								return true;
							}else{
								return false;
							}
						}

						function existe_email($str, $conexion){
						 	$resultado = mysqli_query($conexion, "SELECT * FROM Usuarios WHERE email='$str'");
							if (mysqli_num_rows($resultado) == 0) return false;
							else return true;
						}

						function valoresCompletos($conexion)
						{
							if (is_valid_email($_POST['email']) && isset($_POST['nombre']) && is_valid_nombre($_POST['nombre']) && isset($_POST['nick']) && is_valid_nick($_POST['nick']) && isset($_POST['password']) && isset($_POST['password2']) && passwords_iguales($_POST['password'], $_POST['password2']) && (strlen($_POST['password'])>5) && !existe_email($_POST['email'], $conexion)){
								return true;
							}
							else{
								return false;
							}
						}

						$email = trim($_POST['email']);
						$nombre = $_POST['nombre'];
						$nick = $_POST['nick'];
						$password = $_POST['password'];
						$password2 = $_POST['password2'];

						if (valoresCompletos($conn)){
							if ($_FILES["fichero"]["type"]){
							    $imagen=mysqli_real_escape_string($conn, file_get_contents($_FILES["fichero"]["tmp_name"]));
							    $ruta= "imagenusuario/".$email; 
								move_uploaded_file($_FILES['fichero']['tmp_name'], $ruta); 
							    $sql = "INSERT INTO Usuarios (email, nombre, nick, password, imagen, path) VALUES ('$email', '$nombre', '$nick', '$password', '$imagen', '$ruta')";
							}else{
							    $sql = "INSERT INTO Usuarios (email, nombre, nick, password) VALUES ('$email', '$nombre', '$nick', '$password')";
							}

							if (mysqli_query($conn, $sql)){
							    echo "El usuario ha sido añadido correctamente <br>";
							}else{
							    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
							    echo "Como puede observar ha habido un problema al añadir al usuario en la base de datos. <br>";
							}
						}else{
							echo "La que has liado pollito, hay algún campo incorrecto. Vuelve a rellenar el formulario.";
						}

						mysqli_close($conn); 
					}
				?>
			</div>
		</section>
		<footer class='main' id='f1'>
			<?php include "footer.php";?>
		</footer>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript">
		$("#enviar").click(function(){
			var $password = $("#password").val();
			var $password2 = $("#password2").val();
			if($password == $password2){
				return true;
			}else{
				alert("Error: contraseña incorrecta");
				return false;
			}
		});

		$("#fichero").click(function(event){

			$("input[type=file]").change(function(event) {
		        readURL(this);
		    });
		    if(!$("#imagen").length){
				var $foto = $('<img id="imagen" src="" alt="imagen seleccionada por el usuario" width="250px">');
						    
	 			$("#fregistro").append($foto);
	 		}
		   
		    const readURL = (input) => {
 
		        if (input.files && input.files[0]) {
		            const reader = new FileReader();
		 
		            reader.onload = (e) => {
		                $('#imagen').attr('src', e.target.result);
		            }
		            reader.readAsDataURL(input.files[0]);
		       	}
			
			}
	    	
	        if(!$("#resetImg").length){
	        	var input = $("<input/>", {
					  type: "button",
					  id: "resetImg",
					  name: "quitar imagen",
					  value: "quitar imagen" 
				});
				$("#fregistro").append(input);					
		        $("#resetImg").bind("click", function(){ 
				$("#imagen").remove();
				$("#resetImg").remove();
				delete $('#imagen');
	    		delete $('#resetImg');
	    		$('#fichero').val("");} );
		    }
		});
	</script>
</body>
</html>
