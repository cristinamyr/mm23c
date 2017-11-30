<?php 
		session_start();
		if (isset($_SESSION['rol'])) {
	            echo '<script language="javascript">alert("Ya estás logeado, no intentes volvernos loco!");</script>';
	            echo '<script >alert("No puedes cambiar la pass si tienes la sesión iniciada");</script>';
	            header('Location: layout.php');
	        }

		include "conexion.php";

		$passw = $_POST['passw'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM Usuarios WHERE password='".$passw."'";

		$resul = mysqli_query($conn, $sql);

		if (mysqli_num_rows($resul) > 0){
			$row = mysqli_fetch_row($resul);

			$hashPass = password_hash($password, PASSWORD_DEFAULT);

			$email = $row[0];
			$nombre = $row[1];
			$nick =$row[2];
			$imagen =$row[4];
			$path = $row[5];

			$sql2 = "UPDATE Usuarios SET email='".$email."', nombre='".$nombre."', nick='".$nick."', password='".$hashPass."', imagen='".$imagen."', path='".$path."' WHERE password='".$passw."'";

			if (mysqli_query($conn, $sql2)){
				echo "Se ha cambiado correctamente su pw.";
			}else {
				echo "No se ha podido cambiar su pw. Inténtelo de nuevo.";
			}
		}else{
			echo "Ese enlace ya ha sido utilizado para cambiar una contraseña. Solicita un nuevo link para poder cambiar tu contraseña otra vez. Perdón por las molestias.";
		}
		
		mysqli_close($conn); 	
				
?>