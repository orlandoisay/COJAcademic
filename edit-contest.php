<?php
	
	session_start();

	if(!isset($_SESSION["user"])) {
		header("Location: index.php");
		return;
	}

	require_once("conexion.php");

	$id = $_GET["id"];

	$manager = new Conexion();
	$result = $manager->db->query("SELECT * FROM contest WHERE id = '$id' LIMIT 1");

	$row = $result->fetch_array();
	$data = json_decode($row[1]);

?>
<!DOCTYPE html>
<html>
<head>
	<title>COJ ACADEMIC | Crear concurso</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/create-contest.css">
	<script type="text/javascript" src="js/edit-contest.js"></script>
	<script>
		var data = JSON.parse('<?php echo $row[1]; ?>');

		window.onload = function() {
			for(var i=0;i<data.problems.length;i++) 
				addProblem(data.problems[i]);
			
			for(var i=0;i<data.contestants.length;i++) {
				var usr = data.contestants[i].user;
				var txtName = document.getElementById('user');
				txtName.value = usr;
				addUser(usr);
			}	
		}		
	</script>
</head>
<body>
	<div class="wrapper">
		<?php 
			require_once('header.php');
			head("Editar concurso");
		?>
		<div class="main">		
			<table>
				<tr>
					<td>
						<label>Alias: </label><br>
						<input type="text" id="contest-id" value="<?php echo $row[0]; ?>" disabled>
						<p>
							Es la clave corta que aparece en la URL.<br> No puede contener espacios en blanco
							ni caracteres especiales.
						</p>
					</td>
					<td>
						<label>Nombre: </label><br>
						<input type="text" id="contest-name" value="<?php echo $data->name; ?>">
					</td>
				</tr>
				<tr>
					<td>
						<label>Inicio: </label><br>
						<input type="text" id="contest-start-date" value="<?php echo $data->start; ?>">
						<p>
							Hora local (YYYY-MM-DD hh:mm:ss).
						</p>
					</td>
					<td>
						<label>Fin: </label><br>
						<input type="text" id="contest-end-date" value="<?php echo $data->end; ?>">
						<p>
							Hora local (YYYY-MM-DD hh:mm:ss).
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<label>Problemas: </label><br>
						<input type="text" id="problem" class="add" placeholder="Id del problema." maxlength="4">
						<button id="add-problem" class="add"><p>+</p></button>
						<div class="list">
							<div class="list-container">
							</div>
						</div>
					</td>
					<td>
						<label>Concursantes: </label><br>
						<input type="text" id="user" class="add" placeholder="Usuario">
						<button id="add-user" class="add"><p>+</p></button>
						<ul class="options"></ul>
						<div class="list">
							<div class="list-container"></div>
						</div>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" id="create-contest" value="Guardar cambios">
					</td>
				</tr>
			</table>	
			<div class="sidebar">
				<h2>Consejos</h2>
			</div>
		</div>
	</div>
</body>
</html>