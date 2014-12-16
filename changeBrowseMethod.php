<?php
require_once('core/init.php');

if (Input::exists()) {

	if (Input::get('sortBy') && Input::get('genre')) {

		if (Input::get('searchQuery')) {
			$searchQuery = Input::get('searchQuery');
			if ($searchQuery[0] == "#") {
				$searchBy = 'tag';
				$searchQuery = ltrim($searchQuery, '#');
			} else {
				$searchBy = 'title';
			}
		} else {
			$searchQuery = '';
			$searchBy = 'title';
		}


		$sortBy = Input::get('sortBy');
		$genre = Input::get('genre');

		if ($sortBy == 'top' || $sortBy == 'new') {
			if (in_array($genre, $GLOBALS['config']['genres'])) {
				//good genre value, so retrieve its stuff from the database.
				if ($sortBy == 'top') {
					if ($searchBy == 'tag') {
						$tracks = Database::getInstance()->fetchToClass("SELECT * FROM tracks WHERE `genre`='".escape($genre)."' AND `id` IN (SELECT `track_id` FROM tagmaps WHERE `type`='track' AND `tag_id` IN (SELECT `id` FROM tags WHERE `name`='".escape($searchQuery)."')) ORDER BY `likes` DESC", "Track");
					} else if ($searchBy == 'title') {
						$tracks = Database::getInstance()->fetchToClass("SELECT * FROM tracks WHERE `genre`='".escape($genre)."' AND `title` LIKE '%".escape($searchQuery)."%' ORDER BY `likes` DESC", "Track");
					}
				} else {
					if ($searchBy == 'tag') {
						$tracks = Database::getInstance()->fetchToClass("SELECT * FROM tracks WHERE `genre`='".escape($genre)."' AND `id` IN (SELECT `track_id` FROM tagmaps WHERE `type`='track' AND `tag_id` IN (SELECT `id` FROM tags WHERE `name`='".escape($searchQuery)."')) ORDER BY `created_at` DESC", "Track");
					} else if ($searchBy == 'title') {
						$tracks = Database::getInstance()->fetchToClass("SELECT * FROM tracks WHERE `genre`='".escape($genre)."' AND `title` LIKE '%".escape($searchQuery)."%' ORDER BY `created_at` DESC", "Track");
					}
				}
				$string = '';
				foreach($tracks as $track) {
					$string .= $track->displayMini();
				}
				echo $string;
			} else if ($genre === 'All' || $genre === 'all') {
				if ($sortBy == 'top') {
					if ($searchBy == 'tag') {
						$tracks = Database::getInstance()->fetchToClass("SELECT * FROM tracks WHERE `id` IN (SELECT `track_id` FROM tagmaps WHERE `type`='track' AND `tag_id` IN (SELECT `id` FROM tags WHERE `name`='".escape($searchQuery)."')) ORDER BY `likes` DESC", "Track");
					} else if ($searchBy == 'title') {
						$tracks = Database::getInstance()->fetchToClass("SELECT * FROM tracks WHERE `title` LIKE '%".escape($searchQuery)."%' ORDER BY `likes` DESC", "Track");
					}
				} else {
					if ($searchBy == 'tag') {
						$tracks = Database::getInstance()->fetchToClass("SELECT * FROM tracks WHERE `id` IN (SELECT `track_id` FROM tagmaps WHERE `type`='track' AND `tag_id` IN (SELECT `id` FROM tags WHERE `name`='".escape($searchQuery)."')) ORDER BY `created_at` DESC", "Track");
					} else if ($searchBy = 'title') {
						$tracks = Database::getInstance()->fetchToClass("SELECT * FROM tracks WHERE `title` LIKE '%".escape($searchQuery)."%' ORDER BY `created_at` DESC", "Track");
					}
				}
				$string = '';
				foreach($tracks as $track) {
					$string .= $track->displayMini();
				}
				echo $string;
			}
		}
	}
}


?>