<link rel="stylesheet" href="css/sidebar.css">
<div class="sidebar">
	<?php if(!isset($_SESSION["user"])): ?>
	<h2>Iniciar sesi&oacute;n</h2>
	<form name="login" method="POST" action="login.php">
		<input type="text" name="user" placeholder="Usuario">
		<input type="password" name="pass" placeholder="Contrase&ntilde;a">
		<input type="submit" value="Entrar">
	</form>
	<?php else: ?>
	<h2>Menu</h2>
	<ul class="menu">
		<li><a href="index.php">Inicio</a></li>
		<li><a href="admin-index.php">Administrar concursos</a></li>
		<li><a href="logout.php">Salir</a></li>
	</ul>
	<?php endif; ?>
</div>