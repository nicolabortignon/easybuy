<?php
require(dirname(__FILE__).'/../dbConnection.php');

if ($_POST) {
 
  $error = '';
  $success = '';
  try {
    if (!isset($_POST['gigId']))
      throw new Exception("No gig specified");

    
    $screenshotURL =  $_POST['screenshotURL'];
    $gigId = $_POST['gigId'];
    $buyerId = $_POST['buyerId'];
    $isExclusive = $_POST['isExclusive'];

    $query = $mysqli->prepare("INSERT INTO purcheasedTracks (idGig, idUser, isExclusive, screenshot) VALUES (?, ?, ?, ?)");
    $query->bind_param("ssis",$gigId,$buyerId,$isExclusive,$screenshotURL);
    $query->execute();
    $query->close();
    $query = $mysqli->query("UPDATE gigs SET downloadsDone = downloadsDone + 1 WHERE id =".$gigId);
    echo $success;
  }
  catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;  
  }
}
?>

