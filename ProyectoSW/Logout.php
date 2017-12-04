<?php
	session_start();

	if (! isset($_SESSION['rol'])) {
	            echo '<script language="javascript">alert("Amigo mío, si no te logeas, ¿Cómo vas a hacer logout?")';
	            echo "window.location = 'layout.php'";
				echo '</script>';
	        }

	session_destroy();

	$CONT_FILE = 'contador.xml';

	$contador=simplexml_load_file($CONT_FILE);

	if(!$contador){
		return false;
	}

	$usuarios = (int) $contador->usuario;
	$contador->usuario = null;
	$contador->usuario = $usuarios - 1;

	$contador->asXML($CONT_FILE);

	echo '<script language="javascript">';
	            echo "window.location = 'layout.php'";
				echo '</script>';

?>  


