<?php include('server.php') ?>
<!-- Author: Raghav Gupta -->
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
</head>
<body>

  <?php
  echo file_get_contents("navigation.html")
  ?>

  <?php
  // POST function to insert data into the DB
  if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['username']) && isset($_POST['password'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hashes password with ripemd algorithm
    $token = hash('ripemd128', $password);

    // Creates query to send to DB
    $result = $conn->query("INSERT into user (firstName, lastName, username, password) VALUES ('$firstName', '$lastName', '$username', '$token')");
    echo "created user";
    if (!$result) {
      echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
    }
  }

  ?>
  <div class="container-fluid bg">
    <div class="row">
      <div class="col-md-4 col-sm-4 col-xs-12"></div>
      <div class="col-md-4 col-sm-4 col-xs-12">
        <form class="form-container signup">
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
            <input type="text" class="form-control" name="password" placeholder="Enter Your Password">
          </div>
          <a href="homepage.html" class="btn btn-success btn-block">Sign Up</a>
        </form>
      </div>
      <div class ="col-md-4 col-sm-4 col-xs-12"></div>
    </div>
  </div>
</body>
</html>
