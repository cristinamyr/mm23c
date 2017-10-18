<?php

$local = 0; //poner a 0 para 000webhost

if ($local == 1){
    $host = "localhost";
    $usuario = "root";
    $pw = "";
    $bd = "quiz";
}else{
    $host = "localhost";
    $usuario  = "******************";
    $pw = "******************";
    $bd = "******************";
}

$conn = mysqli_connect($host, $usuario, $pw, $bd); 

if (!$conn){
        die("No se ha podido establecer la conexión con la base de datos.");
    }

?>