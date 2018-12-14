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
  <div>
    <div class="container">
      <div class="container">
        <h1>Recent</h1>
        <p>See the most recent photos here.</p>
      </div>

      <div class="row">
        <?php

        // Shows all information in image table
        // NOTE TO RAG: Change limit number and for loop count if you want more or less photos
        $query = "SELECT * FROM images ORDER BY id DESC LIMIT 15";
        $result = $conn->query($query);

        if (!$result) {
          die($conn->error);
        }

        $rows = $result->num_rows;

        // Parses through the table array
        // NOTE TO RAG: Use this to make your profile area. If you need help, let me know.
        for ($j = 0 ; $j < 10 ; ++$j) {
          $result->data_seek($j);
          $author = $result->fetch_assoc()['author'];

          $result->data_seek($j);
          $category = $result->fetch_assoc()['category'];

          $result->data_seek($j);
          $size = $result->fetch_assoc()['size'];

          $result->data_seek($j);
          $width = $result->fetch_assoc()['width'];

          $result->data_seek($j);
          $height = $result->fetch_assoc()['height'];

          $result->data_seek($j);
          $id = $result->fetch_assoc()['id'];

          $fileName = "images/" . $author . "_" . $id . ".png";

          echo ' <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <img class="card-img-top" src="' . $fileName . '" alt="Card image cap">
                <div class="card-body">
                  <form method="post" action="">
                    <input type="hidden" name="id" value="' . $id . '">
                    <p class="card-text">Author: ' . $author . '</p>
                    <p class="card-text">Category: ' . $category . '</p>
                    <p class="card-text">Width: ' . $width . '</p>
                    <p class="card-text">Height: ' . $height . '</p>
                    <p class="card-text">Size: ' . $size . '</p>
                    <p class="card-text">ID: ' . $id . '</p>
                    <a href="/imageDetail.php/?id=' . $id . '" class="btn btn-primary" style="color: #fff;">View Details</a>
                  </form>
                </div>
              </div>
            </div>
          </div>';
        }
        ?>
      </div>
    </div>
  </div>
</body>
</html>
