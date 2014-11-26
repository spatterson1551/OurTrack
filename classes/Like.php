<?php

class Like {

	public $id;
	public $track_id;
	public $user_id;
	public $created_at;

	private $db;

	public function create($fields = array()) {
		$this->db = Database::getInstance();
		if (!$this->db->insert('likes', $fields)) {
			throw new Exception("There was an error recording the likes");
		}
	}
}




?>