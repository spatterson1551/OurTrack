<?php

require_once('core/init.php');

$user = new User();

if ($user->isLoggedIn()) {
	if (Input::exists()) {

		if (Input::get('track_id')) {

			$track_id = Input::get('track_id');

			$update = Database::getInstance()->query("UPDATE tracks SET `likes`=`likes` - 1 WHERE `id`=?", array($track_id));
			if(!$update->error()) {
				$deleteLike = Database::getInstance()->query("DELETE FROM likes WHERE `track_id`= ? AND `user_id`= ?", array($track_id, $user->id));
				if (!$deleteLike->error()) {
					echo 'success';
				} else {
					echo 'fail';
				}
			} else {
				echo 'fail';
			}
		}
	}
} else {
	echo 'fail';
}

?>