<?php

	//define("DB_HOST","");
	$DB_HOST = "localhost";
	$DB_PORT = "3307";
	$DB_USER = "root";
	$DB_PASS = "";
	$DB_NAME = "pawi";
	
	$conn = null;
	
	try {
		$conn = 
		mysqli_connect($DB_HOST.":".$DB_PORT,
		              $DB_USER, $DB_PASS);
		mysqli_select_db($conn, $DB_NAME);
	} catch (Exception $e) {
		$error_conn_db = $e->getMessage();
	}