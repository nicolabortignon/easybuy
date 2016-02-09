<?php 
	require(dirname(__FILE__).'/../dbConnection.php');
	require(dirname(__FILE__).'/../lib/auth.class.php');

	$auth = new auth();
	
	$username = $_POST["email"];
	$email = $username;
	$password = $_POST["password"];
	$reEntryPassword = $password;
	$currency = $_POST["currency"];

	$auth->register($username, $password, $reEntryPassword, $email, $currency);






?>