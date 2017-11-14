<?php

$local = 1; //poner a 0 para 000webhost

if ($local == 1){
    $host = "localhost";
    $usuario = "root";
    $pw = "";
    $bd = "quiz";
}else{
    $host = "localhost";
    $usuario  = "id3045607_2223";
    $pw = "SGW2223";
    $bd = "id3045607_quiz";
}

$conn = mysqli_connect($host, $usuario, $pw, $bd); 

if (!$conn){
        die("No se ha podido establecer la conexión con la base de datos.");
    }

?>