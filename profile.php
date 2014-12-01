<?php

require_once('core/init.php');


if (Input::exists('get')) {
  $id = intval(Input::get('id'));

  if (!is_int($id) || $id == 0) {
    Redirect::to(404);
  }

  $user = new User($id);
  
  if ($user->username == NULL) {
    Redirect::to(404);
  }
  $currentUser = new User();

  //all tracks the user owns.
  $tracks = Database::getInstance()->fetchToClass("SELECT * FROM tracks WHERE `owner_id`=".$user->id, 'Track');
  //all tracks the user likes.
  $likes = Database::getInstance()->fetchToClass("SELECT * FROM tracks WHERE `id` IN (SELECT `track_id` FROM likes WHERE `user_id`=".$user->id.")", 'Track');
  //all tracks the user has left as replies
  $replies = Database::getInstance()->fetchToClass("SELECT * FROM replies WHERE `owner_id`=".$user->id, 'Track');
  //all the people that follow the user
  $followers = Database::getInstance()->query("SELECT `username`, `id` FROM users WHERE `id` IN (SELECT `follower_id` FROM followers WHERE `user_id`=".$user->id.")")->results();
  //all people the user follows
  $follows = Database::getInstance()->query("SELECT `username`, `id` FROM users WHERE `id` IN (SELECT `user_id` FROM followers WHERE `follower_id`=".$user->id.")")->results();
  //get all collaborators
  $user1results = Database::getInstance()->query("SELECT `user1_id` FROM collaborators WHERE `user2_id`=".$user->id)->results();
  $user2results = Database::getInstance()->query("SELECT `user2_id` FROM collaborators WHERE `user1_id`=".$user->id)->results();
  $allIds = array();
  foreach($user1results as $user1result) {
    array_push($allIds, $user1result->user1_id);
  }
  foreach($user2results as $user2result) {
    array_push($allIds, $user2result->user2_id);
  }
  $collaborators = Database::getInstance()->query("SELECT `username`, `id` FROM users WHERE `id` IN (".implode(',', $allIds).")")->results();

  if ($currentUser->isLoggedIn()) {
    $isCollabQuery = Database::getInstance()->query("SELECT * FROM collaborators WHERE (`user1_id`=".escape($id)." AND `user2_id`=".$currentUser->id.") OR (`user1_id`=".$currentUser->id." AND `user2_id`=".escape($id).")");
    if ($isCollabQuery->count() > 0) {
      $isCollaborator = true;
    } else {
      $isCollaborator = false;
    }

    $isFollowQuery = Database::getInstance()->query("SELECT * FROM followers WHERE `user_id`=".escape($id)." AND `follower_id`=".$currentUser->id);

    if ($isFollowQuery->count() > 0) {
      $isFollower = true;
    } else {
      $isFollower = false;
    }
  } else {
    $isCollaborator = false;
    $isFollower = false;
  }
}


?>

<!DOCTYPE html>
<html>
  <head>
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="bootstrap/jquery/jquery-2.0.3.js"></script>
    <script src="js/follow.js"></script>
    <script src="js/collaborate.js"></script>
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
          <div class="col-xs-3" style="padding:0em;">
            <img src=<?php echo '"profileImages/'.$user->picture.'"'; ?> alt="profile picture" width="200" height="150">
          </div>
          <div class="col-xs-9">
            <h3 style="margin: 0em;"> <?php echo $user->username ?>'s Profile </h3>
            <h4 style="margin: 0em;"> <small> <?php echo count($tracks); ?> tracks </small> </h4>
            <h4 style="margin: 0em;"> <small> <?php echo count($followers); ?> followers </small> </h4>
            <div style="margin-top: 3.929em; text-align: right">
              <?php if ($currentUser->isLoggedIn()) { 
                      if($isFollower) { ?>
                        <button id="follow" value="" class="btn btn-default btn-sm" disabled> FOLLOWING </button>
              <?php   } else { ?>
                        <button id="follow" value=<?php echo '"'.$id.'"';?> class="btn btn-default btn-sm"> FOLLOW </button>
              <?php   }
                    } else { ?>
                  <button id="collaborate" class="btn btn-default btn-sm" data-toggle="modal" data-target="#loginModal"> FOLLOW </button>
              <?php } ?>
              <?php if ($currentUser->isLoggedIn()) { 
                      if($isCollaborator) { ?>
                        <button id="collaborate" value="" class="btn btn-default btn-sm" disabled> COLLABORATOR </button>
              <?php   } else { ?>
                        <button id="collaborate" value=<?php echo '"'.$id.'"'; ?> class="btn btn-default btn-sm"> COLLABORATE </button>
              <?php   } 
                    } else { ?>
                  <button id="collaborate" class="btn btn-default btn-sm" data-toggle="modal" data-target="#loginModal"> COLLABORATE </button>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
              <li class="active"><a href="#tracks" data-toggle="tab">TRACKS</a></li>
              <li><a href="#replies" data-toggle="tab">REPLIES</a></li>
          </ul>
        </div>
        <div class="tab-content">
          <div class="tab-pane fade in active" id="tracks">
            <div class="col-xs-12">
              <?php 
                foreach($tracks as $track) {
                  $track->displayForProfile();
                }
              ?>
            </div>
          </div>
          <div class="tab-pane fade" id="replies">
            <div class="col-xs-12">
              <?php
                foreach($replies as $reply) {
                  $reply->displayForProfile();
                }
              ?>
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
                <a href="" data-toggle="modal" data-target="#bioModal"></a>
              </div>
            </div>
            <div class="row">
              <p id="userBio">
                <?php echo $user->bio ?>
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
              <?php 
				if (count($followers) > 0) {
					foreach($followers as $follower) {
					  echo '<a href="profile.php?id='.$follower->id.'">';
					  echo $follower->username;
					  echo '</a><br>';
					}
				} else {
					//Maybe message? Would need to occur on dashboard as well
					//echo "No Followers";
				}
				
              ?>
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
              <?php 
                foreach($follows as $follow) {
                  echo '<a href="profile.php?id='.$follow->id.'">';
                  echo $follow->username;
                  echo '</a><br>';
                }
              ?>
            </div>
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
                  <?php 
                    foreach($followers as $follower) {
                      echo '<a href="profile.php?id='.$follower->id.'">';
                      echo $follower->username;
                      echo '</a><br>';
                    }
                  ?>
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
                  <?php 
                    foreach($follows as $follow) {
                      echo '<a href="profile.php?id='.$follow->id.'">';
                      echo $follow->username;
                      echo '</a><br>';
                    }
                  ?>
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
                  <a href="login.php"><button type="button" class="btn btn-default btn-sm"> Login </button></a>
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