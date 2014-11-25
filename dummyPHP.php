<?php

require_once('core/init.php');


//this is just some testing I'm doing as I'm building out class functionality
$tracks = Database::getInstance()->fetchToClass("SELECT * FROM tracks ORDER BY `likes` DESC", 'Track');

foreach($tracks as $track) {
	$tags = Database::getInstance()->fetchToClass("SELECT * FROM tags WHERE `id` IN (SELECT `tag_id` FROM tagmaps WHERE `track_id`=".$track->id.")", "Tag");
	
	foreach($tags as $tag) {
		echo $tag;
	}
}


?>