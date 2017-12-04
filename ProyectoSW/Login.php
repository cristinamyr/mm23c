<?php session_start();?>
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
			if (isset($_SESSION['rol'])) {
	            echo '<script language="javascript">alert("Ya estás logeado, no intentes volvernos loco!");</script>';
	            header('Location: layout.php');
	        }
			if(isset($_POST['email'])){

				include "conexion.php";

				$email = trim($_POST['email']);
				$password = $_POST['password'];
				$resultado = mysqli_query($conn, "SELECT * FROM Usuarios WHERE email = '$email'");
				if (mysqli_num_rows($resultado)>0){
					$row = mysqli_fetch_row($resultado);
					$pass = $row[3];
					$intentos = $row[6];

					if (strcmp($intentos, "bloqueado")==0){
						echo '<script language="javascript"> alert("Tu cuenta está bloqueada. \n Contacta con el administrador si deseas inciciar sesión.");</script>';
						include "header_nav_unlogged.php";

					}else{
						if (password_verify($password,$pass)){
							session_start();
							//iniciamos variables de sesión

							$_SESSION['nombre'] = $row[1];
							$_SESSION['email'] = $_POST['email'];
							$path = $row[5];
							if($path != ""){
								$_SESSION['path'] = "si";
							}else{
								$_SESSION['path'] = "no";
							}

							if($email == "web000@ehu.es"){
								$_SESSION['rol'] = "profe";
							}else{
								$_SESSION['rol'] = "estudiante";
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

							$sqlCambio = "UPDATE usuarios SET email='".$row[0]."', nombre='".$row[1]."', nick='".$row[2]."', password='".$row[3]."', imagen='".$row[4]."', path='".$row[5]."', intentos='' WHERE email='".$row[0]."'";
							mysqli_query($conn, $sqlCambio);

							echo '<script language="javascript"> alert("Bienvenido/a '.$row[1].'!"); window.location.assign("layout.php")</script>';

							mysqli_query($conn, "UPDATE Usuarios SET intentos='' WHERE email = '$email'");
						}else{
							if (strcmp($intentos, "2")==0){
								echo '<script language="javascript"> alert("PW INCORRECTA \nTe lo avisamos! Te hemos bloqueado la cuenta!")</script>';
								$sqlCambio = "UPDATE Usuarios SET email='".$row[0]."', nombre='".$row[1]."', nick='".$row[2]."', password='".$row[3]."', imagen='".$row[4]."', path='".$row[5]."', intentos='bloqueado' WHERE email='".$row[0]."'";
							} 
							else if (strcmp($intentos, "1")==0){
								echo '<script language="javascript"> alert("PW INCORRECTA \n Si vuelves a poner mal la contraseña se te bloquea la cuenta. CUIDADITO!")</script>';
								$sqlCambio = "UPDATE Usuarios SET email='".$row[0]."', nombre='".$row[1]."', nick='".$row[2]."', password='".$row[3]."', imagen='".$row[4]."', path='".$row[5]."', intentos='2' WHERE email='".$row[0]."'";
							}
							else{
								echo '<script language="javascript"> alert("PW INCORRECTA \n uiuiui... parece que alguien está olvidadizo hoy...")</script>';
								$sqlCambio = "UPDATE usuarios SET email='".$row[0]."', nombre='".$row[1]."', nick='".$row[2]."', password='".$row[3]."', imagen='".$row[4]."', path='".$row[5]."', intentos='1' WHERE email='".$row[0]."'";
							}

							mysqli_query($conn, $sqlCambio);
							include "header_nav_unlogged.php";
						}
					}
				}else{
					echo '<script language="javascript"> alert("Ese email no figura en la base de datos.")</script>';
					
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
