<?php
function valoresCompletos()
{
	if (isset($_POST['enunciado']) && (strlen($_POST['enunciado'])>9) && isset($_POST['r_correcta']) && (strlen($_POST['r_correcta'])>0) && isset($_POST['r_inc_1']) && (strlen($_POST['r_inc_1'])>0) && isset($_POST['r_inc_2']) && (strlen($_POST['r_inc_2'])>0) && isset($_POST['r_inc_3']) && (strlen($_POST['r_inc_3'])>0) && isset($_POST['complejidad']) && isset($_POST['tema']) && (strlen($_POST['complejidad'])==1) && $_POST['complejidad'] > 0 && $_POST['complejidad'] < 6){
		return true;
	}
	else{
		echo("algún valor incorrecto");
		return false;
	}
}

function GuardarPreguntaXML($complejidad, $tema, $email, $enunc, $r_c, $r_i1, $r_i2, $r_i3){
	$Preguntas_FILE = 'preguntas.xml';
		
	$bl=simplexml_load_file($Preguntas_FILE);
	
	if(!$bl){
		return false;
	}
	
	$nuevo = $bl->addChild('assessmentItem');
	$nuevo->addAttribute('complexity', $complejidad);
	$nuevo->addAttribute('subject', $tema);
	$nuevo->addAttribute('author', $email);

	$itemBody = $nuevo->addChild('itemBody');
	$itemBody->addChild('p', $enunc);

	$correctResponse = $nuevo->addChild('correctResponse');
	$correctResponse->addChild('value', $r_c);

	$incorrectResponses = $nuevo->addChild('incorrectResponses');
	$incorrectResponses->addChild('value', $r_i1);
	$incorrectResponses->addChild('value', $r_i2);
	$incorrectResponses->addChild('value', $r_i3);

	return $bl->asXML($Preguntas_FILE);
}
?>