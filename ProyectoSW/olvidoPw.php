<!DOCTYPE html>
<html>
<head>
	<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>¿Olvidó su contraseña?</title>
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
			session_start();
			if (isset($_SESSION['rol'])) {
	            echo '<script language="javascript">alert("Se te ha olvidado tu pw pero estás logueado.. no cuadra.");</script>';
	            header('Location: layout.php');
	        }

			if (isset($_POST['email'])){
				include "conexion.php";
				$email = trim($_POST['email']);
				$resultado = mysqli_query($conn, "SELECT * FROM Usuarios WHERE email = '$email'");
				if (mysqli_num_rows($resultado)>0){
					$row = mysqli_fetch_row($resultado);
					$nombre = $row[1];
					$pw = $row[3];
					$id = $row[0];
					if ($local == 1) $link = 'http:/localhost/Lab7/nuevaPass.php?obtenerPass='. $pw;
					else $link = 'https://lab1-2223.000webhostapp.com/Lab7/buscarPregunta.php' .$pw;
					$titulo    = 'Recupera tu contraseña';
					$mensaje   = '<html>'.'<head><title>Recuperar Password</title></head>'.'<body><h2>Recuperar la contraseña en Lab7 - Marina Acosta y Cristina Mayor</h2>'.'Hola '.$nombre.':<br>'.'Nos consta que se te ha olvidado la contraseña, si quieres recuperarla, haz click <a href="'.$link.'">aqui</a>	.</body>'.'</html>';
					$cabeceras = 'Content-type: text/html; charset=utf-8';
					$bool = mail($email, $titulo, $mensaje, $cabeceras);
					if ($bool){
						echo '<script language="javascript"> alert("Se ha enviado un correo con su contraseña al email: '.$email.' !") </script>';
					}else{
						echo '<script language="javascript"> alert("Ha habido un problema al intentar enviar su correo, inténtelo de nuevo, por favor!") </script>';
					}
					
				}else{
					echo '<script language="javascript"> alert("El email introducido no existe en la base de datos. Inténtalo de nuevo..")</script>';
				}
				mysqli_close($conn);

			}
		?>
		<section class="main" id="s1">
			<div>
				<form id="fOlvidoPw" method="post" name="login" action="olvidoPw.php" method="post" enctype="multipart/form-data">
					Por favor, introduzca su correo electrónico: </br>
					<input type="text"  size="50" id="email" name="email" required /><br>
					<input type="submit" id="enviar" name="enviar">
				</form> 
			</div>
		</section>
		<footer class='main' id='f1'>
			<?php include "footer.php";?>
		</footer>
	</div>
</body>
</html>
