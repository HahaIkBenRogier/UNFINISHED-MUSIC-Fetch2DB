<?php
	$servername = "127.0.0.1:8889";
	$username = "root";
	$password = "root";
	$dbname = "lbi";
	
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	date_default_timezone_set("UTC");
	$conn->set_charset('utf8mb4');       // object oriented style
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
?>