<?php 
	require(dirname(__FILE__).'/../dbConnection.php');
	require(dirname(__FILE__).'/../lib/auth.class.php');
	require(dirname(__FILE__).'/../lib/currency.class.php');
	require(dirname(__FILE__).'/../lib/user.class.php');
	$auth = new auth();
	$currency = new currency();
	$user = new user();
	 
		$auth_session_hash = $_COOKIE["auth_session"];
		$authSession = $auth->sessioninfo($auth_session_hash);
		$authUserId = $authSession['uid'];
		$user = $user->retriveUser($authUserId);
		$userCurrency = $currency->retrieveCurrency($user['currency']);
		$userInfo = array();
		$userInfo['username'] =  $auth->sessioninfo($auth_session_hash)['username'];
		$userInfo['uid'] =  $auth->sessioninfo($auth_session_hash)['uid'];

		if ($result = $mysqli->query("SELECT totalMoney FROM users WHERE id=".$userInfo['uid'])) {

    /* fetch object array */
    $obj = $result->fetch_object();
    $userInfo['totalMoney'] = $obj->totalMoney;

    $result->close();
}




		echo json_encode($userInfo);

	
?>