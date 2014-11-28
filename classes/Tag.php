<?php

class Tag {

	public $id;
	public $name;

	private $db;

	public function __toString() {
		return '<div class="tag">'.$this->name.'</div>';
	}

	public function create($fields = array()) {
		$this->db = Database::getInstance();
		if (!$this->db->insert('tags', $fields)) {
			throw new Exception("There was an error recording the tags");
		}
	}
}




?>