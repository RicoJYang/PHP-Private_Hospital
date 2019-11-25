<?php	
	error_reporting(E_ALL ^ E_NOTICE);
	ini_set('display_errors', '1');
	
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "rootroot";
	$dbdatabase = "hospital";

	$conx = mysqli_connect($dbhost, $dbuser, $dbpass, $dbdatabase);
?>	
