<?php

require_once('core/init.php');

$user = new User();

if (isset($_FILES['file'])) {

	$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

	if ($ext == 'jpg' || $ext == 'jpeg' || $ext = 'png') {
		if ($_FILES['file']['type'] == 'image/png' || $_FILES['file']['type'] == 'image/jpeg') {
			if ($_FILES['file']['size'] <= 5*MB) {
				$newName = uniqid();
				move_uploaded_file($_FILES['file']['tmp_name'], 'profileImages/'.$newName.".".$ext);
				Database::getInstance()->update('users', $user->id, array('picture' => $newName.".".$ext));
				echo 'profileImages/'.$newName.".".$ext;
			} else {
				echo 'invalid';
			}
		} else {
			echo 'invalid';
		}
	} else {
		echo 'invalid';
	}
}



?>