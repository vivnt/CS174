<?php include 'server.php'?>

<html lang="en">
<head>
<link rel="stylesheet" type="text/css" media="screen" href="style.css" />

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
  <?php echo file_get_contents("navigation.html") ?>
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
for ($j = 0; $j < 3; ++$j) {

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
  <!-- Welcome Message Jumbotron -->
  <!-- Author: Raghav Gupta -->
  <div class="container-fluid jumbotron">
    <div style="text-align: center">
        <h1 class="display-4">Hi!</h1>
        <p>Welcome to the image hosting and sharing website! Please checkout the "Discover" section to see all the latest purchases of our users</p>
    </div>
  </div>

  <!-- Slide Show -->
  <!-- Author: Raghav Gupta -->
  <div class="container">
  <div id="slides" class="carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
      <li data-target="#slides" data-slide-to="0" class="active"></li>
      <li data-target="#slides" data-slide-to="1"></li>
      <li data-target="#slides" data-slide-to="2"></li>
    </ul>

    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="<?php echo $fileNames[0] ?>">
        <div class="carousel-caption" style="margin-top: 15vh">
          <h1>Author: <?php echo $authors[0] ?></h1>
          <p>Category: <?php echo $categories[0] ?></p>
          <a class="btn btn-outline-light" href="imageDetail.php/?id=<?php echo $ids[1] ?>" role="button">View Image</a>
        </div>
      </div>
      <div class="carousel-item">
        <img src="<?php echo $fileNames[1] ?>">
        <div class="carousel-caption"  style="margin-top: 15vh">
          <h1>Author: <?php echo $authors[1] ?></h1>
          <p>Category: <?php echo $categories[1] ?></p>
          <a class="btn btn-outline-light" href="imageDetail.php/?id=<?php echo $ids[2] ?>" role="button">View Image</a>
        </div>
      </div>
      <div class="carousel-item">
        <img src="<?php echo $fileNames[2] ?>">
        <div class="carousel-caption"  style="margin-top: 15vh">
          <h1>Author: <?php echo $authors[2] ?></h1>
          <p>Category: <?php echo $categories[2] ?></p>
          <a class="btn btn-outline-light" href="imageDetail.php/?id=<?php echo $ids[3] ?>" role="button">View Image</a>
        </div>
      </div>

    </div>
  </div>
</div>

  <!-- Footer -->
  <!-- Author: Raghav Gupta -->
  <div class="jumbotron text-center" style="margin-bottom:0">
    <p>Created with love for CS 174</p>
  </div>
</body>
</html>
