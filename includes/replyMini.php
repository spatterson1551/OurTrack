<div class="col-xs-12 trackReply">
	<div class="row">
		<div class="col-xs-2 col-xs-offset-1 trackThumb">
			<img src=<?php echo '"trackImages/'.$this->picture.'"'; ?> width="120" height="120"  alt="Track Thumb"/>
		</div>
		<div class="col-xs-9">
			<div class="row">
				<div class="col-xs-6">
					<p><a href=<?php echo '"track.php?id='.$this->id.'"';?> class="trackTitle"><?php echo $this->title ?></a>
					by <a href=<?php echo '"profile.php?id='.$owner->id.'"';?> class="trackOwner"><?php echo $owner->username ?></a></p>
				</div>
				<div class="col-xs-2 col-xs-offset-4">
					<p style="float:right"><span class="numLikes"><?php echo $this->likes ?></span> likes</p>
				</div>
			</div>
			<div class="row audioSection">
				<div class="col-xs-8">
					<audio class="audioPlayer" controls="controls">
					<source src=<?php echo '"trackAudio/'.$this->source.'"';?> type="audio/mpeg" />
						Update your browser to play audio
					</audio>
				</div>
				<div class="col-xs-4">
					<?php if ($ownerIsViewing) { ?>
						<button type="button" class="btn btn-primary downloadReply" style="margin-left:30px;">Download</button>
					<?php } ?>
					<?php if ($this->userLikesReply()) { ?>
						<button type="button" class="btn btn-default right unlikeReply" value=<?php echo '"'.$this->id.'"'?>>Unlike</button>
					<?php } else { ?>
						<button type="button" class="btn btn-default right likeReply" value=<?php echo '"'.$this->id.'"'?>>Like</button>
					<?php } ?>
				</div>
			</div>
			<div class="row tagSection">
				<?php foreach($tags as $tag) {
          			echo $tag;
        			}
        		?>
				<div class="trackCatDate">
					<span>posted<span class="daysSincePost"> 5</span> days ago</span>
				</div>
			</div>
		</div>
	</div>
</div>