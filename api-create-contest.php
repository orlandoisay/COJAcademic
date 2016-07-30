<?php

	require_once("conexion.php");

	$id = $_REQUEST["id"];
	$data = $_REQUEST["data"];	

	$manager = new Conexion();

	$query = "INSERT INTO contest VALUES('$id', '$data')";
	$result = $manager->db->query($query);

	echo '{ "result": '.(($result == true)?'"success"':'"failed"').' }';	

?>