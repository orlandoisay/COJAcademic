<?php

	session_start();

	if(!isset($_SESSION["user"])) {
		header("Location: index.php");
		return;
	}

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
	<script src="js/admin-index.js"></script>
</head>
<body>
	<div class="wrapper">
		<?php 
			require_once('header.php');
			head("Administraci&oacute;n de concursos");
		?>
		<div class="main">			
			<div class="contests">
				<div class="menu">
					<a id="new-contest" href="create-contest.php">Nuevo</a>
					<a id="edit-contest" href="#">Editar</a>
				</div>
				<table class="contests-table">
					<tr class="contests-table-header">
						<th></th>
						<th width="80%">Concurso</th>
						<th width="10%">Scoreboard</th>
					</tr>
					<?php while($row = $result->fetch_array()):?>
					<tr>
						<?php $data = json_decode($row[1]); ?>
						<td>
							<input class="sel" type="radio" name="sel" value="<?php echo $row[0]; ?>">
							<label for="option"></label>
						</td>
						<td><?php echo $data->name; ?></td>
						<td><a href="contest.php?id=<?php echo $row[0]; ?>">Ir</a></td>
					</tr>
					<?php endwhile; ?>
				</table>
			</div>
			<?php require_once('sidebar.php'); ?>
		</div>
	</div>
	<?php require_once('footer.php'); ?>
</body>
</html>