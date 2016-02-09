<?php

$ip = '127.0.0.1:8889';
$user = 'root';
$password = 'root';
$database = 'nucleo5_easybuy';

$mysqli = new mysqli($ip, $user, $password, $database);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>