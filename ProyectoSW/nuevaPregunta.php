<?php 

	include "conexion.php";

	$qbaney = mysqli_query($conn, "SELECT * FROM Preguntas"); 
	$max = mysqli_num_rows($qbaney); 

	@session_start();
	$preguntas = $_SESSION['arrayPreguntas'][];

	if($max != 0){

		$rand = mt_rand(1,$max); 

		$arrayBusqueda = array($rand);
		//array_push($array, "manzana");

		while (count($preguntas)<$max && in_array($rand, $preguntas) && count($arrayBusqueda)<$max){
			if(!in_array($rand, $arrayBusqueda)) array_push($arrayBusqueda, $rand);
			$rand = mt_rand(1,$max); 
		}
		if (count($preguntas)==$max){
			echo "Ups... Parece que nos hemos quedado sin preguntas...";
		}
		else{

			$preguntas = array_push($preguntas, $rand);
			$_SESSION['arrayPreguntas'] = $preguntas;


			$result = mysqli_query($conn, "SELECT * FROM Preguntas WHERE id = '$rand'");

			$row = mysqli_fetch_row($result);

			echo $row[2] . "<br>";

			if(!empty($row[9])){
				echo "<img alt='imagen' width='150px'src='data:image/x-png;base64,".base64_encode($row[9]). "'/>"; 
			}

			echo "<form id='frespuesta' method='post' name='respuesta' enctype='multipart/form-data'>";
			echo "<input type='text' id='idPreg' value='".$rand."' hidden/><br>";
			$r1 = mt_rand(3,6); 
			echo "<input type='radio' id='resp' name='resp' value='".$row[$r1]."'> ".$row[$r1]."<br>";
			$r2 = mt_rand(3,6); 
			while($r1==$r2){
				$r2 = mt_rand(3,6);
			}
			echo "<input type='radio' id='resp' name='resp' value='".$row[$r2]."'> ".$row[$r2]."<br>";
			$r3 = mt_rand(3,6); 
			while($r1==$r3 || $r2==$r3){
				$r3 = mt_rand(3,6);
			}
			echo "<input type='radio' id='resp' name='resp' value='".$row[$r3]."'> ".$row[$r3]."<br>";
			$r4 = mt_rand(3,6); 
			while($r1==$r4 || $r2==$r4 || $r3==$r4){
				$r4 = mt_rand(3,6);
			}
			echo "<input type='radio' id='resp' name='resp' value='".$row[$r4]."'> ".$row[$r4]."<br><br>";
			echo "<input type='button' id='submitrespuesta' value='Enviar' onclick='enviarResp();'>";
			echo "</form>";
			echo "<br><br>";
			echo "<img src='fotos/like.png' id='imgLike' alt='like' width='50px' onclick='likes();'> <span id='likes'>".$row[10]."</span>";
			echo "<img src='fotos/dislike.png' id='imgDislike' alt='dislike' width='58px' onclick='dislikes();'> <span id='dislikes'>".$row[11]."</span>";
		}
	}else{
		echo "Lo sentimos. No hay preguntas en la base de datos.";
	}
?>