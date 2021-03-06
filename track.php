<?php

require_once('core/init.php');

if (Input::exists('get')) {
	$id = Input::get('id');
	$track = Database::getInstance()->fetchToClass("SELECT * FROM tracks WHERE `id`='".escape($id)."'", "Track");
	if (count($track) == 0) {
		Redirect::to(404);
	}

	$user = new User();

	if (!$track[0]->userCanSeeTrack()) {
		Redirect::to('errors/private.php');
	}

	if ($user->isLoggedIn()) {
		if ($user->id == $track[0]->owner_id) {
			//user who owns the track is viewing it
			$ownerIsViewing = true;
		} else {
			$ownerIsViewing = false;
		}
	} else {
		$ownerIsViewing = false;
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="bootstrap/jquery/jquery-2.0.3.js"></script>
  <script src="js/likeTrack.js"></script>
  <script src="js/likeReply.js"></script>
  <script src="js/changeReplySort.js"></script>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="css/mainLayout.css" rel="stylesheet">
  <link href="css/trackLayout.css" rel="stylesheet">
  <title>OurTrack</title>
</head>
<body>
  <!--************* begin header ****************-->
	<?php include 'includes/header.php' ?>
  <!--************* end header ****************-->
	
  <!--************* begin content area ****************-->
  <?php 
  		
  		$replies = Database::getInstance()->fetchToClass("SELECT * FROM replies WHERE `track_id`='".escape($id)."' ORDER BY `created_at` DESC", "Reply");
  		
  		//$sort = new Sort($replies);
  		//$replies = $sort->sortByLikes();

  ?>
	<div class="container">
		<!--Top Track Start-->
			<?php echo $track[0]->displayFull(); ?>
		<!--Top Track End-->
		<div class="row" style="margin-top: 60px;">
			<div class="col-xs-9">
			<!--Nav Tabs-->
				<ul class="nav nav-tabs">
				  <li class="active"><a href="#replies" data-toggle="tab">Replies</a></li>
				</ul>
				<!--Tab Panes-->
				<div class="tab-content">
					<div class="tab-pane fade in active" id="replies">
					<div class="row">
						<div class="col-xs-12 dropDownSort">
							<!--<div class="dropdown">
								  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
								  	Top Rated
									<span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Top Rated</a></li>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#">New</a></li>
								  </ul>
							</div>-->
							<div class="form-group col-xs-2">
								<select id="sortDropDown" class="form-control">
									<option value="new">New</option>
									<option value="top">Top Rated</option>
								</select>
							</div>
							<div class="col-xs-2 col-xs-offset-8">
								<?php if ($user->isLoggedIn()) { ?>
									<a href=<?php echo '"reply.php?id='.$id.'"'?> class="btn btn-primary">Post Reply</a>
								<?php } else { ?>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Post Reply</button>
								<?php } ?>
							</div>
						</div>
					</div>
					<!--START REPLY -->
					<div id="replySection">
						<?php 

						foreach($replies as $r)
						{
							echo $r->displayMini($ownerIsViewing);
						}

						?>
					<!--EndReply-->
					</div>
					</div>
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
                  <a href="login.php" class="btn btn-default btn-sm"> Login </a>
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