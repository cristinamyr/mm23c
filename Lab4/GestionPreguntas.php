<!DOCTYPE html>
<html>
<head>
	<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Insertar pregunta</title>
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
			<p id="personasConectadas" align="center">...</p>
			<p id="numPreguntas" align="center">...</p>
			<div>
				<form id="fpreguntas" method="post" name="preguntas" action="pregunta.php?email=<?php echo $email;?>&path=<?php echo $path;?>" method="post" enctype="multipart/form-data">
					E-mail(*):<input type="text"  size="50" id="email" name="email" value=<?php echo '"'.$_GET['email'].'"'?> disabled/><br>
					Enunciado(*): <input type="text" size="80"  id="enunciado" name="enunciado"/><br>
					Respuesta correcta(*): <input type="text" size="80" id="r_correcta" name="r_correcta" /><br>
					Respuesta incorrecta 1(*): <input type="text" size="80"  id="r_inc_1" name="r_inc_1" /><br>
					Respuesta incorrecta 2(*): <input type="text"  size="80" id="r_inc_2" name="r_inc_2" /><br>
					Respuesta incorrecta 3(*): <input type="text"  size="80" id="r_inc_3" name="r_inc_3" /><br>
					Complejidad de la pregunta entre 1 y 5(*): <input type="text"  size="10" id="complejidad" name="complejidad" /><br>
					Tema de la pregunta(*): <input type="text" size="30"  id="tema" name="tema" /><br>
					Imagen relacionada con la pregunta <input typ="uploadedfile" type="file" id="fichero" name="fichero"><br>
					<input type="button" id="submitpregunta" name="submitpregunta" value="Añadir pregunta" onclick="submitPregunta();">
					<input type="button" id="verPreg" name="verPreg" value="Ver Preguntas" onclick="verPreguntas();">
				</form> 				
			</div>
			<div id="resul" style="overflow:scroll; height:80px; width:1120px;"></div>
		</section>
		<footer class='main' id='f1'>
			<?php include "footer.php";?>
		</footer>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript">	


		setInterval(function(){cuantosConectados();},10000); 
		setInterval(function(){cuantasPreguntas();},20000);

		function cuantasPreguntas(){
			// Con JavaScript -> Funciona bien
			// var xhr = new XMLHttpRequest();
			// var email = document.getElementById("email").value;
			// xhr.open("GET", "numeroPreguntas.php?email="+email);
			// xhr.send();

			// xhr.onreadystatechange = function(){
			// 	if (xhr.readyState == 4 && xhr.status == 200){
			// 		document.getElementById("numPreguntas").innerHTML = xhr.responseText;
			// 	}
			// }

			//Con Jquery función $.ajax -> funciona bien
			// $.ajax({
			//     url:'numeroPreguntas.php?email='+ $("#email").val(),
			//     success:function(n){
			//      $('#numPreguntas').fadeIn().html(n);}
			//    });

			//con jquery función $.get
			var jqxhr = $.get("numeroPreguntas.php", {email:$("#email").val()}, function(n){
		    $('#numPreguntas').fadeIn(1000).html(n);
		   });
		} 

		function cuantosConectados(){
			var xhr = new XMLHttpRequest();
			xhr.open("GET", "contador.xml");
			xhr.send();

			xhr.onreadystatechange = function(){
				
				if (xhr.readyState == 4 && xhr.status == 200){
					document.getElementById("personasConectadas").innerHTML = "usuarios conectados: " + xhr.responseText;
				}
			}
		}

		function verPreguntas(){

			var xhr = new XMLHttpRequest();

			xhr.open("GET", "visualizarPreguntas.php");
			xhr.send(null);

			xhr.onreadystatechange = function(){
				document.getElementById("resul").innerHTML="<img src='loading.gif' align='center' width='60px'/>";
				if (xhr.readyState == 4 && xhr.status == 200){
					document.getElementById("resul").innerHTML = xhr.responseText;
				}
			}
		}


		function submitPregunta(){
			var email = document.getElementById("email").value;
            var enunciado = document.getElementById("enunciado").value;
            var r_c = document.getElementById("r_correcta").value;
            var r_i1 = document.getElementById("r_inc_1").value;
            var r_i2 = document.getElementById("r_inc_2").value;
            var r_i3 = document.getElementById("r_inc_3").value;
           	var complejidad = document.getElementById("complejidad").value;
            var tema = document.getElementById("tema").value;

		    xhr = new XMLHttpRequest();
		    var variables = "email="+ email +"&enunciado="+ enunciado +"&r_correcta="+ r_c +"&r_inc_1="+ r_i1 +"&r_inc_2="+ r_i2 +"&r_inc_3="+ r_i3+"&complejidad="+ complejidad+"&tema="+ tema;
		    xhr.open("POST", "guardar.php", true);
		    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		    xhr.send(variables);

		    xhr.onreadystatechange = function(){
		    	document.getElementById("resul").innerHTML="<img src='loading.gif' align='center' width='60px'/>";

		        if(xhr.readyState == 4 && xhr.status == 200){
		            document.getElementById("resul").innerHTML = xhr.responseText;
		            document.getElementById("enunciado").value = "";
		            document.getElementById("r_correcta").value ="";
		            document.getElementById("r_inc_1").value = "";
		            document.getElementById("r_inc_2").value = "";
		            document.getElementById("r_inc_3").value = "";
		            document.getElementById("complejidad").value = "";
		            document.getElementById("tema").value = "";
		        }
		    }		  
		}
	</script>
</body>
</html>
