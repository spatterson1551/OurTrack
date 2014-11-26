<?php
  require_once('core/init.php');

  $user = new User();
  if (!$user->isloggedIn()) {
    Redirect::to('login.php');
  }

?>

<!DOCTYPE html>
<html>
  <head>
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="bootstrap/jquery/jquery-2.0.3.js"></script>
    <script src="js/editBio.js"></script>
    <script src="js/editPicture.js"></script>
  	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/mainLayout.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">
    <link href="css/profileTrack.css" rel="stylesheet">
    <title>OurTrack</title>
  </head>
  <body>
    <!--************* begin header ****************-->
  	<?php include 'includes/header.php' ?>
    <!--************* end header ****************-->
  	
    <!--************* begin content area ****************-->
    <div class="container" style="margin-top: 2.857em;">
      <div class="col-xs-9" style="margin-bottom: 5.714em;">
        <div class="col-xs-12" style="height: 10.714em; padding-left: 1.786em; margin-bottom: 2.857em;">
          <div class="col-xs-3" style="padding:0em;" id="profilePictureContainer">
            <img id="profilePicture" src="profileImages/default.png" alt="profile picture">
            <form method="POST" action="#" accept-charset="UTF-8" id="pictureForm" enctype="multipart/form-data">
              <input type="file" name="picture" style="visibility:hidden" id="fileDialog">
            </form>
            <div class="col-xs-12" id="editPicture" style="position:absolute;top:0;left:0;padding:4px;background:rgba(255, 255, 255, .3);height:16%;width:13%;font-size:16px;"> 
              <span class="glyphicon glyphicon-pencil"></span>
            </div>
          </div>
          <div class="col-xs-9">
            <h3 style="margin: 0em;"> Your Feed </h3>
            <h4 style="margin: 0em;"> <small> 12 tracks </small> </h4>
            <h4 style="margin: 0em;"> <small> 100 followers </small> </h4>
          </div>
        </div>
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
              <li class="active"><a href="#news" data-toggle="tab">NEWS</a></li>
              <li><a href="#tracks" data-toggle="tab">TRACKS</a></li>
              <li><a href="#replies" data-toggle="tab">REPLIES</a></li>
              <li><a href="#likes" data-toggle="tab">LIKES</a></li>
          </ul>
        </div>
        <div class="tab-content">
          <div class="tab-pane fade in active" id="news">
            <div class="col-xs-12">
              <p> List of important news, such as tracks posted by collaborators or users you follow, new friendships made by people you collab with,
                etc. will go here.
              </p>
            </div>
          </div>
          <div class="tab-pane fade" id="tracks">
            <div class="col-xs-12">
              <!-- ********** Begin Single Track Representation for a track on Profile List **************-->
              <div class="profileTrack">
                <div class="trackImage">
                  <img src="images/ajeif45s843l.jpg" alt="track image">
                </div>
                <div class="trackContent">
                  <div class="trackTitleOwnerTeaser">
                    <div class="trackTitle">
                      <a href="track.html">
                        TRACK TITLE
                      </a>
                    </div>
                    <div class="trackOwner">
                      by <a href="#"> User </a>
                    </div><br>
                    <div class="trackAudio">
                      <!-- design of this is subject to change -->
                      <audio controls="controls">
                        <source src="tracks/.mp3" type="audio/mpeg" />
                        Update your browser to play audio
                      </audio>
                    </div>
                  </div>
                  <div class="trackLikes">
                    12 <br> likes
                  </div>
                  <div class="trackTags">
                    <div class="trackTag">
                      tag1
                    </div>
                    <div class="trackTag">
                      tag2
                    </div>
                  </div>
                  <div class="trackCatDate">
                    posted in <a href="#">Category</a> 
                    1 day ago
                  </div>
                </div>
              </div>
              <!-- ********** End Single Track Representation for a track on Profile List **************-->
            </div>
          </div>
          <div class="tab-pane fade" id="replies">
            <div class="col-xs-12">
              <div class="profileTrack">
                <div class="trackImage">
                  <img src="images/ajeif45s843l.jpg" alt="track image">
                </div>
                <div class="trackContent">
                  <div class="trackTitleOwnerTeaser">
                    <div class="trackTitle">
                      <a href="track.html">
                        TRACK TITLE
                      </a>
                    </div>
                    <div class="trackOwner">
                      by <a href="#"> User </a>
                    </div><br>
                    <div class="trackAudio">
                      <!-- design of this is subject to change -->
                      <audio controls="controls">
                        <source src="tracks/.mp3" type="audio/mpeg" />
                        Update your browser to play audio
                      </audio>
                    </div>
                  </div>
                  <div class="trackLikes">
                    12 <br> likes
                  </div>
                  <div class="trackTags">
                    <div class="trackTag">
                      tag3
                    </div>
                  </div>
                  <div class="trackCatDate">
                    in Reply to <a href="#"> Track Link </a> by <a href="#"> User </a>
                    1 day ago
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="likes">
            <div class="col-xs-12">
              <div class="profileTrack">
                <div class="trackImage">
                  <img src="images/ajeif45s843l.jpg" alt="track image">
                </div>
                <div class="trackContent">
                  <div class="trackTitleOwnerTeaser">
                    <div class="trackTitle">
                      <a href="track.html">
                        TRACK TITLE
                      </a>
                    </div>
                    <div class="trackOwner">
                      by <a href="#"> User </a>
                    </div><br>
                    <div class="trackAudio">
                      <!-- design of this is subject to change -->
                      <audio controls="controls">
                        <source src="tracks/.mp3" type="audio/mpeg" />
                        Update your browser to play audio
                      </audio>
                    </div>
                  </div>
                  <div class="trackLikes">
                    12 <br> likes
                  </div>
                  <div class="trackTags">
                    <div class="trackTag">
                      tag3
                    </div>
                  </div>
                  <div class="trackCatDate">
                    in Reply to <a href="#"> Track Link </a> by <a href="#"> User </a>
                    1 day ago
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-3" id="userBio">
        <div class="row">
          <div class="col-xs-12">
            <div class="row">
              <div class="col-xs-6 sideHeader">
                <h3> <small> BIOGRAPHY </small> </h3>
              </div>
              <div class="col-xs-6 seeAllButton">
                <a href="" data-toggle="modal" data-target="#bioModal"> <span class="glyphicon glyphicon-pencil"></span></a>
              </div>
            </div>
            <div class="row">
              <p>
                This is a short bio about the user that will give basic info about that person that the user can edit.
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="row">
              <div class="col-xs-6 sideHeader">
                <h3> <small> FOLLOWERS </small> </h3>
              </div>
              <div class="col-xs-6 seeAllButton">
                <a href="" data-toggle="modal" data-target="#followersModal">see all</a>
              </div>
            </div>
            <div class="row">
              <a href="#">username1</a><br>
              <a href="#">username2</a><br>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="row">
              <div class="col-xs-6 sideHeader">
                <h3> <small> FOLLOWS </small> </h3>
              </div>
              <div class="col-xs-6 seeAllButton">
                <a href="" data-toggle="modal" data-target="#followsModal">see all</a>
              </div>
            </div>
            <div class="row">
              <a href="#">username1</a> <br>
              <a href="#">username2</a> <br>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="bioModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <b> Edit Your Bio </b>
            <button type="button" class="close glyphicon glyphicon-remove" data-dismiss="modal" aria-hidden="true"></button>
          </div>
          <div class="modal-body" id="bioModalBody">
            <div class="errors">
            </div>
            <div id="bioForm">
              <textarea class="form-control" id="bioContent" name="bio" cols="50" rows="10"> This is a short bio about the user that will give basic info about that person that the user can edit.
              </textarea>
            </div>
          </div>
          <div class="modal-footer" id="bioModalFooter">
            <button type="button" class="btn btn-default btn-sm" id="saveBio"> Save </button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="followersModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close glyphicon glyphicon-remove" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                  <a href="#">username1</a><br>
                  <a href="#">username2</a><br>
                </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="followsModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close glyphicon glyphicon-remove" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                  <a href="#">username1</a><br>
                  <a href="#">username2</a><br>
                </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                   <b> Oops! </b>
                   <button type="button" class="close glyphicon glyphicon-remove" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                   You must be logged in to do that!
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-sm"> Login </button>
                </div>
          </div>
        </div>
    </div>
    <!--************* end content area ****************-->


    <!-- This is here at the bottom so that we can load parts of the page before we load the js file, which makes the website run a little faster -->
  	<script src="bootstrap/js/bootstrap.min.js"></script>


    <!--************* begin footer ****************-->
  	<?php include 'includes/footer.php'; ?>
  	<!--************* end footer ****************-->
  </body>
</html>