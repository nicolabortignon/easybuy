<?php
require(dirname(__FILE__).'/../dbConnection.php');


  try {
   
    $result = $mysqli->query("SELECT *, purcheasedTracks.id as purcheasedTracksId FROM purcheasedTracks Inner join users on idUser = users.id Inner Join gigs on gigs.id = idGig WHERE confirmed= 0");
    echo json_encode( $result->fetch_all( MYSQLI_ASSOC ) );

    $mysqli->close();

  }
  catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;  
  }

?>
