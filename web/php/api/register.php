<?php 
	require(dirname(__FILE__).'/../dbConnection.php');
	require(dirname(__FILE__).'/../lib/auth.class.php');

	$auth = new auth();
	var_dump($auth->register('test1234', 'bl111u', 'bl111u', 'info@nicolabortignon.com'));






?>