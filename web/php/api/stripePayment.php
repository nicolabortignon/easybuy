<?php
require(dirname(__FILE__).'/../dbConnection.php');
require(dirname(__FILE__).'/../lib/stripe/init.php');

if ($_POST) {
  \Stripe\Stripe::setApiKey("sk_test_DPUooPMuUgV4NnuqQdmLeshI");
  $error = '';
  $success = '';
  try {
    if (!isset($_POST['stripeToken']))
      throw new Exception("The Stripe Token was not generated correctly");
      $metaData = array(
        "userId" => $_POST['userId'], 
        "numberOfDownloads" => $_POST['numberOfDownloads'], 
        "trackBeatportURL" => $_POST['trackBeatportURL'], 
        "startDate" => $_POST['startDate'], 
        "endDate" => $_POST['endDate']
        );
    $charge = \Stripe\Charge::create(array(
      'card' => $_POST['stripeToken'], 
      'amount' => $_POST['amount'], 
      'currency' => 'eur',
      'metadata'=>  $metaData));
    $success = 'Your payment was successful.';
    
    $trackBeatportURL =  $_POST['trackBeatportURL'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $numberOfDownloads = $_POST['numberOfDownloads'];
    $isExclusive = $_POST['isExclusive'];
    $amount = $_POST['amount'];
    $userId = 1;
    $downloadsDone = 0;
    $downloadsApproved = 0;
    $query = $mysqli->prepare("INSERT INTO gigs (userRequester, beatportLink, startDate, endDate, downloadsRequested, downloadsDone, downloadsApproved, isExclusive, totalCost) VALUES (?, ?, FROM_UNIXTIME(?), FROM_UNIXTIME(?), ?, ?, ?, ?, ?)");
    $query->bind_param("issssiiss",$userId,$trackBeatportURL,$startDate,$endDate,$numberOfDownloads,$downloadsDone,$downloadsApproved,$isExclusive,$amount);
    $query->execute();
    $query->close();


    echo $success;
  }
  catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;  
  }
}
echo 'no post no party';
?>

