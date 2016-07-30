<?php
	// set_time_limit(300);

	$pid = $_REQUEST["pid"];	

	$url = "http://coj.uci.cu/api/problem?pattern=$pid&classification=-1&complexity=-1&filterby=0";
	
	$handler = curl_init($url);	
	curl_setopt($handler, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($handler, CURLOPT_URL, $url);

	$raw = curl_exec($handler);
	$data = json_decode($raw);

	$founded = false;

	foreach ($data as $prob) {
		if($prob->pid == $pid) {
			echo json_encode($prob);
			$founded = true;
		}
	}

	if($founded == false) {
		echo '{"error":"not founded"}';
	}

	curl_close($handler);
?>