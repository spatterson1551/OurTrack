<?php

require_once('core/init.php');

if (Input::exists()) {

	if (Input::get('sortBy') && Input::get('track_id')) {

		$sortBy = Input::get('sortBy');
		$track_id = Input::get('track_id');

		$track = Database::getInstance()->fetchToClass("SELECT * FROM tracks WHERE `id`=".escape($track_id).";", "Track");

		$requestingUser = new User();

		if ($requestingUser->isLoggedIn()) {
			if ($requestingUser->id == $track[0]->owner_id) {
				$theOwnerIsViewing = true;
			} else {
				$theOwnerIsViewing = false;
			}
		} else {
			//not logged in so
			$theOwnerIsViewing = false;
		}

		if ($sortBy == 'top') {
			//good genre value, so retrieve its stuff from the database.
			$replies = Database::getInstance()->fetchToClass("SELECT * FROM replies WHERE `track_id`=".escape($track_id)." ORDER BY `likes` DESC", "Reply");
			$string = '';
			foreach($replies as $reply) {
				$string .= $reply->displayMini($theOwnerIsViewing);
			}
			echo $string;
		} else if ($sortBy == 'new') {
			$replies = Database::getInstance()->fetchToClass("SELECT * FROM replies WHERE `track_id`=".escape($track_id)." ORDER BY `created_at` DESC", "Reply");
			$string = '';
			foreach($replies as $reply) {
				$string .= $reply->displayMini($theOwnerIsViewing);
			}
			echo $string;
		}
	}
}

?>