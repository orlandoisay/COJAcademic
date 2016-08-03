<?php

	require_once("conexion.php");

	$id = $_REQUEST["id"];
	$data = $_REQUEST["data"];	

	$manager = new Conexion();

	$query = "UPDATE contest SET data='$data' WHERE id='$id'";
	$result = $manager->db->query($query);

	echo '{ "result": '.(($result == true)?'"success"':'"failed"').' }';	

?>