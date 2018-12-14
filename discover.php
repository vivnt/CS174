<?php include('server.php') ?>
<!DOCTYPE html>
<html lang ="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Discover</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>

  <!-- Navigation -->
  <!-- Author: Vivian Tran -->
  <?php echo file_get_contents("navigation.html")?>

  <!-- Search Bar -->
  <!-- Author: Raghav Gupta -->
  <div class="container-fluid search">
    <h1>Search Purchase Trends</h1>
    <form action="" autocomplete="off" method="post" enctype="multipart/form-data" accept-charset="utf-8">
      <div class="form-group">
        <label>Search By:</label>
        <select class="form-control" name="searchType">
          <option>Image ID</option>
          <option>Customer Username</option>
        </select>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">ID/Username</label>
        <input class="form-control" name="searchBy" placeholder="ID/Username" placeholder="ID">
      </div>
      <button type="submit" name="search" value="search" class="btn btn-primary" style="width:100%">Search</button><br />
    </form>
  </div>
  <div>
    <div class="container">

      <div class="row">
        <?php

        // Shows all information in image table
        if (isset($_POST['search']) && isset($_POST['searchType']) && isset($_POST['searchBy']))  {
          $searchBy = $_POST['searchBy'];
          $searchType = $_POST['searchType'];

          if ($searchType == "Image ID") {
            $query = "SELECT * from transaction a, images b, user c where a.imageId = b.id AND a.customerId = c.id AND a.imageId = '$searchBy'";
            $result = $conn->query($query);

            if (!$result) {
              die($conn->error);
            }

            echo "<div class='container'>
              <h1>Image ID: $searchBy</h1>
            </div>";

            $rows = $result->num_rows;

            // Parses through the table array
            for ($j = 0 ; $j < $rows ; ++$j) {
              $result->data_seek($j);
              $customerId =  $result->fetch_assoc()['customerId'];

              $result->data_seek($j);
              $customer =  $result->fetch_assoc()['username'];

              echo ' <div class="col-sm-4">
              <div class="card">
              <div class="card-body">
              <h5 class="card-title text-center">Customer: ' . $customer . '</h5>
              <p class="card-title text-center">Customer ID: ' . $customerId . '</p>
              </div>
              </div>
              </div>';
            }
          } else {
            $query = "SELECT * from transaction a, user b where a.customerId = b.id AND b.username = '$searchBy'";
            $result = $conn->query($query);

            if (!$result) {
              die($conn->error);
            }

            echo "<div class='container'>
              <h1>Customer: $searchBy</h1>
            </div>";

            $rows = $result->num_rows;

            // Parses through the table array
            for ($j = 0 ; $j < $rows ; ++$j) {
              $result->data_seek($j);
              $imageID =  $result->fetch_assoc()['imageId'];

              $result->data_seek($j);
              $fileName =  $result->fetch_assoc()['filename'];
              echo ' <div class="col-sm-4">
              <div class="card">
              <div class="card-body">
              <img class="card-img-top" src="' . $fileName . '" alt="Card image cap">
              <h5 class="card-title text-center">Image ID: ' . $imageID . '</h5>
              <a href="/imageDetail.php/?id=' . $imageID . '" class="btn btn-primary text-center" style="color: #fff;">View Details</a>
              </div>
              </div>
              </div>';

            }
          }
        }
        ?>
      </div>
    </div>
  </div>
</body>
</html>
