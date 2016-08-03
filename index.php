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
		<?php 
			require_once('header.php');
			head("Inicio");
		?>
		<div class="main">			
			<div class="contests">
				<h1>Concursos actuales</h1>
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
			<?php require_once('sidebar.php'); ?>
		</div>
	</div>
	<?php require_once('footer.php'); ?>
</body>
</html>