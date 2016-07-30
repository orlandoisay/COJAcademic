<?php

 	require_once('config.php');

 	class Conexion {
 		public $db;

 		public function __construct() {
 			$this->db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

 			if($this->db->connect_errno) {
 				echo "Error al conectar con la base de datos";
 				return;
 			}
 		}
 	}

?>