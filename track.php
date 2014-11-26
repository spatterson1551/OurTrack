<?php

require_once('core/init.php');

$id = $_GET['id'];

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
  <link href="raty-2.7.0/lib/jquery.raty.css" rel="stylesheet">
  <title>OurTrack</title>
</head>
<body>
  <!--************* begin header ****************-->
	<?php include 'includes/header.php' ?>
  <!--************* end header ****************-->
	
  <!--************* begin content area ****************-->
  <?php 
  		$track = Database::getInstance()->fetchToClass("SELECT * FROM tracks WHERE `id`='".escape($id)."'", "Track");

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
						<div class="col-xs-4 dropDownSort">
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
							<div class="form-group col-xs-8">
								<select id="sortDropDown" class="form-control">
									<option value="top">Top Rated</option>
									<option value="new">New</option>
								</select>
							</div>
						</div>
					</div>
					<!--START REPLY -->
						<div class="col-xs-12 trackReply">
							<div class="row">
								<div class="col-xs-2 col-xs-offset-1 trackThumb">
									<img src="images/ajeif45s843l.jpg" width="120" height="120"  alt="Track Thumb"/>
								</div>
								<div class="col-xs-8">
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
											<button type="button" class="btn btn-default right likeReply" value="1">Like</button>
										</div>
									</div>
									<div class="row tagSection">
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
						<!--EndReply-->
						<!--START REPLY -->
						<div class="col-xs-12 trackReply">
							<div class="row">
								<div class="col-xs-2 col-xs-offset-1 trackThumb">
									<img src="images/ajeif45s843l.jpg" width="120" height="120"  alt="Track Thumb"/>
								</div>
								<div class="col-xs-8">
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
											<button type="button" class="btn btn-default right likeReply" value="2">Like</button>
										</div>
									</div>
									<div class="row tagSection">
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
						<!--EndReply-->
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