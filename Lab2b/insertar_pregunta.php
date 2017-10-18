<?php 

include "conexion.php";

$email = $_POST['email'];
$enuc = $_POST['enunciado'];
$r_c = $_POST['r_correcta'];
$r_i1 = $_POST['r_inc_1'];
$r_i2 = $_POST['r_inc_2'];
$r_i3 = $_POST['r_inc_3'];
$complejidad = $_POST['complejidad'];
$tema = $_POST['tema'];
//$foto = $_POST['fichero'];


$sql = "INSERT INTO Preguntas (email, enunciado, r_c, r_i1, r_i2, r_i3, complejidad, tema) VALUES ('$email', '$enuc', '$r_c', '$r_i1', '$r_i2', '$r_i3', '$complejidad', '$tema')";

if (mysqli_query($conn, $sql)){
    echo "se ha añadido correctamente";
    echo '<a href="VerPreguntas.php"> Enlace para ver las preguntas. </a>'; 
}
else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    echo '<a href="pregunta.html"> Enlace para volver a rellenar el formulario. </a>';
}
mysqli_close($conn); 

?>