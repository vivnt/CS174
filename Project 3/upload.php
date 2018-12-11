<?php include('server.php') ?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item ">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="upload.php">Upload</a>
        </li>
      </ul>
    </div>
  </nav>

<?php

require_once 'login.php';

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die($conn->connect_error);
}
  // POST function to insert data into the DB
  if (isset($_POST['author']) && isset($_POST['genre'])) {
      $author = $_POST['author'];
      $genre = $_POST['genre'];
      $file = $_FILES["image"]["tmp_name"];
      $size = filesize($file);
      //$imagecontent = file_get_contents($file);

      // Converts to KB and rounded to two sig figs
      $imagesize =  round($size / 1048, 1, PHP_ROUND_HALF_UP);

      // Converts file to image type then calculates width and height
      $image = imagecreatefromjpeg($file);
      $imagewidth = imagesx($image);
      $imageheight = imagesy($image);

      // Creates query to send to DB
      $result = $conn->query("INSERT into images (author, genre, width, height, size) VALUES ('$author', '$genre', '$imagewidth', '$imageheight', '$imagesize')");

      if (!$result) {
          echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
      }

      echo $author . "<br />";
      echo $genre . "<br />";
      echo $imagewidth . "<br />";
      echo $imageheight . "<br />";
      echo $imagesize . "<br />";
  }

?>
  <div class="container" style="padding: 15px;">
    <h1 style="text-align: center;">Upload</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label>Author/Source</label>
        <input type="text" class="form-control" name="author" placeholder="Enter Your Name">
      </div>
      <div class="form-group">
        <label>Genre</label>
        <select class="form-control" name="genre">
          <option>General</option>
          <option>Nature</option>
          <option>Macro</option>
          <option>Portrait</option>
          <option>Sports</option>
          <option>Architecture</option>
          <option>Other</option>
        </select>
      </div>
      <div class="form-group">
        <label>Image Upload</label>
        <input type="file" class="form-control-file" name="image" id="image">
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</body>
</html>
