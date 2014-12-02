<?php

class Rlike {
	public $id;
	public $reply_id;
	public $user_id;
	public $created_at;

	private $db;

	public function create($fields = array()) {
		$this->db = Database::getInstance();
		if (!$this->db->insert('rlikes', $fields)) {
			throw new Exception("There was an error recording the reply like");
		}
	}

}

?>