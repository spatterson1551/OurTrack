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
			throw new Exception("There was an error creating the track");
		}
	}

	public function displayForProfile() {
		$owner = new User($this->owner_id);
		$tags = Database::getInstance()->fetchToClass("SELECT * FROM tags WHERE `id` IN (SELECT `tag_id` FROM tagmaps WHERE `type` = 'track' AND `track_id`=".$this->id.")", "Tag");
		include 'includes/profileTrack.php';
	}

	public function displayMini() {
		$owner = new User($this->owner_id);
		$tags = Database::getInstance()->fetchToClass("SELECT * FROM tags WHERE `id` IN (SELECT `tag_id` FROM tagmaps WHERE `type` = 'track' AND `track_id`=".$this->id.")", "Tag");
		include 'includes/trackMini.php';
	}

	public function displayFull() {
		$owner = new User($this->owner_id);
		$tags = Database::getInstance()->fetchToClass("SELECT * FROM tags WHERE `id` IN (SELECT `tag_id` FROM tagmaps WHERE `type` = 'reply' AND `track_id`=".$this->id.")", "Tag");
		include 'includes/trackFull.php';
	}
}



?>