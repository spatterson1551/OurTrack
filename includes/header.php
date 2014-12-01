<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
      <a class="navbar-brand" href="home.php"><strong>OurTrack</strong></a>
    </div>

    <div class="collapse navbar-collapse" id="bs-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="about.php">About</a></li>   <!-- class = "active" to highlight -->
        <li><a href="create.php"> Create Track</a></li>
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
        <?php 
          $headerUser = new User();
          if ($headerUser->isLoggedIn()) { ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" style="color:rgb(0, 210, 0);" data-toggle="dropdown">
                 <?php echo $headerUser->username; ?>
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php"}>Logout</a></li>
              </ul>
            </li>
          <?php } else { ?>
            <li><a href="signup.php"> Sign Up </a></li>
            <li><a href="login.php"> Log In </a></li>
          <?php } 
        ?>
      </ul>
    </div>
  </div>
</nav>

