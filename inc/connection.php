<?php

    date_default_timezone_set('Asia/Colombo'); 

	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'recording_studio'; 

	$connection = mysqli_connect('localhost', 'root', '', 'recording_studio');

	// Checking the connection
	if (mysqli_connect_errno()) {
		die('Database connection failed ' . mysqli_connect_error());
	}

?>