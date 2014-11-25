<?php

require_once('core/init.php');



?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="bootstrap/jquery/jquery-2.0.3.js"></script>
  <script src="js/createTrack.js"></script>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="css/mainLayout.css" rel="stylesheet">
  <link href="css/create.css" rel="stylesheet">
  <title>OurTrack</title>
</head>
<body>
  <!--************* begin header ****************-->
	<?php include 'includes/header.php' ?>
  <!--************* end header ****************-->
	
  <!--************* begin content area ****************-->
  <div class="container" style="margin-top:60px;">
    <div class="row">
      <div class="col-xs-12">
        <h2> Post a Track </h2>
        <form id="createForm" action="#" method="POST" role="form" class="form-group" style="margin-bottom: 100px;">
          <div class="form-group">
            <input id="title" type="text" class="form-control" placeholder="Track Title..." style="margin-bottom: 10px;">
          </div>
          <div class="form-group">
            <textarea id="description" class="form-control" rows="3" placeholder="Track Description..." style="margin-bottom: 10px;"></textarea>
          </div>
          <div class="form-group">
            <label class="control-label" for="category">Category:</label>
            <select id="category" class="form-control" style="margin-bottom: 10px;">
              <option>Select A Category</option>
              <option>Alternative</option>
              <option>Blues</option>
              <option>Classical</option>
              <option>Country</option>
              <option>Disco</option>
              <option>Drum and Bass</option>
              <option>Dubstep</option>
              <option>Electronic</option>
              <option>Folk</option>
              <option>Hardcore</option>
              <option>Hip Hop</option>
              <option>House</option>
              <option>Indie</option>
              <option>Jazz</option>
              <option>Latin</option>
              <option>Metal</option>
              <option>Minimal</option>
              <option>Other</option>
              <option>Piano</option>
              <option>Pop</option>
              <option>Progressive</option>
              <option>Punk</option>
              <option>R and B</option>
              <option>Rap</option>
              <option>Reggae</option>
              <option>Rock</option>
              <option>Soul</option>
              <option>Techno</option>
              <option>Trap</option>
              <option>World</option>
            </select> 
          </div>
          <div class="form-group">
            <label class="control-label" for="tags">Input a tag and hit enter to add it</label>
            <div id="tagSection"></div>
            <input type="text" id="tags" class="form-control" placeholder="Enter a Tag" style="margin-bottom: 10px">
            <!--<div id="tags" class="form-control" contenteditable="true"></div>-->
          </div>
          <div class="form-group">
              <label class="control-label"> Select the track you wish to upload: </label>
          </div>
          <div class="form-group">
            <div class="fileSelector" id="audioSelector">
              <span id="audioText">Click anywhere to select a file</span>
                <input id="trackuploadbutton" class="btn btn-primary" type="button" value="Upload">
              <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
              <span id="audioGlyph" class="dummy"></span>
              <span id="audioCancelGlyph" class="glyphicon glyphicon-remove"></span>
              <span id="status"></span>
            </div>
            <input type="file" name="file1" id="trackupload" class="upload">
          </div>
          <div class="form-group">
              <label class="control-label"> Select the image to associate with the track: </label>
          </div>
          <div class="form-group">
            <div class="fileSelector" id="imageSelector">
              <span id="imageText">Click anywhere to select a file</span>
                <input id="imageUploadButton" class="btn btn-primary" type="button" value="Upload">
              <progress id="imageProgressBar" value="0" max="100" style="width:300px;"></progress>
              <span id="imageGlyph" class="dummy"></span>
              <span id="imageCancelGlyph" class="glyphicon glyphicon-remove"></span>
              <span id="imageStatus"></span>
            </div>
            <input type="file" name="file2" id="imageupload" class="upload">
          </div>
          <div class="form-group">
            <div class="col-xs-12">
              <div class="checkbox">
                <label>
                  <input id="collaborators" type="checkbox" value="remember"> Show Collaborators Only
                </label>
              </div>
            </div>
          </div>
          <br>
          <div class="form-group">
            <input id="submit" type="submit" class="btn btn-large btn-success btn-block" value="Create" style="margin-bottom: 10px;">
          </div>
        </form>
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