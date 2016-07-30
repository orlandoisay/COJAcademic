<?php
	
	session_start();

	if(isset($_SESSION["user"])) {
		header("location: admin-index.php");
		return;
	}

	require_once("conexion.php");

	echo $user = $_POST["user"];
	echo $pass = $_POST["pass"];	

	$manager = new Conexion();
	$result = $manager->db->query("SELECT pass FROM user WHERE handle='$user'");

	if($result->num_rows == 1) { 
		$hashedPass = $result->fetch_array()[0];

		if(password_verify($pass, $hashedPass)) {
			$_SESSION["user"] = $user;
			header("location: admin-index.php");
			return;
		}
	}
	
	header("location: index.php");

?>