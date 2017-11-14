
<header class='main' id='h1'>
	<span class="right"><a href="Logout.php">Logout</a> <?php if ($path=="si") echo '<img src="imagenusuario/'.$email.'" id="imagenUsr" height="40px"/>'; else echo $email;?></span> 
	<h2>Quiz: el juego de las preguntas</h2>
</header>
<nav class='main' id='n1' role='navigation'>
	<span><a href='layout.php?email=<?php echo $email;?>&path=<?php echo $path;?>'>Inicio</a></spam>
	<span><a href='GestionPreguntas.php?email=<?php echo $email;?>&path=<?php echo $path;?>'>Gestion Preguntas</a></spam>
	<span><a href='VerPreguntas.php?email=<?php echo $email;?>&path=<?php echo $path;?>'>Ver Preguntas BD</a></spam>
	<span><a href='creditos.php?email=<?php echo $email;?>&path=<?php echo $path;?>'>Creditos</a></spam>
</nav>
		