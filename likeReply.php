<?php

require_once('core/init.php');

$user = new User();

if ($user->isLoggedIn()) {
	if (Input::exists()) {

		if (Input::get('reply_id')) {

			$reply_id = Input::get('reply_id');

			$update = Database::getInstance()->query("UPDATE replies SET `likes`=`likes`+1 WHERE `id`=?", array($reply_id));
			if(!$update->error()) {
				$rlike = new Rlike();
				try {
					$rlike->create(array(
					'reply_id' => $reply_id,
					'user_id' => $user->id
					));
				} catch (Exception $e) {
					echo 'fail';
				}
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