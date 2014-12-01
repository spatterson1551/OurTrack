<div class="row">
			<div class="col-xs-12">
				<div id="trackHead">
					<div class="row">
						<div class="col-xs-3 tCenter">
							<img src=<?php echo '"images/'.$this->picture.'"'; ?> height="200" alt="mainTrackImg"/>
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
								<div class="col-xs-9">
									<audio class="topAudioPlayer" controls="controls">
											<source src=<?php echo '"trackAudio/'.$this->source.'"';?> type="audio/mpeg" />
												Update your browser to play audio
									</audio>
								</div>
								<div class="col-xs-1 col-xs-offset-1">
											<button type="button" class="btn btn-primary right">Download</button>
								</div>
								<div class="col-xs-1">
											<button type="button" class="btn btn-default right likeTrack" value="1">Like</button>
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
											<h4><span><?php echo $this->likes ?></span> likes</h4>
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