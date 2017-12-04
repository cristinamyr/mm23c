<?php
function valoresCompletos()
{
	if (isset($_POST['enunciado']) && (strlen($_POST['enunciado'])>9) && isset($_POST['r_correcta']) && (strlen($_POST['r_correcta'])>0) && isset($_POST['r_inc_1']) && (strlen($_POST['r_inc_1'])>0) && isset($_POST['r_inc_2']) && (strlen($_POST['r_inc_2'])>0) && isset($_POST['r_inc_3']) && (strlen($_POST['r_inc_3'])>0) && isset($_POST['complejidad']) && isset($_POST['tema']) && (strlen($_POST['complejidad'])==1) && $_POST['complejidad'] > 0 && $_POST['complejidad'] < 6){
		return true;
	}
	else{
		return false;
	}
}
