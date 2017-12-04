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
			<?php include "header_nav_unlogged.php";
			session_start();
			if (isset($_SESSION['rol'])) {
	            echo '<script language="javascript">alert("Si estás logeado, para que qué quieres cambiar de contraseña?");</script>';
	            header('Location: layout.php');
	        }
			 ?>

		<section class="main" id="s1">
			<div>
				<form id="flogin" method="post" name="login" action="Login.php" method="post" enctype="multipart/form-data">
					E-mail:<input type="text"  size="50" id="email" name="email" value= /><br>
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
