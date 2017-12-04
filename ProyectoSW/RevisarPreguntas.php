<!DOCTYPE html>
<html>
<head>
	<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Registro</title>
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
			if(!isset($_SESSION['email'])){
				echo '<script language="javascript">alert("Ups! Inicia sesión para ver este contenido!");';
	            echo "window.location = 'layout.php'";
				echo '</script>';
			} 
			if (!($_SESSION['rol']=="profe")) {
	            echo '<script language="javascript">alert("Ups! Esta página es sólo para PROFESORES!");';
	            echo "window.location = 'layout.php'";
				echo '</script>';
	        }
	    ?>
		<section class="main" id="s1">
			<div>
				<form id="fObtenerNumPreg" name="obtenerNumPreg" method="get">
					<select id="id">
						<?php 

							include "conexion.php";

							$result = mysqli_query($conn, "SELECT * FROM Preguntas");
							
							while($row = mysqli_fetch_row($result)){
								echo "<option value='".$row[0]."'>".$row[2]."</option>";
							}

						?>
				    </select>
					<input type="button" id="buscar" name="buscar" value="Buscar pregunta"/>
				</form>
			</div>
			<div id="resultado"></div>
		</section>
		<footer class='main' id='f1'>
			<?php include "footer.php";?>
		</footer>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript">

		$("#buscar").click(function(event){
			$.ajax({
				url:'ObtenerPregunta.php?id='+ $("#id").val(),
				success:function(pregunta){
					$("#resultado").fadeIn().html(pregunta);			
				}
			});
		});

		function elimPreg(){
			var id = document.getElementById("id").value;

		    xhr = new XMLHttpRequest();
		    var parametros = "id=" + id;
		    xhr.open("POST", "eliminarPregunta.php", true);
		    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		    xhr.send(parametros);

		    xhr.onreadystatechange = function(){
		    	document.getElementById("resultado").innerHTML="<img src='loading.gif' align='center' width='60px'/>";

		        if(xhr.readyState == 4 && xhr.status == 200){
		            document.getElementById("resultado").innerHTML = xhr.responseText;
		        }
		    }		  
		}

		function modifPreg(){
			var id = document.getElementById("id").value;
			var email = document.getElementById("email").value;
            var enunciado = document.getElementById("enunciado").value;
            var r_correcta = document.getElementById("r_correcta").value;
            var r_inc_1 = document.getElementById("r_inc_1").value;
            var r_inc_2 = document.getElementById("r_inc_2").value;
            var r_inc_3 = document.getElementById("r_inc_3").value;
           	var complejidad = document.getElementById("complejidad").value;
            var tema = document.getElementById("tema").value;

		    xhr = new XMLHttpRequest();
		    var parametros = "id=" + id + "&email=" + email + "&enunciado=" + enunciado + "&r_correcta=" + r_correcta + "&r_inc_1="+ r_inc_1 + "&r_inc_2=" + r_inc_2 + "&r_inc_3=" + r_inc_3 + "&complejidad=" + complejidad + "&tema=" + tema;
		    xhr.open("POST", "modificarPregunta.php", true);
		    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		    xhr.send(parametros);

		    xhr.onreadystatechange = function(){
		    	document.getElementById("resultado").innerHTML="<img src='loading.gif' align='center' width='60px'/>";

		        if(xhr.readyState == 4 && xhr.status == 200){
		            document.getElementById("resultado").innerHTML = xhr.responseText;
		        }
		    }		  
		}

	</script>
</body>
</html>
