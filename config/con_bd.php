<?php

	//define("DB_HOST","");
$DB_HOST = "br1048.hostgator.com.br"; 
	$DB_PORT = "3306"; 
	$DB_USER = "andre990";
	$DB_PASS = "4@002892Aa";
	$DB_NAME = "andre990_controle_gastos";
	
	$conn = null;
	
	try {
		$conn = 
		mysqli_connect($DB_HOST.":".$DB_PORT,
		              $DB_USER, $DB_PASS);
		mysqli_select_db($conn, $DB_NAME);
	} catch (Exception $e) {
		$error_conn_db = $e->getMessage();
	}