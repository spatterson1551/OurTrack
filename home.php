<?php

require_once('core/init.php');

$tracks = Database::getInstance()->rawQuery()

?>


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="bootstrap/jquery/jquery-2.0.3.js"></script>
  <script src="js/search.js"></script>
  <script src="js/likeTrack.js"></script>
  <script src="js/changeSortMethod.js"></script>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="css/mainLayout.css" rel="stylesheet">
  <link href="css/browse.css" rel="stylesheet">
  <title>OurTrack</title>
</head>
<body>
  <!--************* begin header ****************-->
	<?php include 'includes/header.php' ?>
  <!--************* end header ****************-->
	
  <!--************* begin content area ****************-->
  <div class="container" style="margin-top:80px;">
    <div class="row" style="margin-bottom:80px;">
      <div class="col-xs-3" style="margin-top: 0px;">
        <div class="col-xs-12">
          <h4> Categories: </h4>
        </div>
        <div id="categoryBox" class="col-xs-12">
          <div id="categorySelected" class="categoryListItem">
            All
          </div>
          <div class="categoryListItem">
            Alternative
          </div>
          <div class="categoryListItem">
            Blues
          </div>
          <div class="categoryListItem">
            Classical
          </div>
          <div class="categoryListItem">
            Country
          </div>
          <div class="categoryListItem">
            Disco
          </div>
          <div class="categoryListItem">
            Drum and Bass
          </div>
          <div class="categoryListItem">
            Dubstep
          </div>
          <div class="categoryListItem">
            Electronic
          </div>
          <div class="categoryListItem">
            Folk
          </div>
          <div class="categoryListItem">
            Hardcore
          </div>
          <div class="categoryListItem">
            Hip Hop
          </div>
          <div class="categoryListItem">
            House
          </div>
          <div class="categoryListItem">
            Indie
          </div>
          <div class="categoryListItem">
            Jazz
          </div>
          <div class="categoryListItem">
            Latin
          </div>
          <div class="categoryListItem">
            Metal
          </div>
          <div class="categoryListItem">
            Minimal
          </div>
          <div class="categoryListItem">
            Other
          </div>
          <div class="categoryListItem">
            Piano
          </div>
          <div class="categoryListItem">
            Pop
          </div>
          <div class="categoryListItem">
            Progressive
          </div>
          <div class="categoryListItem">
            Punk
          </div>
          <div class="categoryListItem">
            R and B
          </div>
          <div class="categoryListItem">
            Rap
          </div>
          <div class="categoryListItem">
            Reggae
          </div>
          <div class="categoryListItem">
            Rock
          </div>
          <div class="categoryListItem">
            Soul
          </div>
          <div class="categoryListItem">
            Techno
          </div>
          <div class="categoryListItem">
            Trap
          </div>
          <div class="categoryListItem">
            World
          </div>
        </div>
      </div>
      <div class="col-xs-9">
        <div class="row">
          <div class="col-xs-4 col-xs-offset-8">
            <div class="inline-form">
              <label class="control-label col-xs-4" for="sortDropDown" style="text-align: right; padding-top: 5px;">Sort By:</label>
              <div class="form-group col-xs-8">
                <select id="sortDropDown" class="form-control">
                  <option value="top">Top Rated</option>
                  <option value="new">New</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      <!-- the following is the container for the size of ONE track in its "list view", i.e. the way itll show them when browsing on pages" -->
        <div class="col-xs-12 trackListElement">
          <div class="row">
            <div class="col-xs-2 trackThumb">
              <img src="images/ajeif45s843l.jpg" width="120" height="120"  alt="Track Thumb"/>
            </div>
            <div class="col-xs-10">
              <div class="row">
                <div class="col-xs-6">
                  <p><a href="track.html" class="trackTitle">Track Title</a>
                  by <a href="profile.html" class="trackOwner">Owner</a></p>
                </div>
                <div class="col-xs-2 col-xs-offset-4">
                  <p style="float:right"><span class="numLikes">24</span> likes</p>
                </div>
              </div>
              <div class="row audioSection">
                <div class="col-xs-10">
                  <audio class="audioPlayer" controls="controls">
                  <source src="tracks/.mp3" type="audio/mpeg" />
                    Update your browser to play audio
                  </audio>
                </div>
                <div class="col-xs-2">
                  <button type="button" class="btn btn-default right likeTrack" value="1">Like</button>
                </div>
              </div>
              <div class="tagSection">
                <div class="tag">
                  tag 1
                </div>
                <div class="tag">
                  tag 2
                </div>
                <div class="trackCatDate">
                  <span>posted in <a href="#">Category</a><span class="daysSincePost"> 5</span> days ago</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      <!-- end track container here, the following are just duplicates so you get the idea-->
        <div class="col-xs-12 trackListElement">
          <div class="row">
            <div class="col-xs-2 trackThumb">
              <img src="images/ajeif45s843l.jpg" width="120" height="120"  alt="Track Thumb"/>
            </div>
            <div class="col-xs-10">
              <div class="row">
                <div class="col-xs-6">
                  <p><a href="track.html" class="trackTitle">Track Title</a>
                  by <a href="profile.html" class="trackOwner">Owner</a></p>
                </div>
                <div class="col-xs-2 col-xs-offset-4">
                  <p style="float:right"><span class="numLikes">24</span> likes</p>
                </div>
              </div>
              <div class="row audioSection">
                <div class="col-xs-10">
                  <audio class="audioPlayer" controls="controls">
                  <source src="tracks/.mp3" type="audio/mpeg" />
                    Update your browser to play audio
                  </audio>
                </div>
                <div class="col-xs-2">
                  <button type="button" class="btn btn-default right likeTrack" value="2">Like</button>
                </div>
              </div>
              <div class="tagSection">
                <div class="tag">
                  tag 1
                </div>
                <div class="tag">
                  tag 2
                </div>
                <div class="trackCatDate">
                  <span>posted in <a href="#">Category</a><span class="daysSincePost"> 5</span> days ago</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xs-12 trackListElement">
          <div class="row">
            <div class="col-xs-2 trackThumb">
              <img src="images/ajeif45s843l.jpg" width="120" height="120"  alt="Track Thumb"/>
            </div>
            <div class="col-xs-10">
              <div class="row">
                <div class="col-xs-6">
                  <p><a href="track.html" class="trackTitle">Track Title</a>
                  by <a href="profile.html" class="trackOwner">Owner</a></p>
                </div>
                <div class="col-xs-2 col-xs-offset-4">
                  <p style="float:right"><span class="numLikes">24</span> likes</p>
                </div>
              </div>
              <div class="row audioSection">
                <div class="col-xs-10">
                  <audio class="audioPlayer" controls="controls">
                  <source src="tracks/.mp3" type="audio/mpeg" />
                    Update your browser to play audio
                  </audio>
                </div>
                <div class="col-xs-2">
                  <button type="button" class="btn btn-default right likeTrack" value="3">Like</button>
                </div>
              </div>
              <div class="tagSection">
                <div class="tag">
                  tag 1
                </div>
                <div class="tag">
                  tag 2
                </div>
                <div class="trackCatDate">
                  <span>posted in <a href="#">Category</a><span class="daysSincePost"> 5</span> days ago</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--************* end content area ****************-->


  <!-- This is here at the bottom so that we can load parts of the page before we load the js file, which makes the website run a little faster -->
	<script src="bootstrap/js/bootstrap.min.js"></script>


  <!--************* begin footer ****************-->
	<?php include 'includes/footer.php' ?>	
	<!--************* end footer ****************-->
</body>
</html>