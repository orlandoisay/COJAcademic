<?php

	if(count($argv) == 1)
		return;

	require_once("conexion.php");

	$id = $argv[1];

	$manager = new Conexion();
	$result = $manager->db->query("SELECT data FROM contest WHERE id='$id'");

	if($result->num_rows == 0)
		return;

	$raw = $result->fetch_array()[0];
	$data = json_decode($raw);

	$start = strtotime($data->start);
	$end = strtotime($data->end);

	$url = "http://coj.uci.cu/api/judgment";
	$handler = curl_init($url);	
	curl_setopt($handler, CURLOPT_RETURNTRANSFER, 1);

	foreach($data->contestants as &$cnt) {  
		$pts = 0; 
		$penalty = 0;

		for($i=0;$i<count($data->problems);$i++) { 
			$params = array('username' => $cnt->user, 'pid' => $data->problems[$i]);
			$query = http_build_query($params);

			curl_setopt($handler, CURLOPT_URL, "$url?$query");

			$rawUserSub = curl_exec($handler);
			$userSub = json_decode($rawUserSub);

			$minute = -1;
			$NSubs = 0;

			for($s=0;$s<count($userSub);$s++) {
				$subDate = strtotime($userSub[$s]->date);

				if($start <= $subDate && $subDate <= $end) {
					$NSubs++;
					if($userSub[$s]->judgment == "Accepted") 
						$minute = ceil(abs($subDate - $start)/60.0);
				}
			}

			$cnt->submissions[$i] = [$minute,$NSubs];

			if($minute != -1) {
				$pts++;
				$penalty += $minute + 20 * ($NSubs-1);
			}
		}
		$cnt->score->pts = $pts;
		$cnt->score->penalty = $penalty;
	}

	curl_close($handler);

	/**
	 * Compares two users.
	 * First compares the number of problems solved.
	 * Second compares the penalty.
	 * Finally compares by the username
	 *
	 * Return -1 if $a has a higher score than $b. Otherwise
	 * return 1
	 */
	function higher($a, $b) {
		if($a->score->pts == $b->score->pts) {
			if($a->score->penalty == $b->score->penalty) {
				return strcasecmp($a->user,$b->user);
			}
			return ($a->score->penalty < $b->score->penalty) ? -1 : 1;
		}
		return ($a->score->pts > $b->score->pts) ? -1 : 1;
	}

	usort($data->contestants, "higher");

	$data->lastUpdate = date("Y-m-d H:i:s");

	$jsonData = json_encode($data);

	$manager->db->query("UPDATE contest SET data = '$jsonData' WHERE id='$id'");

?>