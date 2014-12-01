<?php

	require_once('core/init.php');

	$user = new User();

	if (Input::exists('post')) {

		$id = Input::get('id');

		if ($user->isLoggedIn()) {
			Database::getInstance()->insert('collaborators', array(
				'user1_id' => $id,
				'user2_id' => $user->id
			));
			echo 'valid';
		} else {
			echo 'invalid';
		}
	}
	
?>