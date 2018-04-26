<?php
	$hostname = 'localhost';
	$username = 'id5396633_alwice';
	$password = 'oriharaizaya';
	$db_name = 'id5396633_sbh_tcm';

	$conn = mysqli_connect($hostname, $username, $password,$db_name);
	mysqli_set_charset($conn, "utf8");
	
	//check connection
	if(mysqli_connect_errno()){
		echo "unable to connect to MySQL";
	}
?>