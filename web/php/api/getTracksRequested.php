<?php
require(dirname(__FILE__).'/../dbConnection.php');

if ($_GET) {
  try {
    if (!isset($_GET['userId']))
      throw new Exception("No user id");

    $userId = $_GET['userId'];
    $result = $mysqli->query("SELECT * FROM gigs WHERE userRequester=".$userId);
    echo json_encode( $result->fetch_all( MYSQLI_ASSOC ) );

    $mysqli->close();

  }
  catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;  
  }
}
?>
