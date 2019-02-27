<?php

require_once ('../includes/session_mini.php');
require_once ('../includes/common.php');
require_once ('../includes/process.php');
// echo "Inside Ajax";

use Process\getACCount;

$get_acc = new Process\getACCount;

if ($res = $get_acc->getAcc($_GET['acc_num'],$_GET['bank_code'])){
    echo $res;
} else {
    echo "Error!";
}

?>