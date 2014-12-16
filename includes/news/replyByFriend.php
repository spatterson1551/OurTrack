<?php 
	$newsuser = new User($news->user_id);
	$newsreply = Database::getInstance()->fetchToClass("SELECT * FROM replies WHERE `id`=".$news->action_id, "Reply");
	$newstrack = Database::getInstance()->fetchToClass("SELECT * FROM tracks WHERE `id`=".$news->object_id, "Track");
	$newstrackOwner = new User($newstrack[0]->owner_id);
?>

<div style="float:left;">
	<a href=<?php echo '"profile.php?id='.$news->user_id.'"';?>><?php echo $newsuser->username; ?></a> left a reply to the track: <a href=<?php echo '"track.php?id='.$newstrack[0]->id.'"'; ?>><?php echo $newstrack[0]->title ?></a> by <a href=<?php echo '"profile.php?id='.$newstrackOwner->username.'"';?>><?php echo $newstrackOwner->username; ?></a>
</div>
<?php echo $newsreply[0]->displayForProfile(); ?>