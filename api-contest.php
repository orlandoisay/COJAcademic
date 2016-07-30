<?php
	set_time_limit(300);

	require_once("conexion.php");

	$id = $_REQUEST["id"];	

	$manager = new Conexion();
	$result = $manager->db->query("SELECT data FROM contest WHERE id='$id'");

	// The contest doesn't exist
	if($result->num_rows == 0) { 
		echo '{"error":"not founded"}';
	}
	else {
		$raw = $result->fetch_array()[0];
		$data = json_decode($raw);

		$mCurrent = min(strtotime($data->end),strtotime("now")); // Minimum between the end and the current date
		$last = strtotime($data->lastUpdate);
		$diff = $mCurrent - $last;
		$diffMin = floor($diff / 60.0); // Difference in minutes between the mCurrent and the last update.


		if($last < $mCurrent && $diffMin >= 5) {
			updateData($id);			
		} 
		echo $raw;
	}
	

	function updateData($data) {
		exec("php update-contest.php $data 2>&1");
	}
?>