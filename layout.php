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
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
        <a class="navbar-brand" href="home.html"><strong>OurTrack</strong></a>
      </div>

      <div class="collapse navbar-collapse" id="bs-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="about.html">About</a></li>   <!-- class = "active" to highlight -->
          <li><a href="create.html"> Create Track</a></li>
        </ul>
        <ul class="nav navbar-nav">
          <li><div id="spacer"></div></li>
        </ul>
        <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </form>
        <ul class="nav navbar-nav navbar-right">
           <li><a href="signup.html"> Sign Up </a></li>
           <li><a href="login.html"> Log In </a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!--************* end header ****************-->
	
  <!--************* begin content area ****************-->
  <!-- nothing here yet, but this is where all the stuff will go that is different for each page -->
  <!--************* end content area ****************-->


  <!-- This is here at the bottom so that we can load parts of the page before we load the js file, which makes the website run a little faster -->
	<script src="bootstrap/js/bootstrap.min.js"></script>


    <!--************* begin footer ****************-->
		<div id="footer">
			<div id="footerDiv" class="container-fluid">
				<div class="container">
					<div class="row">
					</div>
				</div>
			</div>
			
			<!-- begin copyright -->
			<div id="copyright" class="container-fluid">
				<p> Copyright &copy; 2014, OurTrack </p>
			</div>
			<!-- end copyright -->
		</div>
	<!--************* end footer ****************-->
</body>
</html>