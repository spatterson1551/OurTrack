<?php

require_once('core/init.php');

if (Input::exists()) {

	if (Input::get('genre')) {

		$genre = Input::get('genre');

		if (in_array($genre, $GLOBALS['config']['genres'])) {
			//good genre value, so retrieve its stuff from the database.
			$tracks = Database::getInstance()->fetchToClass("SELECT * FROM tracks WHERE `genre`='".escape($genre)."'", "Track");
			$string = '';
			foreach($tracks as $track) {
				$string .= $track->displayMini();
			}
			echo $string;
		} else if ($genre === 'All' || $genre === 'all') {
			$tracks = Database::getInstance()->fetchToClass("SELECT * FROM tracks", "Track");
			$string = '';
			foreach($tracks as $track) {
				$string .= $track->displayMini();
			}
			echo $string;
		} else {

		}

	}
}

?>