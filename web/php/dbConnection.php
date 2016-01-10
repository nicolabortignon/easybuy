<?php
if(getenv('MYSQL_USER') === false){
	include_once(dirname(__FILE__).'/../../settings');
}
$ip = '74.124.204.215';
$user = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');
$database = getenv('MYSQL_DB');

$mysqli = new mysqli($ip, $user, $password, $database);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>