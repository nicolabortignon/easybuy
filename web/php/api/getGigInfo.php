<?php
require(dirname(__FILE__).'/../dbConnection.php');

if ($_GET) {
  try {
    if (!isset($_GET['idGig']))
      throw new Exception("No user id");

    $idGig = $_GET['idGig'];
    $result = $mysqli->query("SELECT * FROM gigs WHERE id=".$idGig);
    echo json_encode( $result->fetch_all( MYSQLI_ASSOC ) );

    $mysqli->close();

  }
  catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;  
  }
}
?>
