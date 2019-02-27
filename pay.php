<?php
/////////////////////////////////////
require_once ('includes/session_mini.php');
require_once ('includes/common.php');
require_once ('includes/process.php');
require_once ('includes/supplies.php');
/////////////////////////////////////
/////////////////////////////////////
// Exit if page doesn't have supply Id
if (empty($_GET['supply_id'])){
  exit();
}


use Process\getBanks;
use Supply\getSupply;

// Get list of banks
$get_banks = new Process\getBanks;

// Get Balance on Paystack
$bal = curl_get ("https://api.paystack.co/balance");
// print_r($bal);

// Get new supply object
$get_supply = new Supply\getSupply($_GET['supply_id']);

// Get information about this supply
$supply = $get_supply->get_supply_details($link);

// Store supply ID and Supplier Id in session
$_SESSION['supply_id'] = $supply['id'];
$_SESSION['supplier_id'] = $supply['supplier_id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Bakery Make Payment</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <style>
    /* Hidden Parts of the Form */
    #account_confirm {
      display: none;
    }
    #others {
      display: none;
    }
    .left-inner-addon {
        position: relative;
    }
    .left-inner-addon input {
        padding-left: 40px;    
    }
    .left-inner-addon span {
        position: absolute;
        padding: 7px 12px;
        pointer-events: none;
    }
  </style>
</head>

<body class="bg-light">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Your Current account balance is <strong class="text-danger"><?php echo $bal['data'][0]['currency'].number_format($bal["data"][0]["balance"], 2, ".", ","); ?></strong></div>
      <div class="card-body">
        <small>Pay <strong><?php echo $supply['supplier_name']; ?></strong> <strong class="text-info">N<?php echo number_format($supply['amount'], 2, ".", ","); ?></strong>
         for <?php echo $supply['quantity_desc']; ?> of <strong><?php echo $supply['item_name']; ?></strong></small>
        <hr>
        <form action="transfer.php" method="post">
          <div class="form-group">
            <!-- <label for="bank">Supplier Bank</label> -->
            <select class="form-control" id="bank" name="bank">
              <option>Bank</option>
              <?php
              echo $get_banks->banks();
              ?>
            </select>
          </div>
          <div class="form-group">
            <!-- <label for="account_number">Account Number</label> -->
            <input class="form-control" id="account_number" name="account_number" type="text" placeholder="Account Number">
          </div>
          <div class="form-group">
            <div id="account_confirm" class="font-weight-bold">
              <img src="images/load.gif" alt="loading">
            </div>
          </div>
          <div id="others">
            
            <div class="form-group">
              <label for="amount">Amount</label>
              <div class="input-group left-inner-addon"> 
                  <span>NGN</span>
                  <input type="number" value="<?php echo number_format($supply['amount'], 2, ".", ""); ?>" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="amount" name="amount" />
              </div>
            </div>

            <input type="hidden" name="account_name" id="account_name">
            <input type="hidden" name="recipient_code" id="recipient_code">
            <input type="hidden" name="supplier" id="supplier" value="<?php echo $supply['supplier_name']; ?>">
            <input type="hidden" name="reason" id="reason" value="Payment for supply,<?php echo $supply['quantity_desc']; ?> of <strong><?php echo $supply['item_name']; ?>">
            
          </div>
          <input type="submit" class="btn btn-success btn-block" value="Pay Supplier" disabled>
        </form>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/confirm_account.js"></script>
</body>

</html>
