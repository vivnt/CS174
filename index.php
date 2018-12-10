<?php include('server.php') ?>

<html lang="en">

<body>
  <?php echo file_get_contents("navigation.html")?>
  <!-- Slide Show -->
  <!-- Author: Raghav Gupta -->
  <div id="slides" class="carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
      <li data-target="#slides" data-slide-to="0" class="active"></li>
      <li data-target="#slides" data-slide-to="1"></li>
      <li data-target="#slides" data-slide-to="2"></li>
    </ul>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <!-- Need to edit this to show images from the database -->
        <img src="images/bg.jpg">
        <div class="carousel-caption">
          <h1 class="display-4"> Image 1</h1>
          <button type="button" class="btn btn-outline-light btn-lg"> View Image</button>
        </div>
      </div>
      <div class="carousel-item">
        <!-- Need to edit this to show images from the database -->
        <img src="/images/img1.jpg">
        <div class="carousel-caption">
          <h1 class="display-4"> Image 2</h1>
          <button type="button" class="btn btn-outline-light btn-lg"> View Image</button>
        </div>
      </div>
      <div class="carousel-item">
        <!-- Need to edit this to show images from the database -->
        <img src="/images/img2.jpg">
        <div class="carousel-caption">
          <h1 class="display-4"> Image 3</h1>
          <button type="button" class="btn btn-outline-light btn-lg"> View Image</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Welcome Message Jumbotron -->
  <!-- Author: Raghav Gupta -->
  <div class="container-fluid">
    <div class="row welcome text-center">
      <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10">
        <h1 class="display-4">Hi!</h1>
        <p class="lead" style="text-align:center">Welcome to the image hosting and sharing website! Please checkout the "Discover section to see all the latest from our contributors</p>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <!-- Author: Raghav Gupta -->
  <div class="jumbotron text-center" style="margin-bottom:0">
    <p>Footer</p>
  </div>
</body>
</html>
