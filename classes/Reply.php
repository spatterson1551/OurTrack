<?php


class Reply {


	public $owner_id;
	public $track_id;
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
			$data = $this->db->get('replies', array('track_id', '=', $track_id));

			if ($data->count()) {
				$this->owner_id = $data->first()->owner_id;
				$this->track_id = $data->first()->track_id;
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
		if (!$this->db->insert('replies', $fields)) {
			throw new Exception("There was an error for the reply");
		}
	}

	public function displayMini() {
		$owner = new User($this->owner_id);
		$tags = Database::getInstance()->fetchToClass("SELECT * FROM tags WHERE `id` IN (SELECT `tag_id` FROM tagmaps WHERE `track_id`=".$this->id.")", "Tag");
		include 'includes/replyMini.php';
	}
}



?>