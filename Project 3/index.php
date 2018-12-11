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
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="upload.php">Upload</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="signup.php">Sign Up</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="search.php">Search</a>
      </li>
    </ul>
  </div>
</nav>
    <h1>Query</h1>
    <?php

    // Sends POST for DELETE Query
    if (isset($_POST['id']) && isset($_POST['delete'])) {
      $id = $_POST['id'];
      // $result = $conn->query("DELETE FROM images WHERE id = '$id'");
      echo "Deleted";
      // if (!$result) {
      //     echo "DELETE failed: $query<br>" . $conn->error . "<br><br>";
      // }

    }

    // TODO: Needs customerId & date
    if (isset($_POST['id']) && isset($_POST['purchase'])) {
      $imageId = $_POST['id'];
      // $customerId = $_POST['customerId'];
      $customerId = 3;
      $date = "12/02/2018";
      // INSERT transaction but need customerId
      $result = $conn->query("INSERT into transaction (customerId, imageId, date) VALUES ('$customerId', '$imageId', '$date')");

      // DELETE Transaction
      // $result = $conn->query("INSERT into transaction (customerId, imageId) VALUES ('$customerId', '$imageId')");
      echo "Purchased";

      if (!$result) {
          echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
      }

    }

    // Shows all information in image table
    $query = "SELECT * FROM images";
    $result = $conn->query($query);

    if (!$result) {
        die($conn->error);
    }

    $rows = $result->num_rows;

    // Parses through the table array
    for ($j = 0 ; $j < $rows ; ++$j) {
        $result->data_seek($j);
        echo 'Author: ' . $result->fetch_assoc()['author'] . '<br>';

        $result->data_seek($j);
        echo 'Genre: ' . $result->fetch_assoc()['genre'] . '<br>';

        $result->data_seek($j);
        echo 'Size: ' . $result->fetch_assoc()['size'] . 'KB <br>';

        $result->data_seek($j);
        echo 'Width: ' . $result->fetch_assoc()['width'] . '<br>';

        $result->data_seek($j);
        echo 'Height: ' . $result->fetch_assoc()['height'] . '<br>';

        $result->data_seek($j);
        $id = $result->fetch_assoc()['id'];
        echo 'ID: ' . $id . '<br>';

        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='id' value='$id'>";
        echo '<button type="submit" name="delete" value="delete" class="btn btn-primary">Delete</button><br /><br/>';
        echo '<button type="submit" name="purchase"  value="purchase" class="btn btn-primary">Purchase</button><br /><br/>';
        echo '</form>';
    }

    $result->close();
    $conn->close();

    // $query = "DELETE FROM cats WHERE name='Growler'";
    // $result = $conn->query($query);
    // if (!$result)
    //   die ("Database access failed: " . $conn->error);
    ?>
  </body>
</html>
