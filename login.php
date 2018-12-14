<?php include('server.php') ?>

<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" type="text/css" media="screen" href="style.css" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <title>CS174</title>
</head>
<body>



  <?php
  // POST function to insert data into the DB
  if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hashes password with ripemd algorithm
    $token = hash('ripemd128', $password);

    $query = "SELECT * FROM user WHERE username='$username'";
    $result = $conn->query($query);

    if (!$result) die($connection->error);
    elseif ($result->num_rows) {
      $row = $result->fetch_array(MYSQLI_NUM);
      $result->close();
      $token = hash('ripemd128', $password);
      if ($token == $row[4]) {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['firstName'] = $row[1];
        $_SESSION['lastName'] = $row[2];
        $_SESSION['credits'] = $row[6];
        $_SESSION['uid'] = $row[0];
        header("Location: index.php");
        exit();
      }
      else die("Invalid username/password combination");
    }
    else die("Invalid username/password combination");
  }


  ?>

  <!-- Author: Raghav Gupta -->
  <div class="container-fluid bg">
    <div class="row">
      <div class="col-md-4 col-sm-4 col-xs-12"></div>
      <div class="col-md-4 col-sm-4 col-xs-12">
        <form class="form-container login" method="post" enctype="multipart/form-data">
          <h1 style="color:#fff"> Login</h1>
          <div class="form-group">
            <label style="color:#fff">Username</label>
            <input type="text" class="form-control" name="username" placeholder="Enter Your Username">
          </div>
          <div class="form-group">
            <label style="color:#fff">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter Your Password">
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-success">Login</button>
            <a href="signup.php" class="btn btn-primary" style="color:#fff">Sign Up</a>
          </div>
        </form>
        <!-- NOTE TO RAG: You can't put this inside the form. Try to figure out another way or anther place. -->
        
      </div>
      <div class ="col-md-4 col-sm-4 col-xs-12"></div>
    </div>
  </div>
</body>
</html>
