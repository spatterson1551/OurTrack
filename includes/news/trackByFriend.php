<?php 
	$newsuser = new User($news->user_id);
	$newstrack = Database::getInstance()->fetchToClass("SELECT * FROM tracks WHERE `id`=".$news->action_id, "Track");
	//$trackOwner = new User($track[0]->owner_id);
?>

<div style="float:left;">
	<a href=<?php echo '"profile.php?id='.$news->user_id.'"';?>><?php echo $newsuser->username; ?></a> posted a new track:
</div>
<?php echo $newstrack[0]->displayForProfile(); ?>