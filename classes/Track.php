<?php


class Track {


	public $owner_id;
	public $picture;
	public $title;
	public $description;
	public $genre;
	public $likes;
	public $created_at;

	private $db;

	private function __construct($id = null) {

		$this->db = Database::getInstance();

		if ($id) {
			$data = $this->db->get('tracks', array('id', '=', $id));

			if ($data->count()) {
				$this->owner_id = $data->first()->owner_id;
				$this->title = $data->first()->title;
				$this->picture = $data->first()->picture;
				$this->description = $data->first()->description;
				$this->genre = $data->first()->genre;
				$this->likes = $data->first()->likes;
				$this->created_at = $data->first()->created_at;
			}
		}
	}

	public function create($fields = array()) {
		if (!$this->db->insert('tracks', $fields)) {
			throw new Exception("There was an error registering the user");
		}
	}

	public function displayMini() {

	}

	public function displayFull() {

	}

}



?>