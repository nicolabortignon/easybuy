<?php
include_once(dirname(__FILE__).'/../../../user_settings');
include_once(dirname(__FILE__).'/../i18n/en.php');

class user
{  
	public $mysqli;

	function __construct()
	{
		$this->mysqli = $GLOBALS['mysqli'];
	}

	
	function retriveUser($id)
	{
		$query = $this->mysqli->prepare("SELECT id, username, currency FROM users WHERE id = ?");
		$query->bind_param("s", $id);
		$query->bind_result($user['id'], $user['username'], $user['currency']);
		$query->execute();
		$query->store_result();
		$count = $query->num_rows;
		$query->fetch();
		$query->close();

		return $user;
	}
}

?>