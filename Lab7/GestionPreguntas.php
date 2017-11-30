<!DOCTYPE html>
<html>
<head>
	<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="UTF-8">
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
	        include "insertarNav.php";
	        if(!isset($_SESSION['email'])) header('Location: Login.php');
	        else{
	        	if($_SESSION['rol'] != "estudiante") {
	            	echo '<script language="javascript">alert("Para acceder a este contenido debes estar logeado");</script>';
	            	header('Location: layout.php');
	        	}
	        }
        	
	         

	    ?>
		<section class="main" id="s1">
			<p id="personasConectadas" align="center">...</p>
			<p id="numPreguntas" align="center">...</p>
			<div>
				<form id="fpreguntas" method="post" name="preguntas" >
					E-mail(*):<input type="text"  size="50" id="email" name="email" value=<?php echo '"'.$_SESSION['email'].'"'?> disabled/><br>
					Enunciado(*): <input type="text" size="80"  id="enunciado" name="enunciado" required/><br>
					Respuesta correcta(*): <input type="text" size="80" id="r_correcta" name="r_correcta" required/><br>
					Respuesta incorrecta 1(*): <input type="text" size="80"  id="r_inc_1" name="r_inc_1" required/><br>
					Respuesta incorrecta 2(*): <input type="text"  size="80" id="r_inc_2" name="r_inc_2" required/><br>
					Respuesta incorrecta 3(*): <input type="text"  size="80" id="r_inc_3" name="r_inc_3" required/><br>
					Complejidad de la pregunta entre 1 y 5(*): <input type="text"  size="10" id="complejidad" name="complejidad" pattern="[1-5]{1}" required/><br>
					Tema de la pregunta(*): <input type="text" size="30"  id="tema" name="tema" required/><br>
					Imagen relacionada con la pregunta <input typ="uploadedfile" type="file" id="fichero" name="fichero"><br>
					<input type="button" id="submitpregunta" name="submitpregunta" value="Añadir pregunta" onclick="submitPregunta();">
					<input type="button" id="verPreg" name="verPreg" value="Ver Preguntas" onclick="verPreguntas();">
				</form> 				
			</div>
			<div id="resul"></div>
		</section>
		<footer class='main' id='f1'>
			<?php include "footer.php";?>
		</footer>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript">	
		setInterval(function(){cuantosConectados();},1000); 
		setInterval(function(){cuantasPreguntas();},2000);

		function cuantasPreguntas(){
			$.ajax({
				url:'numeroPreguntas.php?email='+ $("#email").val(),
				success:function(n){
					$('#numPreguntas').fadeIn().html(n);}
			});
		} 

		function cuantosConectados(){
			var xhr = new XMLHttpRequest();
			xhr.open("GET", "contador.xml");
			xhr.send();

			xhr.onreadystatechange = function(){
				if (xhr.readyState == 4 && xhr.status == 200){
					document.getElementById("personasConectadas").innerHTML = "Usuarios conectados: " + xhr.responseText;
				}
			}
		}

		function verPreguntas(){
			quitar_foto();
			var xhr = new XMLHttpRequest();

			xhr.open("GET", "visualizarPreguntas.php");
			xhr.send(null);

			xhr.onreadystatechange = function(){
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
            var fichero = document.getElementById("fichero").value;

		    xhr = new XMLHttpRequest();
		    var variables = "email="+ email +"&enunciado="+ enunciado +"&r_correcta="+ r_c +"&r_inc_1="+ r_i1 +"&r_inc_2="+ r_i2 +"&r_inc_3="+ r_i3+"&complejidad="+ complejidad+"&tema="+ tema+"&fichero"+fichero;
		    xhr.open("POST", "guardar.php", true);
		    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		    xhr.send(variables);

		    xhr.onreadystatechange = function(){
		    	document.getElementById("resul").innerHTML="<img src='loading.gif' align='center' width='60px'/>";

		        if(xhr.readyState == 4 && xhr.status == 200){
		            document.getElementById("resul").innerHTML = xhr.responseText;
		        }
		    }		  
		}

		function quitar_foto(){
			$("#imagen").remove();
			$("#resetImg").remove();
			delete $('#imagen');
		    delete $('#resetImg');
		  	$('#fichero').val("");
		}

		$("#fichero").click(function(event){

			$("input[type=file]").change(function(event) {
		        readURL(this);
		    });
		    if(!$("#imagen").length){
				$("#preguntas").remove();

				var $foto = $('<img id="imagen" src="" alt="imagen seleccionada por el usuario" width="250px">');
						    
	 			$("#fpreguntas").append($foto);
	 		}
		   
		    const readURL = (input) => {
 
		        if (input.files && input.files[0]) {
		            const reader = new FileReader();
		 
		            reader.onload = (e) => {
		                $('#imagen').attr('src', e.target.result);
		            }
		            reader.readAsDataURL(input.files[0]);
		       	}
			
			}
	    	
	        if(!$("#resetImg").length){
	        	var input = $("<input/>", {
					  type: "button",
					  id: "resetImg",
					  name: "quitar imagen",
					  value: "quitar imagen" 
				});
				$("#fpreguntas").append(input);	

		        $("#resetImg").bind("click", function(){ 
					$("#imagen").remove();
					$("#resetImg").remove();
					delete $('#imagen');
		    		delete $('#resetImg');
		    		$('#fichero').val("");
		    	});
		    }
		});
	</script>
</body>
</html>
