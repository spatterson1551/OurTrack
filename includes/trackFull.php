<div class="row">
	<div class="col-xs-12">
		<div id="trackHead" data-id=<?php echo '"'.$this->id.'"'; ?>>
			<div class="row">
				<div class="col-xs-3 tCenter">
					<img src=<?php echo '"trackImages/'.$this->picture.'"'; ?> height="200" alt="mainTrackImg"/>
				</div>
				<div class="col-xs-7">
					<div class="row topTrackInfo">
						<div class="col-xs-12">
							<h2><a href=<?php echo '"track.php?id='.$this->id.'"';?> class="trackTitle">Track Title</a>
								by <a href=<?php echo '"profile.php?id='.$owner->id.'"';?> class="trackOwner"><?php echo $owner->username ?></a>
							</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-8">
							<audio class="topAudioPlayer" controls="controls">
									<source src=<?php echo '"trackAudio/'.$this->source.'"';?> type="audio/mpeg" />
										Update your browser to play audio
							</audio>
						</div>
						<div class="col-xs-2">
							<a href=<?php echo '"trackAudio/'.$this->source.'"';?> target="_blank" class="btn btn-primary ">Download</a>
						</div>
						<div class="col-xs-2">
								<?php if($this->userLikesTrack()) { ?>
									<button type="button" class="btn btn-default unlikeTrack" value=<?php echo '"'.$this->id.'"'; ?>>Unlike</button>
								<?php } else { ?>
									<button type="button" class="btn btn-default likeTrack" value=<?php echo '"'.$this->id.'"'; ?>>Like</button>
								<?php } ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="row">
								<div class="col-xs-4">
									<div style="text-align:center" class="raty"></div>
								</div>
								<div class="col-xs-3">
									<?php 
									foreach($tags as $tag)
									{
							          echo "<div class='tag'>".$tag."</div>";
							        }
							        ?>
								</div>
								<div class="col-xs-3">
									<h4><span id="trackLikes"><?php echo $this->likes ?></span> likes</h4>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 center-block" style="margin-top: 30px;">
							<p><?php echo $this->description; ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>







		