<?php
require_once 'includes/db.php';
require_once 'includes/common.php';
////////////////////////////////////

function update_db ($db, $ref){
    $sql = "UPDATE `supplies` SET
    `status` = 'paid',
    `paid` = 'yes',
    `payment_date` = NOW()
    WHERE 
    `transfer_code` = '".$ref."'";
    // echo $sql;
    if (@mysqli_query($db, $sql)){
        return TRUE;
    } else {
        return FALSE;
    }
}

// only a post with paystack signature header gets our attention
if ((strtoupper($_SERVER['REQUEST_METHOD']) != 'POST' ) || !array_key_exists('HTTP_X_PAYSTACK_SIGNATURE', $_SERVER) ) 
    exit();

// Retrieve the request's body
$input = @file_get_contents("php://input");
define('PAYSTACK_SECRET_KEY','testKey');

// validate event do all at once to avoid timing attack
if($_SERVER['HTTP_X_PAYSTACK_SIGNATURE'] !== hash_hmac('sha512', $input, PAYSTACK_SECRET_KEY))
  exit();

http_response_code(200);

// parse event (which is json string) as object
// Do something - that will not take long - with $event
$event = json_decode($input, true);


if ($event['event'] == "transfer.success"){
    update_db ($link, $event['data']['transfer_code']); // Update payment based on Transfer Code
}

$sql = "INSERT INTO `payment` SET
     `payment_reference_id` = '".$event['data']['reference']."',
     `status` = '".$event['data']['status']."',
     `amount` = '".$event['data']['amount']."',
     `confirmation` = 'True',
     `date_added` = NOW() ";

@mysqli_query($link, $sql);


exit();
?>