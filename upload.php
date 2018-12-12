<?php include('server.php'); include('imageComp.php') ?>

<!doctype html>
<html lang="en">

<body>
  <!-- Author: Vivian Tran -->
  <!--  TODO: Need to add in PNG file and file check -->
  <?php
  echo file_get_contents("navigation.html");
  ?>
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
      if (exif_imagetype($file) == IMAGETYPE_JPEG) {
        $image = imagecreatefromjpeg($file);
      } else {
        $image = imagecreatefrompng($file);
      }
      $imagewidth = imagesx($image);
      $imageheight = imagesy($image);

      // Creates query to send to DB
      $result = $conn->query("INSERT into images (author, category, width, height, size, popularity) VALUES ('$username', '$category', '$imagewidth', '$imageheight', '$imagesize', '0')");
      $last_id = mysqli_insert_id($conn);
      $fileName = $username . "_" . $last_id . ".png" ;
      $file = $username . "_" . $last_id ;

      // Kevin Smith
      // Get filename that the user selected
      //
      $name = $username . "_" . $last_id . "_" . $_FILES['image']['name'] ;

      // Moves file to server with username_imageID_filename.filetype
      // This is to prevent conflicts and images not adding to the server.
      //
      move_uploaded_file($_FILES['image']['tmp_name'], "originals/$fileName");
      imagepng($image, "originals/$fileName");

      // Watermarking
      $background = new Image("originals/$fileName");
      $foreground = new Image('watermark.png');

      // Will convert mountains to gray scale using averaging method
      // $background->convertImageToGrayScale('testExport.jpg','average');

      // Will add birds to the mountain background
      $background->comp($foreground, 0, 0,"images/$file.png");

      // // Moves watermarked image to a different folder
      // $image = imagecreatefromjpeg("originals/$fileName");
      // imagejpeg($image, "images/$fileName");

      $update = $conn->query("UPDATE user SET credits = credits + 100 WHERE username = '$username'");

      if (!$result || !$update) {
        echo "INSERT/UPDATE failed: $result<br>" . $conn->error . "<br><br>";
        echo "INSERT/UPDATE failed: $update<br>" . $conn->error . "<br><br>";
      }

      echo '<div class="alert alert-success text-center container" role="alert">
      Image has been uploaded
      </div>';

    }
  }
  else {
    // Redirects to login if the user is not logged in
    header("Location: http://192.168.64.2/login.php");
    exit();
  }

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
