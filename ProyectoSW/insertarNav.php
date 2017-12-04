<?php 
	@session_start();
	if (!isset($_SESSION['email'])){
		include "header_nav_unlogged.php";
	}else{
		if ($_SESSION['rol'] == "profe"){
			include "header_nav_profe.php";
		}else{
			include "header_nav_logged.php";
		}
	}

?>