<?php

require_once('core/init.php');


?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="bootstrap/jquery/jquery-2.0.3.js"></script>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="css/mainLayout.css" rel="stylesheet">
  <title>OurTrack</title>
</head>
<body>
  <!--************* begin header ****************-->
	<?php include 'includes/header.php' ?>
  <!--************* end header ****************-->
	
  <!--************* begin content area ****************-->
  <div class="jumbotron">
    <div class="container">
      <h1>Welcome to OurTrack</h1>
      <p>OurTrack is a place to market your music and get feedback, new perspectives, and gain invaluable help towards creating a finished musical
        project with the help of other talented musicians and recording artists in the community. Post unfinished projects to receive replies
        from other users, augmented with their own additions to the recording, or post finished tracks to recieve awesome remixes in no time
        at all</p>
      <p><a class="btn btn-primary btn-lg" role="button" href="signup.php">Get Started &raquo;</a></p>
    </div>
  </div>

  <div class="container">
    <!-- Example row of columns -->
    <div class="row">
      <div class="col-md-4">
        <h2>Follow users</h2>
        <p> Follow other users to keep up to date on the tracks and reples that they post. </p>
      </div>
      <div class="col-md-4">
        <h2>Tag Tracks</h2>
        <p>Tag tracks with any keywords that best describe your track. You can also search tracks by tag. </p>
     </div>
      <div class="col-md-4">
        <h2>Collaborators</h2>
        <p>Become a collaborator with another user in order to keep tracks private amongst those whose skills you admire</p>
      </div>
    </div>
  </div>
  <div class="container" style="margin-top: 100px;">
    <div class="row">
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