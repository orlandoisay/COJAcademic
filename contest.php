<!DOCTYPE html>
<html>
<head>
	<title>COJ ACADEMIC | Contest view</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/contest.css">
	<script type="text/javascript" src="js/contest.js"></script>
</head>
<body>
	<div class="wrapper">
		<h1 class="title"><b>COJ</b> ACADEMIC | Concurso</h1>	
		<div class="main">			
			<div class="scoreboard">
				<h1 class="contest-name"><?php echo $_GET['id']; ?></h1>
				<table class="scoreboard-table">
					
				</table>
			</div>
			<div class="sidebar">
				<div class="clock">
					<h1></h1>
				</div>
				<div class="top-three">
					<h1>Top 3</h1>
					<div class="first-place">
						<img src="">
						<h2></h2>						
					</div>
					<div class="second-place">						
						<img src="">
						<h2></h2>
					</div>
					<div class="third-place">						
						<img src="">
						<h2></h2>
					</div>					
				</div>
				<div class="fastest">
					<h1>Primer AC</h1>	
					<div class="fastest-place">						
						<img src="">
						<h2></h2>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>