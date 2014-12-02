<?php

require_once('core/init.php');

$user = new User();

if ($user->isLoggedIn()) {
	if (Input::exists()) {

		if (Input::get('reply_id')) {

			$reply_id = Input::get('reply_id');

			$update = Database::getInstance()->query("UPDATE replies SET `likes`=`likes` - 1 WHERE `id`=?", array($reply_id));
			if(!$update->error()) {
				Database::getInstance()->query("DELETE FROM rlikes WHERE `reply_id`= ? AND `user_id`= ?", array($reply_id, $user->id));
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