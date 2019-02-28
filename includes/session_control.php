<?php
class sess_control{
	private $email;
	private $password;
	private $dblink;
	
	function __construct(){
		global $link;
		$this->dblink = $link;
		if (!empty($_POST['email']) && !empty($_POST['password'])):
			$this->email = addslash ($_POST['email']);
			$this->password = addslash ($_POST['password']);
		else:
			
			session_page("Please login to proceed ...");
		endif;
		
		//authenticate
		$this->authenticate($this->dblink);
	}
	
	function authenticate ($link){
		$sql = "SELECT * FROM `admin` WHERE `email` = '$this->email' AND `password` = MD5('$this->password') LIMIT 1";
		if (!$result = mysqli_query ($link, $sql)):
			session_page("There was a problem processing your login request, please try again later.");
		else:
			if (mysqli_num_rows ($result) < 1):
				session_page("Please provide valid credentials to proceed");
			else:
				$row = mysqli_fetch_assoc ($result);
				
				// Set session data
				$_SESSION['user_session'] = session_id();
				$_SESSION['email'] = $this->email;
				$_SESSION['userid'] = $row['id'];
			endif;
		endif;
	}
}
?>