<?php
// For Debug //
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//echo "Seen";
///////////////
require_once ('../includes/session_mini.php');
require_once ('../includes/common.php');
require_once ('../includes/process.php');

use Process\addRecipient;

$add_recipient = new Process\addRecipient;

if ($add_rec = $add_recipient->add()){
    echo  $add_rec;
} else {
    echo "Error!";
}

?>