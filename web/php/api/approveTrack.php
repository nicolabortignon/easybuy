<?php
require(dirname(__FILE__).'/../dbConnection.php');

if ($_POST) {
 
  $error = '';
  $success = '';
  try {
    if (!isset($_POST['id']))
      throw new Exception("No id specified");
          $id = $_POST['id'];
      $result = $mysqli->query("SELECT *, purcheasedTracks.id as purcheasedTracksId FROM purcheasedTracks Inner join users on idUser = users.id Inner Join gigs on gigs.id = idGig WHERE purcheasedTracks.id = ".$id);
    $trackToApprove = $result->fetch_all( MYSQLI_ASSOC );
    $setToTrue = 1;
    $query = $mysqli->query("UPDATE purcheasedTracks SET confirmed=1 WHERE id=".$id);

    $query = $mysqli->query("UPDATE gigs SET downloadsApproved = downloadsApproved + 1 WHERE id=".$trackToApprove[0]['idGig']);

    if($trackToApprove[0]['isExclusive'] === '0'){
       $query = $mysqli->query("UPDATE users SET totalMoney = totalMoney + 225 WHERE id=".$trackToApprove[0]['idUser']);
    } else {
       $query = $mysqli->query("UPDATE users SET totalMoney = totalMoney + 300 WHERE id=".$trackToApprove[0]['idUser']);
    }
    echo $success;
  }
  catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;  
  }
}
?>

