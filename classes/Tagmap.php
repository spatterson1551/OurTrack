<?php


class Tagmap {
	
	public $id;
	public $tag_id;
	public $track_id;


	private $db;
	//private $data;

	public function create($fields = array()) {
		$this->db = Database::getInstance();
		if (!$this->db->insert('tagmaps', $fields)) {
			throw new Exception("There was an error recording the tagmaps");
		}
	}

}



?>