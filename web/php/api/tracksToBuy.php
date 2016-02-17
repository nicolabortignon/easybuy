<?php 
	require(dirname(__FILE__).'/../dbConnection.php');

	if ($_GET) {
  try {
    if (!isset($_GET['userId']))
      throw new Exception("No user id");

    $userId = $_GET['userId'];
    $querySQL = "SELECT * FROM gigs where gigs.userRequester != ".$userId." AND NOT EXISTS (SELECT * FROM purcheasedTracks where idUser = ".$userId." AND gigs.id = purcheasedTracks.idGig)";

    $result = $mysqli->query($querySQL);
    echo json_encode( $result->fetch_all( MYSQLI_ASSOC ) );

    $mysqli->close();

  }
  catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;  
  }
}

	
?>