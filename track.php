<?php

require_once('core/init.php');

if (Input::exists('get')) {
	$id = Input::get('id');
}

$user = new User();

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="bootstrap/jquery/jquery-2.0.3.js"></script>
  <script src="js/likeTrack.js"></script>
  <script src="js/likeReply.js"></script>
  <script src="js/changeSortMethod.js"></script>
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
  		$track = Database::getInstance()->fetchToClass("SELECT * FROM tracks WHERE `id`='".escape($id)."'", "Track");
  		$replies = Database::getInstance()->fetchToClass("SELECT * FROM replies WHERE `track_id`='".escape($id)."'", "Reply");
  		
  		$sort = new Sort($replies);
  		$replies = $sort->sortByLikes();

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
									<option value="top">Top Rated</option>
									<option value="new">New</option>
								</select>
							</div>
							<div class="col-xs-2 col-xs-offset-8">
								<?php if ($user->isLoggedIn()) { ?>
									<a href=<?php echo '"reply.php?id='.$id.'"'?><button type="button" class="btn btn-primary">Post Reply</button></a>
								<?php } else { ?>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Post Reply</button>
								<?php } ?>
							</div>
						</div>
					</div>
					<!--START REPLY -->
						<?php 

						foreach($replies as $r)
						{
							echo $r->displayMini();
						}

						 ?>
					<!--EndReply-->
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