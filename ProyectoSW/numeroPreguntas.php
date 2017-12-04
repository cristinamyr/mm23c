<?php 
		session_start();
		if (!isset($_SESSION['rol'])) {
            echo '<script language="javascript">alert("Necesitas estar logeado para ver el contenido de este archivo.");</script>';
            header('Location: layout.php');
        }

		include "conexion.php";

		$email = trim($_GET['email']);

		$sql = "SELECT * FROM Preguntas WHERE email='".$email."'";
		$sql2 = "SELECT * FROM Preguntas";

		if ($resul = mysqli_query($conn, $sql)){
		    $var1 = mysqli_num_rows($resul);
		}else{
		    echo "ha habido un error al acceder a la base de datos. <br>";
		    return;
		}

		if ($resul2 = mysqli_query($conn, $sql2)){
		    $var2 = mysqli_num_rows($resul2);
		}else{
		    echo "ha habido un error al acceder a la base de datos. <br>";
		    return;
		}
		echo "Preguntas tuyas/Preguntas totales: ".$var1."/".$var2."";

		mysqli_close($conn); 	
				
?>