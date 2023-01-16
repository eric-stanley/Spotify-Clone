<?php

	require_once realpath(__DIR__ . '/../vendor/autoload.php');
	$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__, '/../.env');
	$dotenv->load();

	ob_start();
	session_start();

	$timezone = date_default_timezone_set("Europe/London");

	$server = getenv('MYSQL_DB_HOST');
	$username = getenv('MYSQL_DB_USERNAME');
	$password = getenv('MYSQL_DB_PASSWORD');
	$db = getenv('MYSQL_DB_NAME');
	$port = getenv('MYSQL_DB_PORT');

	$con = new mysqli($server, $username, $password, $db, $port);

	if (mysqli_connect_errno()) {
		echo "Failed to connect: " . mysqli_connect_errno();
	}

?>
