<?php 
	require(dirname(__FILE__).'/../dbConnection.php');
	require(dirname(__FILE__).'/../lib/auth.class.php');

	$auth = new auth();
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	echo $auth->login($username, $password);
	
?>