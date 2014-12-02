<?php
require_once('core/init.php');

  if (Input::exists('post')) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
      'email'  => array('required' => true),
      'password'  => array('required' => true)
      )
    );

    if ($validation->passed()) {
      //create a user account, and redirect them

      $user = new User();
      $login = $user->login(Input::get('email'), Input::get('password'), true);

      if ($login) {
        //successful login, session is set
        $errors = false;
        Redirect::to('dashboard.php');
      } else {
        $errors = true;
        $validation = new Validate();
        $validation->addError('the email and password combination is not correct'); 
      }
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
	<?php include 'includes/header.php' ?>
  <!--************* end header ****************-->
	
  <!--************* begin content area ****************-->
  <div class="container" style="margin-top: 60px;">
    <div class="row">
      <div class="col-xs-7">
        <h2> Welcome Back! </h2>
        <p>
          Thanks for being a part of our community. You can check remember me to login automatically next time.
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
        <h2> Login Below</h2>
        <form action="login.php" method="POST" role="form" class="form-group">
    			<div class="form-group">
    				<input type="email" id="email" name="email" class="form-control" placeholder="email@domain.com" style="margin-bottom: 10px;">
    			</div>
    			<div class="form-group">
    				<input type="password" id="pass" name="password" class="form-control" placeholder="Password" style="margin-bottom: 10px;">
          </div>
  			  <!--<div class="col-xs-12">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember"> Remember Me
              </label>
            </div>
          </div>-->
          <div class="form-group">
           <input type="submit" id="submit" class="btn btn-large btn-success btn-block" value="Log In" style="margin-bottom: 10px;">
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--************* end content area ****************-->


  <!-- This is here at the bottom so that we can load parts of the page before we load the js file, which makes the website run a little faster -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="js/signinValidation.js"></script>


  <!--************* begin footer ****************-->
	<?php include 'includes/footer.php' ?>
	<!--************* end footer ****************-->
</body>
</html>