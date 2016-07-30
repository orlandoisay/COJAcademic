<?php

	session_start();

	require_once("conexion.php");

	$manager = new Conexion();
	$result = $manager->db->query("SELECT * FROM contest");

	function dFormat($str) {
		$date = date_create($str);
		return date_format($date, "j M, H:i");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>COJ ACADEMIC | Contest view</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
	<div class="wrapper">
		<h1 class="title"><b>COJ</b> ACADEMIC | Inicio </h1>	
		<div class="main">			
			<div class="contests">
				<h1>Concursos actuales</h1>
				<div class="menu">
					<a href="#">Nuevo</a>
					<a href="#">Editar</a>
				</div>
				<table class="contests-table">
					<tr class="contests-table-header">
						<th width="68%">Concurso</th>
						<th width="10%">Inicio</th>
						<th width="10%">Fin</th>
						<th width="12%"></th>
					</tr>
					<?php while($row = $result->fetch_array()):?>
					<tr>
						<?php $data = json_decode($row[1]); ?>
						
						<td><?php echo $data->name; ?></td>
						<td><?php echo dFormat($data->start); ?></td>
						<td><?php echo dFormat($data->end); ?></td>
						<td><a href="contest.php?id=<?php echo $row[0]; ?>">Ver</a></td>
					</tr>
					<?php endwhile; ?>
				</table>
			</div>
			<div class="sidebar">
				<?php if(!isset($_SESSION["user"])): ?>
				<h2>Iniciar sesi&oacute;n</h2>
				<form name="login" method="POST" action="login.php">
					<input type="text" name="user" placeholder="Usuario">
					<input type="password" name="pass" placeholder="Contrase&ntilde;a">
					<input type="submit" value="Entrar">
				</form>
				<?php else: ?>
				<h2>Cuenta</h2>
				<p>Bienvenido <b><?php echo $_SESSION["user"]; ?></b>.</p>
				<a href="admin-index.php">Administrar concursos</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
	
</body>
</html>