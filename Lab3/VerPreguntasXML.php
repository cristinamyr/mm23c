<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Ver Preguntas XML</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
	<?php 
			if(isset($_GET['email'])){
				$email = $_GET['email'];
				$path = $_GET['path'];	        
	         	include "header_nav_logged.php";
	        }else{
	        	include "header_nav_unlogged.php";
	    	}
    ?>
    <section class="main" id="s1">
		<div id="preguntas_div" style="overflow:scroll; height:350px; width:1120px;">
			<table id="preguntas" name="preguntas" border>

			<?php 
				$Preguntas_FILE = 'preguntas.xml';

	    		if(file_exists($Preguntas_FILE)){
					if(!($bl=simplexml_load_file($Preguntas_FILE))){
						echo('Ha habido algun error al buscar las preguntas');
					}else{
						echo "<tr>";
						echo "<th>Enunciado</th>";
						echo "<th>Complejidad</th>";
						echo "<th>Tema</th>";
						echo "</tr>";
						$count = 0;
						foreach($bl->assessmentItem as $assessmentItem){
							$count = $count + 1;
							echo('<tr>');
							echo('<td>'.$assessmentItem->itemBody->p.'</td>');
							echo('<td>'.$assessmentItem['complexity'].'</td>');
							echo('<td>'.$assessmentItem['subject'].'</td');
							echo('</tr>');
						}
						if($count == 0){
							echo('No se ha podido encontrar ninguna pregunta');	
						}	
					}
				}
			?>
			</table>
		</div>
    </section>
	<footer class='main' id='f1'>
		<?php include "footer.php";?>
	</footer>
</div>
</body>
</html>
