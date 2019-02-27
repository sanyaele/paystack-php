<?php 
session_start();////////
////////////////////////
require_once 'db.php';
require_once 'common.php';
////==============//////
//////////////////////////

class dlogin {
	private $username;
	private $password;
	private $dblink;
	public $message;
	
	function __construct(){
		global $link;
		$this->dblink = $link;
		$this->username = addslash ($_POST['username']);
		$this->password = addslash ($_POST['password']);
		
		//authenticate
		$this->authenticate($this->dblink);
	}
	
	function authenticate ($link){
		$sql = "SELECT * FROM `admin` WHERE `username` = '$this->username' AND `password` = MD5('$this->password') AND `admin` = '1' LIMIT 1";
		if (!$result = mysqli_query ($link, $sql)):
			$this->message = "There was a problem processing your login request, please try again later.";
			return FALSE;
		else:
			if (mysqli_num_rows ($result) < 1):
				$this->message = "Please provide valid credentials to proceed";
				return FALSE;
			else:
				$row = mysqli_fetch_assoc ($result);
				
				// Set session data
				$_SESSION['admin_user_session'] = session_id();
				$_SESSION['username'] = $this->username;
				$_SESSION['userid'] = $row['id'];
			endif;
		endif;
	}
}

if (!empty($_POST['username']) && !empty($_POST['password'])){
	$this->username = addslash ($_POST['username']);
	$this->password = addslash ($_POST['password']);

	$sign_in = new dlogin;
	if ($sign_in->authenticate()){
		// Redirect to home page
		header ("Location: home.php");
	} else {
		$message = $sign_in->message;
	}
} else {
	$message = "Please input your username and password to proceed";
}
?>