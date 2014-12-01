<?php

require_once('core/init.php');

  //get id of track in URL
  if (Input::exists('get')) {
    $trackid = Input::get('id');
    //get info about track user is commenting on (need its title)
    $track = Database::getInstance()->fetchToClass("SELECT * FROM tracks WHERE `id`='".escape($trackid)."'", "Track");
    //note: $track is an array with one value, so always use $track[0]
    if (count($track) == 0) {
      Redirect::to(404);
    }

    //validating the uploaded form data
    if (Input::exists('post')) {
       $validate = new Validate();
       $tempvalidation = $validate->check($_POST, array(
          'title'  => array(
            'required' => true,
            'min' => 1,
            'max' => 100 //probably change this
            ),
          'description'     => array(
            'min' => 0,
            'max' => 200 
            )
          )
      );
       $validation = $tempvalidation->validateFiles(array(
          'file1' => array(
            'trackvalidation' => null
            ),
          'file2' => array(
            'imagevalidation' => null
            )
        ));

      if ($validation->passed()) {
        //create a new reply and add to database, add tags to tag table, 
        //create tagmap in tagmap table

        //gets the tags the user specified for this reply
        $tags = explode(",", Input::get('allTags'));

        //for ignoring the last tag since it will always be blank (due 
        //to extraneous comma at end of tag string in create.js)
        $numtags = count($tags);
        $count = 1;

        //go through all the tags and get their id's (to be used in tagmaps table)
        $tagids = array();
        foreach ($tags as $tag => $value) {
          if($count >= $numtags) {
            break; //ignore the last tag (it's blank)
          }
          //see if tag is already in tag table
          $query = Database::getInstance()->query("SELECT * FROM tags WHERE name='" . $value . "'");
          if(!$query->getCount()) //if not in tag table, add it
          {
            $temptag = new Tag();
            $temptag->create(array(
              'name' => $value
            ));
            //gets the id of tag just added
            $max = "MAX(id)";
            $var = Database::getInstance()->query("SELECT " . $max . " FROM tags");
            $result = array();
            foreach ($var->getResults() as $key => $value) {
                $result[] = $value->$max;
            }
            $tagids[] = $result[0];
          }
          else { 
            //gets the id of the matching tag -- to be used in tagmaps table
            foreach ($query->getResults() as $key => $value) {
              foreach ($value as $k => $v) {
                $tagids[] = $v;
                break; //we only want the first field (id), not the second (name)
              }
            }
          }
          $count++;
        }

        $reply = new Reply();
        //gets currently-logged-in user
        $user = new User();
        $reply->create(array( //adds reply to reply table
            'track_id'          => $trackid,
            'owner_id'          => $user->id,
            'picture'           => $validation->getImageLocation(),
            'source'            => $validation->getAudioLocation(),
            'title'             => Input::get('title'),
            'description'       => Input::get('description'),
            'genre'             => Input::get('category'),
            'likes'            => 0,
          ));

        //gets the id of the reply just added to table
        $max = "MAX(id)";
        $var = Database::getInstance()->query("SELECT " . $max . " FROM replies");
        $result = array();
        foreach ($var->getResults() as $key => $value) {
            $result[] = $value->$max;
        }

        //update tagmap table (maps tags to tracks or replies, depending on type)
        $tagmap = new Tagmap();
        foreach ($tagids as $tag => $id) {
          $tagmap->create(array(
          'track_id' => $result[0],
          'tag_id'   => $id,
          'type'     => 'reply'
        ));
        }
        
        //Take to the track page for track replied to
        Redirect::to('track.php?id='. $trackid);

        $errors = false;
      } else {
        $errors = true;
      }
    } else {
      $errors = false;
    }
  } else {
    //input does not exist
    Redirect::to(404);
  }

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
    <?php 
      if ($errors) {
        echo '<div style="color:#CC0000">';
        foreach($validation->errors() as $error) {
          echo $error.'<br>';
        }
        echo '</div>';
      }
    ?>
    <div class="row">
      <div class="col-xs-12">
        <h2> Post a Reply to <?php echo $track[0]->title; ?></h2>
        <form id="createForm" action="#" method="POST" enctype="multipart/form-data" role="form" class="form-group" style="margin-bottom: 100px;">
          <div class="form-group">
            <input id="title" name="title" type="text" class="form-control" placeholder="Reply Title..." style="margin-bottom: 10px;">
          </div>
          <div class="form-group">
            <textarea id="description" name="description" class="form-control" rows="3" placeholder="Reply Description..." style="margin-bottom: 10px;"></textarea>
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