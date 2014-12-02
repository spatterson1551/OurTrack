<?php


class Track {

	public $id;
	public $owner_id;
	public $picture;
	public $source;
	public $title;
	public $description;
	public $genre;
	public $withcollaborators;
	public $likes;
	public $created_at;

	private $db;

	public function __construct($id = null) {

		$this->db = Database::getInstance();

		if ($id) {
			$data = $this->db->get('tracks', array('id', '=', $id));

			if ($data->count()) {
				$this->id = $data->first()->id;
				$this->owner_id = $data->first()->owner_id;
				$this->title = $data->first()->title;
				$this->picture = $data->first()->picture;
				$this->source = $data->first()->source;
				$this->description = $data->first()->description;
				$this->genre = $data->first()->genre;
				$this->withcollaborators = $data->first()->withcollaborators;
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

	public function userLikesTrack() {
		if (!isset($user)) {
			$user = new User();
		}
		if ($user->isLoggedIn()) {
			$likeQuery = Database::getInstance()->query("SELECT * FROM likes WHERE `track_id`= ? AND `user_id`=?", array($this->id, $user->id));
			if ($likeQuery->count() > 0) {
				$likesTrack = true;
			} else {
				$likesTrack = false;
			}
		} else {
			$likesTrack = false;
		}
		return $likesTrack;
	}

	public function userCanSeeTrack() {

		if ($this->withcollaborators) {
			if (!isset($user)) {
				$user = new User();
			}
			if ($user->isLoggedIn()) {
				$user1results = Database::getInstance()->query("SELECT `user1_id` FROM collaborators WHERE `user2_id`=".$this->owner_id)->results();
			    $user2results = Database::getInstance()->query("SELECT `user2_id` FROM collaborators WHERE `user1_id`=".$this->owner_id)->results();
			    $allIds = array();
			    foreach($user1results as $user1result) {
			      array_push($allIds, $user1result->user1_id);
			    }
			    foreach($user2results as $user2result) {
			      array_push($allIds, $user2result->user2_id);
			    }
			    if (in_array($user->id, $allIds)) {
			    	return true;
			    } else {
			    	return false;
			    }
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
}



?>