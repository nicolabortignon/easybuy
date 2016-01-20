<?php 
	require(dirname(__FILE__).'/../dbConnection.php');
	require(dirname(__FILE__).'/../lib/auth.class.php');
	require(dirname(__FILE__).'/../lib/currency.class.php');
	require(dirname(__FILE__).'/../lib/user.class.php');

	$auth = new auth();
	$currency = new currency();
	$user = new user();

	$auth_session_hash =  $_COOKIE["auth_session"];

	$authSession = $auth->sessioninfo($auth_session_hash);
	$authUserId = $authSession['uid'];
	$user = $user->retriveUser($authUserId);
	$userCurrency = $currency->retrieveCurrency($user['currency']);
	
	echo var_dump($userCurrency);
	echo json_encode($auth->sessioninfo($auth_session_hash));
?>