<?php

class User {

	public $id;
	public $username;
	public $email;
	public $password;
	public $salt;
	public $bio;
	public $picture;
	public $url;

	private $db;
	//private $data;
	private $sessionName;
	private $loggedIn;

	public function __construct($user = null) {
		$this->db = Database::getInstance();
		$this->sessionName = $GLOBALS['config']['session']['session_name'];

		if (!$user) {
			if (Session::exists($this->sessionName)) {
				$user = Session::get($this->sessionName);

				if ($this->find($user)) {
					$this->loggedIn = true;
				} else {
					//log out
				}
			}
		} else {
			$this->find($user);
		}
	}

	public function create($fields = array()) {
		if (!$this->db->insert('users', $fields)) {
			throw new Exception("There was an error registering the user");
		}
	}

	public function find($user = null) {
		if ($user) {
			$field = (is_numeric($user)) ? 'id' : 'email';
			$data = $this->db->get('users', array($field, '=', $user));

			if ($data->count()) {
				//$this->data = $data->first();
				$this->id = $data->first()->id;
				$this->username = $data->first()->username;
				$this->email = $data->first()->email;
				$this->password = $data->first()->password;
				$this->salt = $data->first()->salt;
				$this->bio = $data->first()->bio;
				$this->picture = $data->first()->picture;
				$this->url = $data->first()->url;
				return true;
			}
		}
		return false;
	}

	public function login($email = null, $password = null, $remember) {
		$user = $this->find($email);

		if ($user) {
			if ($this->password === Hash::make($password, $this->salt)) {
				Session::put($this->sessionName, $this->id);

				if ($remember) {

				}

				return true;
			}
		}

		return false;
	}

	public function logout() {
		Session::delete($this->sessionName);
		$this->loggedIn = false;
	}

	public function isLoggedIn() {
		return $this->loggedIn;
	}

	// public function data() {
	// 	return $this->data;
	// }


}


?>