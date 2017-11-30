<!DOCTYPE html>
<html>
<head>
	<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>¿Olvidó su contraseña?</title>
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
			include "header_nav_unlogged.php";
			if (!isset($_GET["obtenerPass"])){
				echo '<script language="javascript">alert("mmmmm parece que me falta algo en la URL");</script>';
	            header('Location: layout.php');
	        }else{
				session_start();
				if (isset($_SESSION['rol'])) {
		            echo '<script language="javascript">alert("No puedes obtener una nueva pass si estás logeado.");</script>';
		            header('Location: layout.php');
		        }
	        }
			
		?>
		<section class="main" id="s1">
			<div>
				<form id="fOlvidoPw" method="post" name="login" action="olvidoPw.php" method="post" enctype="multipart/form-data">
					Por favor, introduzca su contraseña nueva: </br>
					<div align="center">
					<table>
						<tr> 
							<td>
								<input type="password" size="50"  id="password" name="password" required/><br>
							</td>
							<td>
								<h5 id="passValid"></h5>
							</td>
						</tr>
					</table>
					</div>
				Por favor, verifique la contraseña:</br>
				<input type="password"  size="50" id="password" name="password" required /><br>
					
					<input type="button" id="enviar" name="enviar" value="Modificar" disabled="true" onclick="modifPass();">
					<input type="text" id="passw" name="passw" value=<?php echo '"' . $_GET["obtenerPass"] . '"'?> hidden>
				</form> 
			</div>
			<div id="resultado"></div>
		</section>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script>
			$("#password").change(function(event){
				$.ajax({
					url:'contraseñaChachi.php?password='+ $("#password").val(),
					success:function(n){
						$('#pass').val(n);
						if(n == "VALIDA"){
							$('#passValid').fadeIn().html("Tu contraseña es chachi");
							$("#enviar").prop("disabled", false);
						}else{
							$('#passValid').fadeIn().html("Esa ****** contraseña no sirve");
						}
					}
				});
			});

			function modifPass(){
				var password = document.getElementById("password").value;
	            var passw = document.getElementById("passw").value;

			    xhr = new XMLHttpRequest();
			    var parametros = "password=" + password + "&passw=" + passw ;
			    xhr.open("POST", "cambiarPass.php", true);
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

		<footer class='main' id='f1'>
			<?php include "footer.php";?>
		</footer>
	</div>
</body>
</html>
