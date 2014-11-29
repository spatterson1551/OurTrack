<?php

require_once('core/init.php');

$user = new User();

if ($user->isLoggedIn()) {
	if (Input::exists()) {
		$newBio = Input::get('bio');

		Database::getInstance()->update('users', $user->id, array(
			'bio' => $newBio
		));

		echo $newBio;
	} 
}






?>