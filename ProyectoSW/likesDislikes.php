<?php

	include "conexion.php";

	$like = $_GET['like'];
	$dislike = $_GET['dislike'];
	$id = $_GET['id'];

	$sql = "SELECT * FROM Preguntas WHERE id = '$id'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($result);

	if($like == 1){

		$totLike = $row[10] + 1;

		$sql = "UPDATE Preguntas SET gusta='".$totLike."' WHERE id='".$id."'";
		mysqli_query($conn, $sql);

		echo $totLike;

	}else{

		$totDislike = $row[11] + 1;

		$sql = "UPDATE Preguntas SET disgusta='".$totDislike."' WHERE id='".$id."'";
		mysqli_query($conn, $sql);

		echo $totDislike;

	}

?>