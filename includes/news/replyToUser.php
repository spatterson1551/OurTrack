<?php 
	$newsuser = new User($news->user_id);
	$newsreply = Database::getInstance()->fetchToClass("SELECT * FROM replies WHERE `id`=".$news->action_id, "Reply");
	$newstrack = Database::getInstance()->fetchToClass("SELECT * FROM tracks WHERE `id`=".$news->object_id, "Track");
?>

<div class="col-xs-12">
	<a href=<?php echo '"profile.php?id='.$news->user_id.'"';?>><?php echo $newsuser->username; ?></a> left a reply to your track: <a href=<?php echo '"track.php?id='.$newstrack[0]->id.'"'; ?>><?php echo $newstrack[0]->title ?></a>
	<?php echo $newsreply[0]->displayForProfile(); ?>
</div>