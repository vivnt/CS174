<?php include('server.php') ?>

<!doctype html>
<html lang="en">

<body>
  <!-- Author: Vivian Tran -->
  <!--  TODO: Need to add in PNG file and file check -->
  <?php

  session_start();

  if (isset($_SESSION['username']))
  {
    $username = $_SESSION['username'];

    // POST function to insert data into the DB
    if (isset($_POST['category']) ) {
      $author = $username;
      $category = $_POST['category'];
      $file = $_FILES["image"]["tmp_name"];
      $size = filesize($file);
      $temp = explode(".", $_FILES["image"]["name"]);
      $extension = end($temp);
      //$imagecontent = file_get_contents($file);

      // Converts to KB and rounded to two sig figs
      $imagesize =  round($size / 1048, 1, PHP_ROUND_HALF_UP);

      // Converts file to image type then calculates width and height
      $image = imagecreatefromjpeg($file);
      $imagewidth = imagesx($image);
      $imageheight = imagesy($image);

      // Creates query to send to DB
      $result = $conn->query("INSERT into images (author, category, width, height, size, fileName) VALUES ('$username', '$category', '$imagewidth', '$imageheight', '$imagesize', '$extension')");
      $last_id = mysqli_insert_id($conn);
      $fileName = $username . "_" . $last_id . "." . $extension ;

      // Kevin Smith
      // Get filename that the user selected
      //
      $name = $username . "_" . $last_id . "_" . $_FILES['image']['name'] ;

      // Moves file to server with username_imageID_filename.filetype
      // This is to prevent conflicts and images not adding to the server.
      //
      move_uploaded_file($_FILES['image']['tmp_name'], "images/$fileName");

      if (!$result) {
        echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
      }
    }
  }
  else {
    // Redirects to login if the user is not logg
    header("Location: http://192.168.64.2/login.php");
    exit();
  }

  ?>
  <?php
  echo file_get_contents("navigation.html");
  ?>
  <div class="container" style="padding: 15px;">
    <h1 style="text-align: center;">Upload</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label>Genre</label>
        <select class="form-control" name="category">
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
