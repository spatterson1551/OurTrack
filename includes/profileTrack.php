<?php use Carbon\Carbon; ?>
<div class="profileTrack">
  <div class="trackImage">
    <img src=<?php echo '"trackImages/'.$this->picture.'"'; ?> alt="track image" width="200" height="150">
  </div>
  <div class="trackContent">
    <div class="trackTitleOwnerTeaser">
      <div class="trackTitle">
        <a href=<?php echo '"track.php?id='.$this->id.'"';?>>
          <?php echo $this->title ?>
        </a>
      </div>
      <div class="trackOwner">
        by <a href=<?php echo '"profile.php?id='.$owner->id.'"';?>><?php echo $owner->username ?></a>
      </div><br>
      <div class="trackAudio">
        <!-- design of this is subject to change -->
        <audio controls="controls">
          <source src=<?php echo '"trackAudio/'.$this->source.'"';?> type="audio/mpeg" />
          Update your browser to play audio
        </audio>
      </div>
    </div>
    <div class="trackLikes">
      <?php echo $this->likes ?><br> likes
    </div>
    <div class="trackTags">
      <?php foreach($tags as $tag) {
          echo $tag;
        }
      ?>
    </div>
    <div class="trackCatDate">
      <?php if (isset($this->genre)) { ?>
        posted in <a href=<?php echo '"home.php?genre='.$this->genre.'"';?> ><?php echo $this->genre ?></a> 
      <?php } else { ?>
        posted
      <?php } ?>
      <?php echo Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();?>
    </div>
  </div>
</div>