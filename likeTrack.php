<?php

//NOT FINISHED YET

require_once('core/init.php');

$user = new User();

if ($user->isLoggedIn()) {
	if (Input::exists()) {

		if (Input::get('track_id')) {

			$track_id = Input::get('track_id');

			$update = Database::getInstance()->query("UPDATE tracks SET `likes`=`likes`+1 WHERE `id`=?", array($track_id));
			if(!$update->error()) {
				$like = new Like();
				// try {
				// 	$like->create(array(
				// 	'track_id' => $track_id,
				// 	'user_id' => $user->id
				// 	));
				// 	echo 'success';
				// } catch (Exception $e) {
				// 	echo 'fail';
				// }
				echo 'success';
			} else {
				echo 'fail';
			}
		}
	}
} else {
	echo 'fail';
}

?>