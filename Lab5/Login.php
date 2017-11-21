<!DOCTYPE html>
<html>
<head>
	<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Login</title>
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
			if(isset($_POST['email'])){

				include "conexion.php";

				$email = trim($_POST['email']);
				$password = $_POST['password'];
				$resultado = mysqli_query($conn, "SELECT * FROM Usuarios WHERE email = '$email' && password = '$password'");
				if (mysqli_num_rows($resultado)>0){
					$row = mysqli_fetch_row($resultado);
					$nombre = $row[2];
					$path = $row[5];
					if($path != ""){
						$path = "si";
					}else{
						$path = "no";
					}

					$CONT_FILE = 'contador.xml';
				
					$contador=simplexml_load_file($CONT_FILE);
					
					if(!$contador){
						return false;
					}
					
					$usuarios = (int) $contador->usuario;
					$contador->usuario = null;
					$contador->usuario = $usuarios + 1;

					$contador->asXML($CONT_FILE);

					echo '<script language="javascript"> alert("Bienvenido/a '.$row[1].'!"); window.location.assign("layout.php?email='.$email.'&path='.$path.'")</script>';
					include "header_nav_logged.php";
				}else{
					echo '<script language="javascript"> alert("El usuario no existe. Intentalo de nuevo.")</script>';
					include "header_nav_unlogged.php";
				}
				
				mysqli_close($conn); 
			}else{
				include "header_nav_unlogged.php";
			}
    	?>
		<section class="main" id="s1">
			<div>
				<form id="flogin" method="post" name="login" action="Login.php" method="post" enctype="multipart/form-data">
					E-mail:<input type="text"  size="50" id="email" name="email" required /><br>
					Password: <input type="password" size="48"  id="password" name="password" required /><br>
					<input type="submit" id="enviar" name="enviar">
				</form> 
				<a href="olvidoPw.php">¿Olvidó su contraseña?</a>
			</div>
		</section>
		<footer class='main' id='f1'>
			<?php include "footer.php";?>
		</footer>
	</div>
</body>
</html>
