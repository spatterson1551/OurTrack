<?php

require_once('core/init.php');

  if (Input::exists('post')) {
     $validate = new Validate();
     $validation = $validate->check($_POST, array(
        'username'  => array(
          'required' => true,
          'min' => 3,
          'max' => 30
          ),
        'email'     => array(
          'required' => true,
          'email' => true,
          'unique' => 'users'
          ),
        'password' => array(
          'required' => true,
          'min' => 8,
          'max' => 15
          ),
        'secondpass' => array(
          'matches' => 'password'
          )
        )
    );

    if ($validation->passed()) {
      //create a user account, and redirect them
      $salt = Hash::salt(32);
      
      $user = new User();
      $user->create(array(
          'email'       => Input::get('email'),
          'username'    => Input::get('username'),
          'password'    => Hash::make(Input::get('password'), $salt),
          'salt'        => $salt,
          'bio'         => '',
          'picture'     => 'default.png',
          'url'         => ''
      ));
      
      Redirect::to('dashboard.php');
      $errors = false;
    } else {
      $errors = true;
    }
  } else {
    $errors = false;
  }

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
  <?php include 'includes/header.php'; ?>
  <!--************* end header ****************-->

	
  <!--************* begin content area ****************-->
  <div class="container" style="margin-top: 60px;">
    <div class="row">
      <div class="col-xs-7">
        <h2> Welcome to OurTrack. Sign up to be a part of our community! </h2>
        <p>
          OurTrack is a place to market your music and get feedback, new perspectives, and gain invaluable help towards creating a finished musical
          project with the help of other talented musicians and recording artists in the community. In order to reap the full benefits of our website
          please take a few moments to register.
        </p>
      </div>
      <div class="col-xs-4 col-xs-offset-1">
        <?php 
        if ($errors) {
          echo '<div style="color:#CC0000">';
          foreach($validation->errors() as $error) {
            echo $error.'<br>';
          }
          echo '</div>';
        }
        ?>
        <h2> Sign Up. It's Easy!</h2>
        <form action="signup.php" method="post" role="form" class="form-group">
    			<div class="form-group">
    				<input type="text" class="form-control" id="username" name="username" placeholder="User Name" value="<?php echo escape(Input::get('username')); ?>" style="margin-bottom: 10px;">
    			</div>
    			<div class="form-group">
    				<input type="email" class="form-control" id="email" name="email" placeholder="email@domain.com" value="<?php echo escape(Input::get('email')); ?>" style="margin-bottom: 10px;">
    			</div>
    			<div class="form-group">
    				<input type="password" class="form-control" id="firstpass" name="password" placeholder="Password" style="margin-bottom: 10px;">
    			</div>
    			<div class="form-group">
    				<input type="password" class="form-control" id="secondpass" name="secondpass" placeholder="Confirm Password" style="margin-bottom: 10px;">
    			</div>
    			<div class="form-group">
    				<input type="submit" id="submit" class="btn btn-large btn-success btn-block" value="Sign Up" style="margin-bottom: 10px;">
			    </div>
        </form>
      </div>
    </div>
  </div>
  <!--************* end content area ****************-->


  <!-- This is here at the bottom so that we can load parts of the page before we load the js file, which makes the website run a little faster -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="js/signupValidation.js"></script>


  <!--************* begin footer ****************-->
	<?php include 'includes/footer.php' ?>
  <!--************* end footer ******************-->
</body>
</html>