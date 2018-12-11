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
    </ul>
  </div>

</nav>
    <h1>Query</h1>
    <div>
        <form action="#" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label>Search By:</label>
          <select class="form-control" name="searchType">
            <option>Image ID</option>
            <option>Customer ID</option>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">ID</label>
          <input type="number" class="form-control" name="searchId" value="searchId" placeholder="ID">
        </div>
      <button type="submit" name="search" value="search" class="btn btn-primary">Search</button><br />
      </form>
    </div>
    <?php
    // Shows all information in image table
    if (isset($_POST['searchId']) && isset($_POST['search']) && isset($_POST['searchType']))  {
    $searchId = $_POST['searchId'];
    $searchType = $_POST['searchType'];

    if ($searchType = "Image ID") {
      $query = "SELECT * FROM transaction WHERE imageId = '$searchId'";
      $result = $conn->query($query);

      if (!$result) {
          die($conn->error);
      }

      $rows = $result->num_rows;

      // Parses through the table array
      for ($j = 0 ; $j < $rows ; ++$j) {
          $result->data_seek($j);
          echo 'Customer ID: ' . $result->fetch_assoc()['customerId'] . '<br>';
      }
    }

    if ($searchType = "Customer ID") {
      $query = "SELECT * FROM transaction WHERE customerId = '$searchId'";
      $result = $conn->query($query);

      if (!$result) {
          die($conn->error);
      }

      $rows = $result->num_rows;

      // Parses through the table array
      for ($j = 0 ; $j < $rows ; ++$j) {
          $result->data_seek($j);
          echo 'Image ID: ' . $result->fetch_assoc()['imageId'] . '<br>';
      }
    }
  }


    ?>
  </body>
</html>
