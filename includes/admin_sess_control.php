<?php 
session_start();////////


// $d_base = $_SERVER['DOCUMENT_ROOT']."/bakery";
////////////////////////


require_once ('db.php');
require_once ('common.php');
require_once ('session_control.php');
////==============//////

function session_page ($error_mess) {
	if (isset ($_COOKIE['email'])):
		$email = $_COOKIE['email'];
		$password = $_COOKIE['password'];
	elseif (isset ($_POST['email'])):
		$email = $_POST['email'];
		$password = $_POST['password'];
	endif;

	include 'templates/login.php';

	// return 1;
	exit();
}
//////////////////////////


// If user request log-off //////////////////////////////////////////////////////////////
if (isset ($_REQUEST['logoff'])):
	$_SESSION = array(); 
	session_destroy();
	session_page("You have successfully logged off");
endif;

// SEARCH FOR USER SESSION //////////////////////////////////////
if (empty($_SESSION['user_session']) || $_SESSION['user_session'] != session_id()):
	$session = new sess_control();
endif
?>