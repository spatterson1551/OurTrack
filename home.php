<?php

require_once('core/init.php');

if (Input::exists('get')) {
  $genre = Input::get('genre');

  if (in_array($genre, $GLOBALS['config']['genres'])) {
    //good genre value, so retrieve its stuff from the database.
    $tracks = Database::getInstance()->fetchToClass("SELECT * FROM tracks WHERE `genre`='".escape($genre)."'", "Track");
  } else if ($genre === 'all' || $genre === 'All') {
    $tracks = Database::getInstance()->fetchToClass("SELECT * FROM tracks", "Track");
  } else {
    Redirect::to(404);
  }
} else {
  $tracks = Database::getInstance()->fetchToClass("SELECT * FROM tracks", "Track");
}

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
          <div id="categorySelected" class="categoryListItem">All</div>
          <?php 
            foreach ($GLOBALS['config']['genres'] as $genre) {
              echo '<div class="categoryListItem">';
              echo $genre;
              echo '</div>';
            }
          ?>
        </div>
      </div>
      <div class="col-xs-9">
        <div class="row">
          <div class="col-xs-4 col-xs-offset-8">
            <div class="inline-form">
              <label class="control-label col-xs-4" for="sortDropDown" style="text-align: right; padding-top: 5px;">Sort By:</label>
              <div class="form-group col-xs-8">
                <select id="sortDropDown" class="form-control">
                  <option value="new">New</option>
                  <option value="top">Top Rated</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      <!-- start tracks here -->
      <div id="trackSection">
       <?php
        foreach($tracks as $track) {
          $track->displayMini();
        }
       ?>
      </div>
      <!-- end tracks here -->
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