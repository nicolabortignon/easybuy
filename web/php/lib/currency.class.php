<?php
include_once(dirname(__FILE__).'/../../../user_settings');
include_once(dirname(__FILE__).'/../i18n/en.php');

class currency
{  
	public $mysqli;

	function __construct()
	{
		$this->mysqli = $GLOBALS['mysqli'];
	}

	
	function retrieveCurrency($id)
	{
		$query = $this->mysqli->prepare("SELECT id, name, symbol FROM currencies WHERE id = ?");
		$query->bind_param("s", $id);
		$query->bind_result($currency['id'], $currency['name'], $currency['symbol']);
		$query->execute();
		$query->store_result();
		$count = $query->num_rows;
		$query->fetch();
		$query->close();

		return $currency;
	}
}

?>