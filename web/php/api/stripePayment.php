<?php
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
    echo $success;
  }
  catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;  
  }
}
echo 'no post no party';
?>

