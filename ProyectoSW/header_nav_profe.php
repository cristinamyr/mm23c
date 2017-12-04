
<header class='main' id='h1'>
	<span class="right"><a href="Logout.php">Logout</a> <?php if ($_SESSION['path']=="si") echo '<img src="imagenusuario/'.$_SESSION['email'].'" id="imagenUsr" height="40px"/>'; else echo $_SESSION['email'];?></span> 
	<h2>Quiz: el juego de las preguntas</h2>
</header>
<nav class='main' id='n1' role='navigation'>
	<span><a href='layout.php'>Inicio</a></spam>
	<span><a href='RevisarPreguntas.php'>Revisar Preguntas</a></spam>
	<span><a href='creditos.php'>Creditos</a></spam>
</nav>
			