<?php 

	$Preguntas_FILE = 'preguntas.xml';

	if(file_exists($Preguntas_FILE)){
		if(!($bl=simplexml_load_file($Preguntas_FILE))){
			echo('Ha habido algun error al buscar las preguntas');
		}else{
			echo ('<table id="preguntas" name="preguntas" border style="margin: 0 auto;">');
			echo ('<tr>');
			echo ('<th>Enunciado</th>');
			echo ('<th>Complejidad</th>');
			echo ('<th>Tema</th>');
			echo ('</tr>');
			$count = 0;
			foreach($bl->assessmentItem as $assessmentItem){
				$count = $count + 1;
				echo('<tr>');
				echo('<td>'.$assessmentItem->itemBody->p.'</td>');
				echo('<td>'.$assessmentItem['complexity'].'</td>');
				echo('<td>'.$assessmentItem['subject'].'</td');
				echo('</tr>');
			}
			echo ('</table>');
			if($count == 0){
				echo('No se ha podido encontrar ninguna pregunta');	
			}	
		}
	}
?>