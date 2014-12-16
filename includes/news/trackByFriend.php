<?php 
	$newsuser = new User($news->user_id);
	$newstrack = Database::getInstance()->fetchToClass("SELECT * FROM tracks WHERE `id`=".$news->action_id, "Track");
	//$trackOwner = new User($track[0]->owner_id);
?>

<div class="col-xs-12">
	<a href=<?php echo '"profile.php?id='.$news->user_id.'"';?>><?php echo $newsuser->username; ?></a> posted a new track:
	<?php echo $newstrack[0]->displayForProfile(); ?>
</div>