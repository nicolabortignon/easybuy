<?php
require(dirname(__FILE__).'/../dbConnection.php');

if ($_GET) {
  try {
    if (!isset($_GET['userId']))
      throw new Exception("No user id");

    $username = 86;
    $result = $mysqli->query("SELECT * FROM gigs WHERE userRequester=".$username);
    echo json_encode( $result->fetch_all( MYSQLI_ASSOC ) );

    $result->close();
    $mysqli->close();

  }
  catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;  
  }
}
?>
