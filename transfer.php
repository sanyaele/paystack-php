<?php
// For Debug //
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//echo "Seen";
///////////////
require_once ('includes/common.php');
require_once ('includes/process.php');

use Process\initiateTransfer;
use Process\finalizeTransfer;

if (!empty($_POST['otp'])){

  if ($finalize_transfer = new Process\finalizeTransfer($_POST['t_code'], $_POST['otp'])){
    $ref_code = $finalize_transfer->transfer();
    if (substr($ref_code, 0, 5) == "Error"){
      echo $ref_code;
      exit();
    }
  }

  $html = '
  <div class="card-body">
      <img src="images/success.gif" alt="Transfer Successful" class="img-fluid">
  </div>
  ';

} elseif (!empty($_POST['recipient_code'])){

  if ($initiate_transfer = new Process\initiateTransfer($_POST['reason'], $_POST['amount'], $_POST['recipient_code'])){
    $code = $initiate_transfer->transfer();
    if (substr($code, 0, 5) == "Error"){
        echo $code;
        exit();
    }
  } else {
    echo "Some Required Fields are absent, please try again";
    exit();
  }

  
  
  $html = '
  <div class="card-header">Input the <strong class="text-info">OTP</strong> code that will be sent to you shortly</div>
      <div class="card-body">
      <form action="'.$_SERVER['PHP_SELF'].'" method="post">
          <div class="form-group">
            <label for="otp">OTP</label>
            <input class="form-control" id="otp" name="otp" type="text" pattern="[0-9]{6}">
          </div>
          <input type="hidden" name="t_code" id="t_code" value="'.$code.'">
          <input type="submit" class="btn btn-success btn-block" value="Authorize Payment" disabled>
        </form>
      </div>
  ';

}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Fund Transfer</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <?php 
        echo $html;
      ?>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
