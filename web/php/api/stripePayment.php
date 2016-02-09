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

    $query = $this->mysqli->prepare("INSERT INTO gigs (userRequester, beatportLink, startDate, endDate, downloadsRequested, downloadsDone, downloadsApproved, isExclusive) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param("ssssssss", 1, $_POST['trackBeatportURL'], $_POST['startDate'], $_POST['endDate'], $_POST['numberOfDownloads'], 0, 0, $_POST['isExclusive'],$_POST['amount']);
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

