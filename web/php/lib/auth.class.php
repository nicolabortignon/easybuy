<?php
include_once(dirname(__FILE__).'/../../../user_settings');
include_once(dirname(__FILE__).'/../i18n/en.php');
class auth
{

	public $mysqli;
	public $lang;
	public $loc;
	public $errormsg;
	public $successmsg;
	public $auth_conf;
	public $site_name;
	public $email_from;
	public $max_attempts;
	public $base_url;
	public $session_duration;
	public $security_duration;
	public $salt_1;
	public $salt_2;
	
	function __construct()
	{
		$auth_conf['site_name'] = "Auth Test"; // Name of website to appear in emails
		$auth_conf['email_from'] = "no-reply@auth.cuonic.tk"; // Email FROM address for Auth emails (Activation, password reset...)
		$auth_conf['max_attempts'] = 10; // INT : Max number of attempts for login before user is locked out
		$auth_conf['base_url'] = "https://guarded-coast-8531.herokuapp.com//"; // URL to Auth Class installation root WITH trailing slash
		$auth_conf['session_duration'] = "+1 month"; // Amount of time session lasts for. Only modify if you know what you are doing ! Default = +1 month
		$auth_conf['security_duration'] = "+30 minutes"; // Amount of time to lock a user out of Auth Class afetr defined number of attempts.

		$auth_conf['salt_1'] = "us_1dUDN4N-53"; // Salt #1 for password encryption
		$auth_conf['salt_2'] = "Yu23ds09*d?"; // Salt #1 for password encryption
			$lang['en']['auth']['login_lockedout'] = "You have been temporarily locked out !";
	$lang['en']['auth']['login_wait30'] = "Please wait 30 minutes.";
	$lang['en']['auth']['login_username_empty'] = "Username / Password is invalid !";
	$lang['en']['auth']['login_username_short'] = "Username / Password is invalid !";
	$lang['en']['auth']['login_username_long'] = "Username / Password is invalid !";
	$lang['en']['auth']['login_password_empty'] = "Username / Password is invalid !";
	$lang['en']['auth']['login_password_short'] = "Username / Password is invalid !";
	$lang['en']['auth']['login_password_long'] = "Username / Password is invalid !";
	$lang['en']['auth']['login_incorrect'] = "Username / Password is incorrect !";
	$lang['en']['auth']['login_attempts_remaining'] = "%d attempts remaining !";
	$lang['en']['auth']['login_account_inactive'] = "Account is not activated !";
	$lang['en']['auth']['login_success'] = "You are now logged in !";
	$lang['en']['auth']['login_already'] = "You are already logged in !";

	$lang['en']['auth']['register_username_empty'] = "Username field is empty !";
	$lang['en']['auth']['register_username_short'] = "Username is too short !";
	$lang['en']['auth']['register_username_long'] = "Username is too long !";
	$lang['en']['auth']['register_password_empty'] = "Password field is empty !";
	$lang['en']['auth']['register_password_short'] = "Password is too short !";
	$lang['en']['auth']['register_password_long'] = "Password is too long !";
	$lang['en']['auth']['register_password_nomatch'] = "Passwords don't match !";
	$lang['en']['auth']['register_password_username'] = "Password cannot contain the username !";
	$lang['en']['auth']['register_email_empty'] = "Email field is empty !";
	$lang['en']['auth']['register_email_short'] = "Email is too short !";
	$lang['en']['auth']['register_email_long'] = "Email is too long !";
	$lang['en']['auth']['register_email_invalid'] = "Email is invalid !";
	$lang['en']['auth']['register_username_exist'] = "Username is already in use !";
	$lang['en']['auth']['register_email_exist'] = "Email is already in use !";
	$lang['en']['auth']['register_success'] = "New Account Created ! Activation email sent to your email address.";
	$lang['en']['auth']['register_email_loggedin'] = "You are currently logged in !";

	$lang['en']['auth']['deletesession_invalid'] = "Invalid Session Hash !";

	$lang['en']['auth']['sessioninfo_invalid'] = "Invalid Session Hash !";

	$lang['en']['auth']['activate_username_empty'] = "Invalid URL !";
	$lang['en']['auth']['activate_username_short'] = "Invalid URL !";
	$lang['en']['auth']['activate_username_long'] = "Invalid URL !";
	$lang['en']['auth']['activate_key_empty'] = "Invalid URL !";
	$lang['en']['auth']['activate_key_short'] = "Invalid URL !";
	$lang['en']['auth']['activate_key_long'] = "Invalid URL !";
	$lang['en']['auth']['activate_username_incorrect'] = "Username is incorrect !";
	$lang['en']['auth']['activate_account_activated'] = "Account is already activated !";
	$lang['en']['auth']['activate_success'] = "Account successfully activated !";
	$lang['en']['auth']['activate_key_incorrect'] = "Activation key is incorrect !";

	$lang['en']['auth']['changepass_username_empty'] = "Error encountered !";
	$lang['en']['auth']['changepass_username_short'] = "Error encountered !";
	$lang['en']['auth']['changepass_username_long'] = "Error encountered !";
	$lang['en']['auth']['changepass_currpass_empty'] = "Current Password field is empty !";
	$lang['en']['auth']['changepass_currpass_short'] = "Current Password is too short !";
	$lang['en']['auth']['changepass_currpass_long'] = "Current Password is too long !";
	$lang['en']['auth']['changepass_newpass_empty'] = "New Password field is empty !";
	$lang['en']['auth']['changepass_newpass_short'] = "New Password is too short !";
	$lang['en']['auth']['changepass_newpass_long'] = "New Password is too long !";
	$lang['en']['auth']['changepass_password_username'] = "Password cannot contain the username !";
	$lang['en']['auth']['changepass_password_nomatch'] = "Passwords don't match !";
	$lang['en']['auth']['changepass_username_incorrect'] = "Error encountered !";
	$lang['en']['auth']['changepass_success'] = "Password successfully changed !";
	$lang['en']['auth']['changepass_currpass_incorrect'] = "Current Password is incorrect !";

	$lang['en']['auth']['changeemail_username_empty'] = "Error encountered !";
	$lang['en']['auth']['changeemail_username_short'] = "Error encountered !";
	$lang['en']['auth']['changeemail_username_long'] = "Error encountered !";
	$lang['en']['auth']['changeemail_email_empty'] = "Email field is empty !";
	$lang['en']['auth']['changeemail_email_short'] = "Email is too short !";
	$lang['en']['auth']['changeemail_email_long'] = "Email is too long !";
	$lang['en']['auth']['changeemail_email_invalid'] = "Email is invalid !";
	$lang['en']['auth']['changeemail_username_incorrect'] = "Error encountered !";
	$lang['en']['auth']['changeemail_email_match'] = "New email address matches the existing one !";
	$lang['en']['auth']['changeemail_success'] = "Email address successfully changed !";

	$lang['en']['auth']['resetpass_lockedout'] = "You have been temporarily locked out !";
	$lang['en']['auth']['resetpass_wait30'] = "Please wait 30 mins.";
	$lang['en']['auth']['resetpass_email_empty'] = "Email field is empty !";
	$lang['en']['auth']['resetpass_email_short'] = "Email is too short !";
	$lang['en']['auth']['resetpass_email_long'] = "Email is too long !";
	$lang['en']['auth']['resetpass_email_invalid'] = "Email is invalid !";
	$lang['en']['auth']['resetpass_email_incorrect'] = "Email is incorrect !";
	$lang['en']['auth']['resetpass_attempts_remaining'] = "%d attempts remaining !";
	$lang['en']['auth']['resetpass_email_sent'] = "Password Reset Request sent to your email address !";
	$lang['en']['auth']['resetpass_key_empty'] = "Reset Key field is empty !";
	$lang['en']['auth']['resetpass_key_short'] = "Reset Key is too short !";
	$lang['en']['auth']['resetpass_key_long'] = "Reset Key is too long !";
	$lang['en']['auth']['resetpass_newpass_empty'] = "New Password field is empty !";
	$lang['en']['auth']['resetpass_newpass_short'] = "New Password is too short !";
	$lang['en']['auth']['resetpass_newpass_long'] = "New Password is too long !";
	$lang['en']['auth']['resetpass_newpass_username'] = "New Password cannot contain username !";
	$lang['en']['auth']['resetpass_newpass_nomatch'] = "Passwords don't match !";
	$lang['en']['auth']['resetpass_username_incorrect'] = "Error encountered !";
	$lang['en']['auth']['resetpass_success'] = "Password successfully changed !";
	$lang['en']['auth']['resetpass_key_incorrect'] = "Reset Key is incorrect !";

	$lang['en']['auth']['checkresetkey_username_incorrect'] = "Username is incorrect !";
	$lang['en']['auth']['checkresetkey_key_incorrect'] = "Reset Key is incorrect !";
	$lang['en']['auth']['checkresetkey_lockedout'] = "You have been temporarily locked out !";
	$lang['en']['auth']['checkresetkey_wait30'] = "Please wait 30 mins.";
	$lang['en']['auth']['checkresetkey_attempts_remaining'] = "%d attempts remaining !";

	$lang['en']['auth']['deleteaccount_username_empty'] = "Error encountered !";
	$lang['en']['auth']['deleteaccount_username_short'] = "Error encountered !";
	$lang['en']['auth']['deleteaccount_username_long'] = "Error encountered !";
	$lang['en']['auth']['deleteaccount_password_empty'] = "Password field is empty !";
	$lang['en']['auth']['deleteaccount_password_short'] = "Password is too short !";
	$lang['en']['auth']['deleteaccount_password_long'] = "Password is too long !";
	$lang['en']['auth']['deleteaccount_username_incorrect'] = "Error encountered !";
	$lang['en']['auth']['deleteaccount_success'] = "Account deleted successfully !";
	$lang['en']['auth']['deleteaccount_password_incorrect'] = "Password is incorrect !";

	$lang['en']['auth']['logactivity_username_short'] = "Error encountered !";
	$lang['en']['auth']['logactivity_username_long'] = "Error encountered !";
	$lang['en']['auth']['logactivity_action_empty'] = "Error encountered !";
	$lang['en']['auth']['logactivity_action_short'] = "Error encountered !";
	$lang['en']['auth']['logactivity_action_long'] = "Error encountered !";
	$lang['en']['auth']['logactivity_addinfo_long'] = "Error encountered !";

		$loc = "en"; // Language of Auth Class output : en / fr
		$this->mysqli = $GLOBALS['mysqli'];
		$this->lang = $lang;
		$this->loc = $loc;
		$this->auth_conf = $auth_conf;
		$this->site_name = $this->auth_conf['site_name'];
		$this->email_from = $this->auth_conf['email_from'];
		$this->max_attempts = $this->auth_conf['max_attempts'];
		$this->base_url = $this->auth_conf['base_url'];
		$this->session_duration = $this->auth_conf['session_duration'];
		$this->security_duration = $this->auth_conf['security_duration'];
		$this->salt_1 = $this->auth_conf['salt_1'];
		$this->salt_2 = $this->auth_conf['salt_2'];
	}
	
	/*
	* Log user in via MySQL Database
	* @param string $username
	* @param string $password
	* @return boolean
	*/
	
	function login($username, $password)
	{
		
		if(!isset($_COOKIE["auth_session"]))
		{
			$attcount = $this->getattempt($_SERVER['REMOTE_ADDR']);
			
			if($attcount >= $this->auth_conf['max_attempts'])
			{

				$this->errormsg[] = $this->lang[$this->loc]['auth']['login_lockedout'];
				$this->errormsg[] = $this->lang[$this->loc]['auth']['login_wait30'];
				
				return json_encode($this->errormsg);
			}
			else 
			{
				// Input verification :
				if(strlen($username) == 0) { $this->errormsg[] = $this->lang[$this->loc]['auth']['login_username_empty']; return $this->errormsg; }
				elseif(strlen($username) > 30) { $this->errormsg[] = $this->lang[$this->loc]['auth']['login_username_long']; return $this->errormsg; }
				elseif(strlen($username) < 3) { $this->errormsg[] = $this->lang[$this->loc]['auth']['login_username_short']; return $this->errormsg; }
				elseif(strlen($password) == 0) { $this->errormsg[] = $this->lang[$this->loc]['auth']['login_password_empty']; return $this->errormsg; }
				elseif(strlen($password) > 30) { $this->errormsg[] = $this->lang[$this->loc]['auth']['login_password_short']; return $this->errormsg; }
				elseif(strlen($password) < 5) { $this->errormsg[] = $this->lang[$this->loc]['auth']['login_password_long']; return $this->errormsg; }
				else 
				{
					// Input is valid
					$password = $this->hashpass($password);
				
					$query = $this->mysqli->prepare("SELECT isactive FROM users WHERE username = ? AND password = ?");
					$query->bind_param("ss", $username, $password);
					$query->bind_result($isactive);
					$query->execute();
					$query->store_result();
					$count = $query->num_rows;
					$query->fetch();
					$query->close();
				
					if($count == 0)
					{
						// Username and / or password are incorrect
						$this->errormsg[] = 0;
						$this->errormsg[] = $this->lang[$this->loc]['auth']['login_incorrect'];
						
						$this->addattempt($_SERVER['REMOTE_ADDR']);
						
						$attcount = $attcount + 1;
						$remaincount = $auth_conf['max_attempts'] - $attcount;
						
						$this->LogActivity("UNKNOWN", "AUTH_LOGIN_FAIL", "Username / Password incorrect - {$username} / {$password}");
						
						$this->errormsg[] = sprintf($this->lang[$this->loc]['auth']['login_attempts_remaining'], $remaincount);
						
						return json_encode($this->errormsg);
					}
					else 
					{
						// Username and password are correct
						
						if($isactive == "0")
						{
							// Account is not activated
							
							$this->LogActivity($username, "AUTH_LOGIN_FAIL", "Account inactive");
							
							$this->errormsg[] = $this->lang[$this->loc]['auth']['login_account_inactive'];
							$this->errormsg[] = 0;
							return json_encode($this->errormsg);
						}
						else
						{
							// Account is activated
							
							$this->newsession($username);				
							$this->LogActivity($username, "AUTH_LOGIN_SUCCESS", "User logged in");
							$this->successmsg['result'] = 1;
							$this->successmsg[] = $this->lang[$this->loc]['auth']['login_success'];
							
							return json_encode($this->successmsg);
						}
					}
				}
			}
		}
		else 
		{
			// User is already logged in
			$this->errormsg['result'] = 1;
			$this->errormsg[] = $this->lang[$this->loc]['auth']['login_already'];
			
			return json_encode($this->errormsg);
		}
	}
	
	/*
	* Register a new user into the database
	* @param string $username
	* @param string $password
	* @param string $verifypassword
	* @param string $email
	* @return boolean
	*/
	
	function register($username, $password, $verifypassword, $email, $currency)
	{
	
		if(!isset($_COOKIE["auth_session"]))
		{
		
			// Input Verification :
		
			if(strlen($username) == 0) { $this->errormsg[] = $this->lang[$this->loc]['auth']['register_username_empty']; }
			elseif(strlen($username) > 30) { $this->errormsg[] = $this->lang[$this->loc]['auth']['register_username_long']; }
			elseif(strlen($username) < 3) { $this->errormsg[] = $this->lang[$this->loc]['auth']['register_username_short']; }
			if(strlen($password) == 0) { $this->errormsg[] = $this->lang[$this->loc]['auth']['register_password_empty']; }
			elseif(strlen($password) > 30) { $this->errormsg[] = $this->lang[$this->loc]['auth']['register_password_long']; }
			elseif(strlen($password) < 5) { $this->errormsg[] = $this->lang[$this->loc]['auth']['register_password_short']; }
			elseif($password !== $verifypassword) { $this->errormsg[] = $this->lang[$this->loc]['auth']['register_password_nomatch']; }
			elseif(strstr($password, $username)) { $this->errormsg[] = $this->lang[$this->loc]['auth']['register_password_username']; }
			if(strlen($email) == 0) { $this->errormsg[] = $this->lang[$this->loc]['auth']['register_email_empty']; }
			elseif(strlen($email) > 100) { $this->errormsg[] = $this->lang[$this->loc]['auth']['register_email_long']; }
			elseif(strlen($email) < 5) { $this->errormsg[] = $this->lang[$this->loc]['auth']['register_email_short']; }
			elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) { $this->errormsg[] = $this->lang[$this->loc]['auth']['register_email_invalid']; }
		
			if(count($this->errormsg) == 0)
			{
				// Input is valid
				$query = $this->mysqli->prepare("SELECT * FROM users WHERE username=?");
				$query->bind_param("s", $username);
				$query->execute();
				$query->store_result();
				$count = $query->num_rows;
				$query->close();
			
				if($count != 0)
				{
					// Username already exists
				
					$this->LogActivity("UNKNOWN", "AUTH_REGISTER_FAIL", "Username ({$username}) already exists");
				
					$this->errormsg[] = $this->lang[$this->loc]['auth']['register_username_exist'];
					$this->errormsg[] = 0;
					return $this->errormsg;
				}
				else 
				{
					// Username is not taken
					
					$query = $this->mysqli->prepare("SELECT * FROM users WHERE email=?");
					$query->bind_param("s", $email);
					$query->execute();
					$query->store_result();
					$count = $query->num_rows;
					$query->close();
				
					if($count != 0)
					{
						// Email address is already used
					
						$this->LogActivity("UNKNOWN", "AUTH_REGISTER_FAIL", "Email ({$email}) already exists");
					
						$this->errormsg[] = $this->lang[$this->loc]['auth']['register_email_exist'];
						$this->errormsg['result'] = 0;
						return json_encode($this->errormsg);					
					}
					else 
					{
						// Email address isn't already used
					
						$password = $this->hashpass($password);
						$activekey = $this->randomkey(15);	 
					
						$query = $this->mysqli->prepare("INSERT INTO users (username, password, email, activekey, currency) VALUES (?, ?, ?, ?, ?)");
						$query->bind_param("sssss", $username, $password, $email, $activekey, $currency);
						$query->execute();
						$query->close();
						
						$message_from = $this->email_from;
						$message_subj = $this->site_name. " - Account activation required !";
						$message_cont = "Hello {$username}<br/><br/>";
						$message_cont .= "You recently registered a new account on " . $this->site_name . "<br/>";
						$message_cont .= "To activate your account please click the following link<br/><br/>";
						$message_cont .= "<b><a href=\"" . $this->base_url . "?page=activate&username={$username}&key={$activekey}\">Activate my account</a></b>";
						$message_head = "From: {$message_from}" . "\r\n";
						$message_head .= "MIME-Version: 1.0" . "\r\n";
						$message_head .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
						
						mail($email, $message_subj, $message_cont, $message_head);
					
						$this->LogActivity($username, "AUTH_REGISTER_SUCCESS", "Account created and activation email sent");
						$this->successmsg['result'] = 1;
						$this->successmsg[] = $this->lang[$this->loc]['auth']['register_success'];
						
						return json_encode($this->successmsg);					
					}
				}			
			}
			else 
			{
				$this->successmsg['result'] = 0;
				return json_encode($this->errormsg);
			}
		}
		else 
		{
			// User is logged in
		
			$this->errormsg[] = $this->lang[$this->loc]['auth']['register_email_loggedin'];
			$this->successmsg['result'] = 0;
			return json_encode($this->errormsg);
		}
	}
	
	/*
	* Creates a new session for the provided username and sets cookie
	* @param string $username
	*/
	
	function newsession($username)
	{
		$hash = md5(microtime());
		
		// Fetch User ID :		
		
		$query = $this->mysqli->prepare("SELECT id FROM users WHERE username=?");
		$query->bind_param("s", $username);
		$query->bind_result($uid);
		$query->execute();
		$query->fetch();
		$query->close();
		
		// Delete all previous sessions :
		
		$query = $this->mysqli->prepare("DELETE FROM sessions WHERE username=?");
		$query->bind_param("s", $username);
		$query->execute();
		$query->close();
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$expiredate = date("Y-m-d H:i:s", strtotime($this->auth_conf['session_duration']));
		$expiretime = strtotime($expiredate);
		
		$query = $this->mysqli->prepare("INSERT INTO sessions (uid, username, hash, expiredate, ip) VALUES (?, ?, ?, ?, ?)");
		$query->bind_param("issss", $uid, $username, $hash, $expiredate, $ip);
		$query->execute();
		$query->close();
		
		setcookie("auth_session", $hash, $expiretime);
	}
	
	/*
	* Deletes the user's session based on hash
	* @param string $hash
	*/
	
	function deletesession($hash)
	{
	
		$query = $this->mysqli->prepare("SELECT username FROM sessions WHERE hash=?");
		$query->bind_param("s", $hash);
		$query->bind_result($username);
		$query->execute();
		$query->store_result();
		$count = $query->num_rows;
		$query->fetch();
		$query->close();
		
		if($count == 0)
		{
			// Hash doesn't exist
			
			$this->LogActivity("UNKNOWN", "AUTH_LOGOUT", "User session cookie deleted - Database session not deleted - Hash ({$hash}) didn't exist");
		
			$this->errormsg[] = $this->lang[$this->loc]['auth']['deletesession_invalid'];
			
			setcookie("auth_session", $hash, time() - 3600);
		}
		else 
		{
			// Hash exists, Delete all sessions for that username :
			
			$query = $this->mysqli->prepare("DELETE FROM sessions WHERE username=?");
			$query->bind_param("s", $username);
			$query->execute();
			$query->close();
			
			$this->LogActivity($username, "AUTH_LOGOUT", "User session cookie deleted - Database session deleted - Hash ({$hash})");
			
			setcookie("auth_session", $hash, time() - 3600);
		}
	}
	
	/*
	* Provides an associative array of user info based on session hash
	* @param string $hash
	* @return array $session
	*/
	
	function sessioninfo($hash)
	{
	
		$query = $this->mysqli->prepare("SELECT uid, username, expiredate, ip FROM sessions WHERE hash=?");
		$query->bind_param("s", $hash);
		$query->bind_result($session['uid'], $session['username'], $session['expiredate'], $session['ip']);
		$query->execute();
		$query->store_result();
		$count = $query->num_rows;
		$query->fetch();
		$query->close();
		
		if($count == 0)
		{
			// Hash doesn't exist
		
			$this->errormsg[] = $this->lang[$this->loc]['auth']['sessioninfo_invalid'];
			
			setcookie("auth_session", $hash, time() - 3600);
			
			return false;
		}
		else 
		{
			// Hash exists
		
			return $session;			
		}
	}
	
	/* 
	* Checks if session is valid (Current IP = Stored IP + Current date < expire date)
	* @param string $hash
	* @return bool
	*/
	
	function checksession($hash)
	{
		$query = $this->mysqli->prepare("SELECT username, expiredate, ip FROM sessions WHERE hash=?");
		$query->bind_param("s", $hash);
		$query->bind_result($username, $db_expiredate, $db_ip);
		$query->execute();
		$query->store_result();
		$count = $query->num_rows;
		$query->fetch();
		$query->close();
		
		if($count == 0)
		{
			// Hash doesn't exist
			
			setcookie("auth_session", $hash, time() - 3600);
			
			$this->LogActivity($username, "AUTH_CHECKSESSION", "User session cookie deleted - Hash ({$hash}) didn't exist");
			
			return false;
		}
		else
		{
			if($_SERVER['REMOTE_ADDR'] != $db_ip)
			{
				// Hash exists, but IP has changed
			
				$query = $this->mysqli->prepare("DELETE FROM sessions WHERE username=?");
				$query->bind_param("s", $username);
				$query->execute();
				$query->close();
				
				setcookie("auth_session", $hash, time() - 3600);
				
				$this->LogActivity($username, "AUTH_CHECKSESSION", "User session cookie deleted - IP Different ( DB : {$db_ip} / Current : " . $_SERVER['REMOTE_ADDR'] . " )");
				
				return false;
			}
			else 
			{
				$expiredate = strtotime($db_expiredate);
				$currentdate = strtotime(date("Y-m-d H:i:s"));
				
				if($currentdate > $expiredate)
				{
					// Hash exists, IP is the same, but session has expired
				
					$query = $this->mysqli->prepare("DELETE FROM sessions WHERE username=?");
					$query->bind_param("s", $username);
					$query->execute();
					$query->close();
					
					setcookie("auth_session", $hash, time() - 3600);
					
					$this->LogActivity($username, "AUTH_CHECKSESSION", "User session cookie deleted - Session expired ( Expire date : {$db_expiredate} )");
					
					return false;
				}
				else 
				{
					// Hash exists, IP is the same, date < expiry date
				
					return true;
				}
			}
		}
	}
	
	/*
	* Returns a random string, length can be modified
	* @param int $length
	* @return string $key
	*/
	
	function randomkey($length = 10)
	{
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$key = "";
		
		for($i = 0; $i < $length; $i++)
		{
			$key .= $chars{rand(0, strlen($chars) - 1)};
		}
		
		return $key;
	}
	
	/*
	* Activate a user's account
	* @param string $username
	* @param string $key
	* @return boolean
	*/
	
	function activate($username, $key)
	{
	
		// Input verification
	
		if(strlen($username) == 0) { $this->errormsg[] = $this->lang[$this->loc]['auth']['activate_username_empty']; return false; }
		elseif(strlen($username) > 30) { $this->errormsg[] = $this->lang[$this->loc]['auth']['activate_username_long']; return false; }
		elseif(strlen($username) < 3) { $this->errormsg[] = $this->lang[$this->loc]['auth']['activate_username_short']; return false; }
		elseif(strlen($key) == 0) { $this->errormsg[] = $this->lang[$this->loc]['auth']['activate_key_empty']; return false; }
		elseif(strlen($key) > 15) { $this->errormsg[] = $this->lang[$this->loc]['auth']['activate_key_long']; return false; }
		elseif(strlen($key) < 15) { $this->errormsg[] = $this->lang[$this->loc]['auth']['activate_key_short']; return false; }
		else
		{
			// Input is valid
			
			$query = $this->mysqli->prepare("SELECT isactive, activekey FROM users WHERE username=?");
			$query->bind_param("s", $username);
			$query->bind_result($isactive, $activekey);
			$query->execute();
			$query->store_result();
			$count = $query->num_rows;
			$query->fetch();
			$query->close();
			
			if($count == 0)
			{
				// User doesn't exist
				
				$this->LogActivity("UNKNOWN", "AUTH_ACTIVATE_FAIL", "Username Incorrect : {$username}");				
				
				$this->errormsg[] = $this->lang[$this->loc]['auth']['activate_username_incorrect'];
				
				return false;
			}
			else
			{
				// User exists
				
				if($isactive == 1)
				{
					// Account is already activated
					
					$this->LogActivity($username, "AUTH_ACTIVATE_FAIL", "Account already activated");					
					
					$this->errormsg[] = $this->lang[$this->loc]['auth']['activate_account_activated'];
					
					return true;
				}
				else
				{
					// Account isn't activated
					
					if($key == $activekey)
					{
						// Activation keys match
						
						$new_isactive = 1;
						$new_activekey = "0";
						
						$query = $this->mysqli->prepare("UPDATE users SET isactive=?, activekey=? WHERE username=?");
						$query->bind_param("iss", $new_isactive, $new_activekey, $username);
						$query->execute();
						$query->close();
						
						$this->LogActivity($username, "AUTH_ACTIVATE_SUCCESS", "Activation successful. Key Entry deleted.");						
						
						$this->successmsg[] = $this->lang[$this->loc]['auth']['activate_success'];
						return true;						
					}
					else
					{
						// Activation Keys don't match
						
						$this->LogActivity($username, "AUTH_ACTIVATE_FAIL", "Activation keys don't match ( DB : {$activekey} / Given : {$key} )");						
						
						$this->errormsg[] = $this->lang[$this->loc]['auth']['activate_key_incorrect'];
						
						return false;
					}
				}
			}
		}
	}
	
	/*
	* Changes a user's password, providing the current password is known
	* @param string $username
	* @param string $currpass
	* @param string $newpass
	* @param string $verifynewpass
	* @return boolean
	*/
	
	function changepass($username, $currpass, $newpass, $verifynewpass)
	{
		
		if(strlen($username) == 0) { $this->errormsg[] = $this->lang[$this->loc]['auth']['changepass_username_empty']; }
		elseif(strlen($username) > 30) { $this->errormsg[] = $this->lang[$this->loc]['auth']['changepass_username_long']; }
		elseif(strlen($username) < 3) { $this->errormsg[] = $this->lang[$this->loc]['auth']['changepass_username_short']; }
		if(strlen($currpass) == 0) { $this->errormsg[] = $this->lang[$this->loc]['auth']['changepass_currpass_empty']; }
		elseif(strlen($currpass) < 5) { $this->errormsg[] = $this->lang[$this->loc]['auth']['changepass_currpass_short']; }
		elseif(strlen($currpass) > 30) { $this->errormsg[] = $this->lang[$this->loc]['auth']['changepass_currpass_long']; }
		if(strlen($newpass) == 0) { $this->errormsg[] = $this->lang[$this->loc]['auth']['changepass_newpass_empty']; }
		elseif(strlen($newpass) < 5) { $this->errormsg[] = $this->lang[$this->loc]['auth']['changepass_newpass_short']; }
		elseif(strlen($newpass) > 30) { $this->errormsg[] = $this->lang[$this->loc]['auth']['changepass_newpass_long']; }
		elseif(strstr($newpass, $username)) { $this->errormsg[] = $this->lang[$this->loc]['auth']['changepass_password_username']; }
		elseif($newpass !== $verifynewpass) { $this->errormsg[] = $this->lang[$this->loc]['auth']['changepass_password_nomatch']; }
		
		if(count($this->errormsg) == 0)
		{
			$currpass = $this->hashpass($currpass);
			$newpass = $this->hashpass($newpass);
			
			$query = $this->mysqli->prepare("SELECT password FROM users WHERE username=?");
			$query->bind_param("s", $username);
			$query->bind_result($db_currpass);
			$query->execute();
			$query->store_result();
			$count = $query->num_rows;
			$query->fetch();
			$query->close();
			
			if($count == 0)
			{
				$this->LogActivity("UNKNOWN", "AUTH_CHANGEPASS_FAIL", "Username Incorrect ({$username})");				
				
				$this->errormsg[] = $this->lang[$this->loc]['auth']['changepass_username_incorrect'];
				return false;
			}
			else 
			{
				if($currpass == $db_currpass)
				{
					$query = $this->mysqli->prepare("UPDATE users SET password=? WHERE username=?");
					$query->bind_param("ss", $newpass, $username);
					$query->execute();
					$query->close();
					
					$this->LogActivity($username, "AUTH_CHANGEPASS_SUCCESS", "Password changed");					
					
					$this->successmsg[] = $this->lang[$this->loc]['auth']['changepass_success'];
					
					return true;
				}
				else 
				{
					$this->LogActivity($username, "AUTH_CHANGEPASS_FAIL", "Current Password Incorrect ( DB : {$db_currpass} / Given : {$currpass} )");					
					
					$this->errormsg[] = $this->lang[$this->loc]['auth']['changepass_currpass_incorrect'];
									  
					return false;
				}
			}
		}
		else 
		{
			return false;
		}
	}
	
	/*
	* Changes the stored email address based on username
	* @param string $username
	* @param string $email
	* @return boolean
	*/
	
	function changeemail($username, $email)
	{
		
		if(strlen($username) == 0) { $this->errormsg[] = $this->lang[$this->loc]['auth']['changeemail_username_empty']; }
		elseif(strlen($username) > 30) { $this->errormsg[] = $this->lang[$this->loc]['auth']['changeemail_username_long']; }
		elseif(strlen($username) < 3) { $this->errormsg[] = $this->lang[$this->loc]['auth']['changeemail_username_short']; }
		if(strlen($email) == 0) { $this->errormsg[] = $this->lang[$this->loc]['auth']['changeemail_email_empty']; }
		elseif(strlen($email) > 100) { $this->errormsg[] = $this->lang[$this->loc]['auth']['changeemail_email_long']; }
		elseif(strlen($email) < 5) { $this->errormsg[] = $this->lang[$this->loc]['auth']['changeemail_email_short']; }
		elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) { $this->errormsg[] = $this->lang[$this->loc]['auth']['changeemail_email_invalid']; }
		
		if(count($this->errormsg) == 0)
		{
			$query = $this->mysqli->prepare("SELECT email FROM users WHERE username=?");
			$query->bind_param("s", $username);
			$query->bind_result($db_email);
			$query->execute();
			$query->store_result();
			$count = $query->num_rows;
			$query->fetch();
			$query->close();
			
			if($count == 0)
			{
				$this->LogActivity("UNKNOWN", "AUTH_CHANGEEMAIL_FAIL", "Username Incorrect ({$username})");				
				
				$this->errormsg[] = $this->lang[$this->loc]['auth']['changeemail_username_incorrect'];
				
				return false;
			}
			else 
			{
				if($email == $db_email)
				{
 					$this->LogActivity($username, "AUTH_CHANGEEMAIL_FAIL", "Old and new email matched ({$email})");				   
					
					$this->errormsg[] = $this->lang[$this->loc]['auth']['changeemail_email_match'];
					
					return false;
				}
				else 
				{
					$query = $this->mysqli->prepare("UPDATE users SET email=? WHERE username=?");
					$query->bind_param("ss", $email, $username);
					$query->execute();
					$query->close();
					
					$this->LogActivity($username, "AUTH_CHANGEEMAIL_SUCCESS", "Email changed from {$db_email} to {$email}");					
					
					$this->successmsg[] = $this->lang[$this->loc]['auth']['changeemail_success'];
					
					return true;
				}
			}
		}
		else 
		{
			return false;
		}
	}
	
	/*
	* Give the user the ability to change their password if the current password is forgotten
	* by sending email to the email address associated to that user
	* @param string $username
	* @param string $email
	* @param string $key
	* @param string $newpass
	* @param string $verifynewpass
	* @return boolean
	*/
	
	function resetpass($username = '0', $email ='0', $key = '0', $newpass = '0', $verifynewpass = '0')
	{
	
		$attcount = $this->getattempt($_SERVER['REMOTE_ADDR']);
			
		if($attcount >= $auth_conf['max_attempts'])
		{
			$this->errormsg[] = $this->lang[$this->loc]['auth']['resetpass_lockedout'];
			$this->errormsg[] = $this->lang[$this->loc]['auth']['resetpass_wait30'];
				
			return false;
		}
		else
		{
			if($username == '0' && $key == '0')
			{
				if(strlen($email) == 0) { $this->errormsg[] = $this->lang[$this->loc]['auth']['resetpass_email_empty']; }
				elseif(strlen($email) > 100) { $this->errormsg[] = $this->lang[$this->loc]['auth']['resetpass_email_long']; }
				elseif(strlen($email) < 5) { $this->errormsg[] = $this->lang[$this->loc]['auth']['resetpass_email_short']; }
				elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) { $this->errormsg[] = $this->lang[$this->loc]['auth']['resetpass_email_invalid']; }
				
				$resetkey = $this->randomkey(15);
				
				$query = $this->mysqli->prepare("SELECT username FROM users WHERE email=?");
				$query->bind_param("s", $email);
				$query->bind_result($username);
				$query->execute();
				$query->store_result();
				$count = $query->num_rows;
				$query->fetch();
				$query->close();
				
				if($count == 0)
				{
					$this->errormsg[] = $this->lang[$this->loc]['auth']['resetpass_email_incorrect'];
					
					$attcount = $attcount + 1;
					$remaincount = $auth_conf['max_attempts'] - $attcount;
					   
					$this->LogActivity("UNKNOWN", "AUTH_RESETPASS_FAIL", "Email incorrect ({$email})");
					   
					$this->errormsg[] = sprintf($this->lang[$this->loc]['auth']['resetpass_attempts_remaining'], $remaincount);
						
					$this->addattempt($_SERVER['REMOTE_ADDR']);
						
					return false;
				}
				else
				{
					$query = $this->mysqli->prepare("UPDATE users SET resetkey=? WHERE username=?");
					$query->bind_param("ss", $resetkey, $username);
					$query->execute();
					$query->close();
					
					$message_from = $auth_conf['email_from'];
					$message_subj = $auth_conf['site_name'] . " - Password reset request !";
					$message_cont = "Hello {$username}<br/><br/>";
					$message_cont .= "You recently requested a password reset on " . $auth_conf['site_name'] . "<br/>";
					$message_cont .= "To proceed with the password reset, please click the following link :<br/><br/>";
					$message_cont .= "<b><a href=\"" . $auth_conf['base_url'] . "?page=forgot&username={$username}&key={$resetkey}\">Reset My Password</a></b>";
					$message_head = "From: {$message_from}" . "\r\n";
					$message_head .= "MIME-Version: 1.0" . "\r\n";
					$message_head .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
						
					mail($email, $message_subj, $message_cont, $message_head);
					
					$this->LogActivity($username, "AUTH_RESETPASS_SUCCESS", "Reset pass request sent to {$email} ( Key : {$resetkey} )");
					
					$this->successmsg[] = $this->lang[$this->loc]['auth']['resetpass_email_sent'];
						
					return true;
				}
			}
			else
			{
				// Reset Password
				
				if(strlen($key) == 0) { $this->errormsg[] = $this->lang[$this->loc]['auth']['resetpass_key_empty']; }
				elseif(strlen($key) < 15) { $this->errormsg[] = $this->lang[$this->loc]['auth']['resetpass_key_short']; }
				elseif(strlen($key) > 15) { $this->errormsg[] = $this->lang[$this->loc]['auth']['resetpass_key_long']; }
				if(strlen($newpass) == 0) { $this->errormsg[] = $this->lang[$this->loc]['auth']['resetpass_newpass_empty']; }
				elseif(strlen($newpass) > 30) { $this->errormsg[] = $this->lang[$this->loc]['auth']['resetpass_newpass_long']; }
				elseif(strlen($newpass) < 5) { $this->errormsg[] = $this->lang[$this->loc]['auth']['resetpass_newpass_short']; }
				elseif(strstr($newpass, $username)) { $this->errormsg[] = $this->lang[$this->loc]['auth']['resetpass_newpass_username']; }
				elseif($newpass !== $verifynewpass) { $this->errormsg[] = $this->lang[$this->loc]['auth']['resetpass_newpass_nomatch']; }
				
				if(count($this->errormsg) == 0)
				{
					$query = $this->mysqli->prepare("SELECT resetkey FROM users WHERE username=?");
					$query->bind_param("s", $username);
					$query->bind_result($db_key);
					$query->execute();
					$query->store_result();
					$count = $query->num_rows;
					$query->fetch();
					$query->close();
					
					if($count == 0)
					{
						$this->errormsg[] = $this->lang[$this->loc]['auth']['resetpass_username_incorrect'];
						
						$attcount = $attcount + 1;
						$remaincount = $auth_conf['max_attempts'] - $attcount;
						
						$this->LogActivity("UNKNOWN", "AUTH_RESETPASS_FAIL", "Username incorrect ({$username})");						
						
						$this->errormsg[] = sprintf($this->lang[$this->loc]['auth']['resetpass_attempts_remaining'], $remaincount);
						
						$this->addattempt($_SERVER['REMOTE_ADDR']);
						
						return false;
					}
					else
					{
						if($key == $db_key)
						{
							$newpass = $this->hashpass($newpass);
							
							$resetkey = '0';
						
							$query = $this->mysqli->prepare("UPDATE users SET password=?, resetkey=? WHERE username=?");
							$query->bind_param("sss", $newpass, $resetkey, $username);
							$query->execute();
							$query->close();
							
							$this->LogActivity($username, "AUTH_RESETPASS_SUCCESS", "Password reset - Key reset");							
							
							$this->successmsg[] = $this->lang[$this->loc]['auth']['resetpass_success'];
							
							return true;
						}
						else
						{
							$this->errormsg[] = $this->lang[$this->loc]['auth']['resetpass_key_incorrect'];
							
							$attcount = $attcount + 1;
							$remaincount = 5 - $attcount;
						
							$this->LogActivity($username, "AUTH_RESETPASS_FAIL", "Key Incorrect ( DB : {$db_key} / Given : {$key} )");						
						
							$this->errormsg[] = sprintf($this->lang[$this->loc]['auth']['resetpass_attempts_remaining'], $remaincount);
						
							$this->addattempt($_SERVER['REMOTE_ADDR']);
 
							return false;
						}
					}
				}
				else
				{
					return false;
				}
			}
		}
	}
	
	/*
	* Checks if the reset key is correct for provided username
	* @param string $username
	* @param string $key
	* @return boolean
	*/
	
	function checkresetkey($username, $key)
	{
		
		$attcount = $this->getattempt($_SERVER['REMOTE_ADDR']);
			
		if($attcount >= $auth_conf['max_attempts'])
		{
			$this->errormsg[] = $this->lang[$this->loc]['auth']['resetpass_lockedout'];
			$this->errormsg[] = $this->lang[$this->loc]['auth']['resetpass_wait30'];
				
			return false;
		}
		else
		{
		
			if(strlen($username) == 0) { return false; }
			elseif(strlen($username) > 30) { return false; }
			elseif(strlen($username) < 3) { return false; }
			elseif(strlen($key) == 0) { return false; }
			elseif(strlen($key) < 15) { return false; }
			elseif(strlen($key) > 15) { return false; }
			else
			{
				$query = $this->mysqli->prepare("SELECT resetkey FROM users WHERE username=?");
				$query->bind_param("s", $username);
				$query->bind_result($db_key);
				$query->execute();
				$query->store_result();
				$count = $query->num_rows;
				$query->fetch();
				$query->close();
				
				if($count == 0)
				{
					$this->LogActivity("UNKNOWN", "AUTH_CHECKRESETKEY_FAIL", "Username doesn't exist ({$username})");
						
					$this->addattempt($_SERVER['REMOTE_ADDR']);
						
					$this->errormsg[] = $this->lang[$this->loc]['auth']['checkresetkey_username_incorrect'];
						
					$attcount = $attcount + 1;
					$remaincount = $auth_conf['max_attempts'] - $attcount;
						
					$this->errormsg[] = sprintf($this->lang[$this->loc]['auth']['checkresetkey_attempts_remaining'], $remaincount);
				
					return false;
				}
				else
				{
					if($key == $db_key)
					{
						return true;
					}
					else
					{
						$this->LogActivity($username, "AUTH_CHECKRESETKEY_FAIL", "Key provided is different to DB key ( DB : {$db_key} / Given : {$key} )");
						
						$this->addattempt($_SERVER['REMOTE_ADDR']);
						
						$this->errormsg[] = $this->lang[$this->loc]['auth']['checkresetkey_key_incorrect'];
						
						$attcount = $attcount + 1;
						$remaincount = $auth_conf['max_attempts'] - $attcount;
						
						$this->errormsg[] = sprintf($this->lang[$this->loc]['auth']['checkresetkey_attempts_remaining'], $remaincount);
					
						return false;
					}
				}
			}
		}
	}
	
	/*
	* Deletes a user's account. Requires user's password
	* @param string $username
	* @param string $password
	* @return boolean
	*/
	
	function deleteaccount($username, $password)
	{
	
		if(strlen($username) == 0) { $this->errormsg[] = $this->lang[$this->loc]['auth']['deleteaccount_username_empty']; }
		elseif(strlen($username) > 30) { $this->errormsg[] = $this->lang[$this->loc]['auth']['deleteaccount_username_long']; }
		elseif(strlen($username) < 3) { $this->errormsg[] = $this->lang[$this->loc]['auth']['deleteaccount_username_short']; }
		if(strlen($password) == 0) { $this->errormsg[] = $this->lang[$this->loc]['auth']['deleteaccount_password_empty']; }
		elseif(strlen($password) > 30) { $this->errormsg[] = $this->lang[$this->loc]['auth']['deleteaccount_password_long']; }
		elseif(strlen($password) < 5) { $this->errormsg[] = $this->lang[$this->loc]['auth']['deleteaccount_password_short']; }
		
		if(count($this->errormsg) == 0)
		{
			$password = $this->hashpass($password);			
			
			$query = $this->mysqli->prepare("SELECT password FROM users WHERE username=?");
			$query->bind_param("s", $username);
			$query->bind_result($db_password);
			$query->execute();
			$query->store_result();
			$count = $query->num_rows;
			$query->fetch();
			$query->close();
			
			if($count == 0)
			{
				$this->LogActivity("UNKNOWN", "AUTH_DELETEACCOUNT_FAIL", "Username Incorrect ({$username})");				
				
				$this->errormsg[] = $this->lang[$this->loc]['auth']['deleteaccount_username_incorrect'];
				
				return false;
			}
			else 
			{
				if($password == $db_password)
				{
					$query = $this->mysqli->prepare("DELETE FROM users WHERE username=?");
					$query->bind_param("s", $username);
					$query->execute();
					$query->close();
					
					$query = $this->mysqli->prepare("DELETE FROM sessions WHERE username=?");
					$query->bind_param("s", $username);
					$query->execute();
					$query->close();
					
					$this->LogActivity($username, "AUTH_DELETEACCOUNT_SUCCESS", "Account deleted - Sessions deleted");					
					
					$this->successmsg[] = $this->lang[$this->loc]['auth']['deleteaccount_success'];
					
					return true;
				}
				else 
				{
					$this->LogActivity($username, "AUTH_DELETEACCOUNT_FAIL", "Password incorrect ( DB : {$db_password} / Given : {$password} )");					
					
					$this->errormsg[] = $this->lang[$this->loc]['auth']['deleteaccount_password_incorrect'];
			   
					return false;
				}
			}
		}
		else 
		{
			return false;
		}
	}		
	
	/*
	* Adds a new attempt to database based on user's IP
	* @param string $ip
	*/
	
	function addattempt($ip)
	{
	
		$query = $this->mysqli->prepare("SELECT count FROM attempts WHERE ip = ?");
		$query->bind_param("s", $ip);
		$query->bind_result($attempt_count);
		$query->execute();
		$query->store_result();
		$count = $query->num_rows;
		$query->fetch();
		$query->close();
		
		if($count == 0)
		{
			// No record of this IP in attempts table already exists, create new
			
			$attempt_expiredate = date("Y-m-d H:i:s", strtotime($auth_conf['security_duration']));
			$attempt_count = 1;
			
			$query = $this->mysqli->prepare("INSERT INTO attempts (ip, count, expiredate) VALUES (?, ?, ?)");
			$query->bind_param("sis", $ip, $attempt_count, $attempt_expiredate);
			$query->execute();
			$query->close();
		}
		else 
		{
			// IP Already exists in attempts table, add 1 to current count
			
			$attempt_expiredate = date("Y-m-d H:i:s", strtotime($auth_conf['security_duration']));
			$attempt_count = $attempt_count + 1;
			
			$query = $this->mysqli->prepare("UPDATE attempts SET count=?, expiredate=? WHERE ip=?");
			$query->bind_param("iss", $attempt_count, $attempt_expiredate, $ip);
			$query->execute();
			$query->close();
		}
	}
	
	/*
	* Provides amount of attempts already in database based on user's IP
	* @param string $ip
	* @return int $attempt_count
	*/
	
	function getattempt($ip)
	{
		$query = $this->mysqli->prepare("SELECT count FROM attempts WHERE ip = ?");
		$query->bind_param("s", $ip);
		$query->bind_result($attempt_count);
		$query->execute();
		$query->store_result();
		$count = $query->num_rows;
		$query->fetch();
		$query->close();
		
		if($count == 0)
		{
			$attempt_count = 0;
		}
		
		return $attempt_count;
	}
	
	/*
	* Function used to remove expired attempt logs from database (Recommended as Cron Job)
	*/
	
	function expireattempt()
	{
		$query = $this->mysqli->prepare("SELECT ip, expiredate FROM attempts");
		$query->bind_result($ip, $expiredate);
		$query->execute();
		$query->store_result();
		$count = $query->num_rows;
		
		$curr_time = strtotime(date("Y-m-d H:i:s"));
		
		if($count != 0)
		{
			while($query->fetch())
			{
				$attempt_expiredate = strtotime($expiredate);
				
				if($attempt_expiredate <= $curr_time)
				{
					$query2 = $this->mysqli->prepare("DELETE FROM attempts WHERE ip = ?");
					$query2->bind_param("s", $ip);
					$query2->execute();
					$query2->close();
				}
			}
		}
	}
	
	/*
	* Logs users actions on the site to database for future viewing
	* @param string $username
	* @param string $action
	* @param string $additionalinfo
	* @return boolean
	*/
	
	function LogActivity($username, $action, $additionalinfo = "none")
	{
	
		if(strlen($username) == 0) { $username = "GUEST"; }
		elseif(strlen($username) < 3) { $this->errormsg[] = $this->lang[$this->loc]['auth']['logactivity_username_short']; return false; }
		elseif(strlen($username) > 30) { $this->errormsg[] = $this->lang[$this->loc]['auth']['logactivity_username_long']; return false; }
		
		if(strlen($action) == 0) { $this->errormsg[] = $this->lang[$this->loc]['auth']['logactivity_action_empty']; return false; }
		elseif(strlen($action) < 3) { $this->errormsg[] = $this->lang[$this->loc]['auth']['logactivity_action_short']; return false; }
		elseif(strlen($action) > 100) { $this->errormsg[] = $this->lang[$this->loc]['auth']['logactivity_action_long']; return false; }
		
		if(strlen($additionalinfo) == 0) { $additionalinfo = "none"; }
		elseif(strlen($additionalinfo) > 500) { $this->errormsg[] = $this->lang[$this->loc]['auth']['logactivity_addinfo_long']; return false; }
		
		if(count($this->errormsg) == 0)
		{
			$ip = $_SERVER['REMOTE_ADDR'];
			$date = date("Y-m-d H:i:s");
			
			$query = $this->mysqli->prepare("INSERT INTO activitylog (date, username, action, additionalinfo, ip) VALUES (?, ?, ?, ?, ?)");
			$query->bind_param("sssss", $date, $username, $action, $additionalinfo, $ip);
			$query->execute();
			$query->close();
			
			return true;
		}
	}
	/*
	* Hash user's password with SHA512, base64_encode, ROT13 and salts !
	* @param string $password
	* @return string $password
	*/
	
	function hashpass($password)
	{
		$password = hash("SHA512", base64_encode(str_rot13(hash("SHA512", str_rot13($this->salt_1 . $password . $this->salt_2)))));
		return $password;
	}
}
?>