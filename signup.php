<?php include('server.php') ?>
<!-- Author: Raghav Gupta -->
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


  <?php
  // POST function to insert data into the DB
  if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['username']) && isset($_POST['password'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $credits = 500;

    // Hashes password with ripemd algorithm
    $token = hash('ripemd128', $password);

    // Creates query to send to DB
    $result = $conn->query("INSERT into user (firstName, lastName, username, password, credits) VALUES ('$firstName', '$lastName', '$username', '$token', '$credits')");
    echo '<div class="alert alert-success text-center container" role="alert">
    User has been created.
    </div>';
    if (!$result) {
      echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
    }
  }

  ?>
  <div class="container-fluid bg">
    <div class="row">
      <div class="col-md-4 col-sm-4 col-xs-12"></div>
      <div class="col-md-4 col-sm-4 col-xs-12">
        <form class="form-container signup" method="post" enctype="multipart/form-data">
          <h1 style="color:#fff"> Sign Up</h1>
          <div class="form-group">
            <label style="color:#fff">First Name</label>
            <input type="text" class="form-control" name="firstName" placeholder="Enter Your First Name">
          </div>
          <div class="form-group">
            <label style="color:#fff">Last Name</label>
            <input type="text" class="form-control" name="lastName" placeholder="Enter Your Last Name">
          </div>
          <div class="form-group">
            <label style="color:#fff">Username</label>
            <input type="text" class="form-control" name="username" placeholder="Enter Your Username">
          </div>
          <div class="form-group">
            <label style="color:#fff">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter Your Password">
          </div>
          <button type="submit" class="btn btn-primary btn btn-block" >Sign Up</button>
          <label style="color:#fff"> Already a User? <a href="/login.php" style="color:#fff"> Login </a> </label>
        </form>
      </div>
      <div class ="col-md-4 col-sm-4 col-xs-12"></div>
    </div>
  </div>
</body>
</html>
