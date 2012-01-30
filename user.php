<?php
include 'redbean/rb.php';

class UserService {
	protected $_email;    // using protected so they can be accessed
	protected $_password; // and overidden if necessary

	protected $_user;     // stores the user data

	public function __construct($email, $password)	{
		$this->_email = $email;
		$this->_password = $password;
	}

	public function login()	{
		$user = $this->_checkCredentials();
		if ($user) {
			$this->_user = $user; // store it so it can be accessed later
			$_SESSION['user_id'] = $user->id;
			return $user['id'];
		}
		return false;
	}

	public function register()	{
		$user = R::dispense('user');
		$user->email = $this->_email;

		$user->salt = $this->_salt();
		$user->password = sha1($user->salt.$this->_password);

		R::store($user);

		$this->login();
	}

	protected function _checkCredentials()	{
		$user = R::findOne('user', 'email = ?', array($this->_email));
		if ($user != null) {
			$submitted_pass = sha1($user->salt.$this->_password);
			if ($submitted_pass == $user['password']) {
				return $user;
			}
		}
		return false;
	}

	protected function _salt()	{

		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$salt = '';
		
		for ($j = 0; $j < 12; $j++) {
			$salt .= $chars{mt_rand(0,strlen($chars)-1)};
		}
		
		return $salt;

	}

	public function getUser()	{
		return $this->_user;
	}
}
?>