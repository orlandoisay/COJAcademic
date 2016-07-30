<!DOCTYPE html>
<html>
<head>
	<title>COJ ACADEMIC | Crear concurso</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/create-contest.css">
	<script type="text/javascript" src="js/create-contest.js"></script>
</head>
<body>
	<div class="wrapper">
		<h1 class="title"><b>COJ</b> ACADEMIC | Crear concurso</h1>	
		<div class="main">		
			<table>
				<tr>
					<td>
						<label>Alias: </label><br>
						<input type="text" id="contest-id">
						<p>
							Es la clave corta que aparece en la URL.<br> No puede contener espacios en blanco
							ni caracteres especiales.
						</p>
					</td>
					<td>
						<label>Nombre: </label><br>
						<input type="text" id="contest-name">
					</td>
				</tr>
				<tr>
					<td>
						<label>Inicio: </label><br>
						<input type="datetime-local" id="contest-start-date">
						<p>
							Hora local (YYYY-MM-DD hh:mm:ss).
						</p>
					</td>
					<td>
						<label>Fin: </label><br>
						<input type="datetime-local" id="contest-end-date">
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
						<input type="submit" id="create-contest" value="Crear concurso">
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