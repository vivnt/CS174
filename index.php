<?php include('server.php') ?>

<html lang="en">

<body>
  <?php echo file_get_contents("navigation.html")?>
  <?php
  $fileNames = [];
  $authors = [];
  $categories = [];
  $ids = [];

  $query = "SELECT * FROM images ORDER BY popularity DESC LIMIT 10";
  $result = $conn->query($query);

  if (!$result) {
    die($conn->error);
  }

  $rows = $result->num_rows;

  // Parses through the table array
  // NOTE TO RAG: Use this to make your profile area. If you need help, let me know.
  for ($j = 0 ; $j < 3 ; ++$j) {

    $result->data_seek($j);
    $authors[$j] = $result->fetch_assoc()['author'];
    $author = $result->fetch_assoc()['author'];

    $result->data_seek($j);
    $categories[$j] = $result->fetch_assoc()['category'];

    $result->data_seek($j);
    $ids[$j] = $result->fetch_assoc()['id'];
    $id = $result->fetch_assoc()['id'];

    $fileNames[$j] = "images/" . $author . "_" . $id . ".png";
  }
  ?>
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
        <img width="1350" src="<?php echo $fileNames[0] ?>">
        <div class="carousel-caption d-none d-md-block">
          <h1>Author: <?php echo $authors[0] ?></h1>
          <p>Category: <?php echo $categories[0] ?></p>
          <a class="btn btn-outline-light" href="imageDetail.php/?id=<?php echo $ids[0] ?>" role="button">View Image</a>
        </div>
      </div>
      <div class="carousel-item">
        <img width="1350" src="<?php echo $fileNames[1] ?>">
        <div class="carousel-caption d-none d-md-block">
          <h1>Author: <?php echo $authors[1] ?></h1>
          <p>Category: <?php echo $categories[1] ?></p>
          <a class="btn btn-outline-light" href="imageDetail.php/?id=<?php echo $ids[1] ?>" role="button">View Image</a>
        </div>
      </div>
      <div class="carousel-item">
        <img width="1350" src="<?php echo $fileNames[2] ?>">
        <div class="carousel-caption d-none d-md-block">
          <h1>Author: <?php echo $authors[2] ?></h1>
          <p>Category: <?php echo $categories[2] ?></p>
          <a class="btn btn-outline-light" href="imageDetail.php/?id=<?php echo $ids[2] ?>" role="button">View Image</a>
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
