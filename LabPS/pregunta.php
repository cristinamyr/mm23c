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
					<input type="submit" id="enviar" name="enviar">
				</form> 
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

				if(isset($_POST['enunciado'])){
					if(valoresCompletos()){

						include "conexion.php";

						$email = trim($_GET['email']);
						$enuc = $_POST['enunciado'];
						$r_c = $_POST['r_correcta'];
						$r_i1 = $_POST['r_inc_1'];
						$r_i2 = $_POST['r_inc_2'];
						$r_i3 = $_POST['r_inc_3'];
						$complejidad = $_POST['complejidad'];
						$tema = $_POST['tema'];

						if ($_FILES["fichero"]["type"]){
						    $imagen=mysqli_real_escape_string($conn, file_get_contents($_FILES["fichero"]["tmp_name"]));
						    $sql = "INSERT INTO Preguntas (email, enunciado, r_c, r_i1, r_i2, r_i3, complejidad, tema, foto) VALUES ('$email', '$enuc', '$r_c', '$r_i1', '$r_i2', '$r_i3', '$complejidad', '$tema','$imagen')";
						}else{
						    $sql = "INSERT INTO Preguntas (email, enunciado, r_c, r_i1, r_i2, r_i3, complejidad, tema) VALUES ('$email', '$enuc', '$r_c', '$r_i1', '$r_i2', '$r_i3', '$complejidad', '$tema')";
						}

						if (mysqli_query($conn, $sql)){
						    echo "La pregunta se ha añadido correctamente en nuestra base de datos. Gracias por su colaboración <br>";
						    echo "Si desea ver las preguntas que forman la base de datos, por favor, pulse ";
						    echo '<a href="VerPreguntas.php?email='.$email.'&path='.$path.'">aqui</a>';
						}else{
						    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						    echo "Como puede observar ha habido un problema al añadir la pregunta en la base de datos. <br>";
						}

						mysqli_close($conn); 

					}else{
						echo "La que has liado pollito, hay algún campo incorrecto. Vuelve a intentar rellenar el formulario.";
					}				
				}
			?>
			</div>
		</section>
		<footer class='main' id='f1'>
			<?php include "footer.php";?>
		</footer>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript">
		$("#fichero").click(function(event){

			$("input[type=file]").change(function(event) {
		        readURL(this);
		    });
		    if(!$("#imagen").length){
				var $foto = $('<img id="imagen" src="" alt="imagen seleccionada por el usuario" heigth="100px">');
						    
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
	    		$('#fichero').val("");} );
		    }
		});
	</script>
</body>
</html>
