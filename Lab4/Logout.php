<?php

	$CONT_FILE = 'contador.xml';

	$contador=simplexml_load_file($CONT_FILE);

	if(!$contador){
		return false;
	}

	$usuarios = (int) $contador->usuario;
	$contador->usuario = null;
	$contador->usuario = $usuarios - 1;

	$contador->asXML($CONT_FILE);

	header('Location: Login.php');

?>  


