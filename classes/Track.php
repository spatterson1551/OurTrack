<?php


class Track {


	public $owner_id;
	public $picture;
	public $source;
	public $title;
	public $description;
	public $genre;
	public $likes;
	public $created_at;

	private $db;

	public function __construct($id = null) {

		$this->db = Database::getInstance();

		if ($id) {
			$data = $this->db->get('tracks', array('id', '=', $id));

			if ($data->count()) {
				$this->owner_id = $data->first()->owner_id;
				$this->title = $data->first()->title;
				$this->picture = $data->first()->picture;
				$this->source = $data->first()->source;
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
		$owner = new User($this->owner_id);
		$tags = Database::getInstance()->fetchToClass("SELECT * FROM tags WHERE `id` IN (SELECT `tag_id` FROM tagmaps WHERE `track_id`=".$this->id.")", "Tag");
		include 'includes/trackMini.php';
	}

	public function displayFull() {
		//get all stuff from the database
		//include a file for it
		//put all the html in there, with the php output sprinkled in, you can look at the above one for reference,
		//because its basically the same thing except different html formatting.
	}
}



?>