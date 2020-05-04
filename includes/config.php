<?php

	ob_start();
	session_start();

	$timezone = date_default_timezone_set("Europe/London");

	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

	$server = $url["host"];
	$username = $url["user"];
	$password = $url["pass"];
	$db = substr($url["path"], 1);

	$con = new mysqli_connect($server, $username, $password, $db);
	// $con = mysqli_connect("localhost", "root", "", "spotify");

	if (mysqli_connect_errno()) {
		echo "Failed to connect: " . mysqli_connect_errno();
	}

?>
