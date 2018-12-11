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
  if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['userType'])) {
      $firstName = $_POST['firstName'];
      $lastName = $_POST['lastName'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      $userType = $_POST['userType'];

      // Hashes password with ripemd algorithm
      $token = hash('ripemd128', $password);

      // Creates query to send to DB
      $result = $conn->query("INSERT into customer (firstName, lastName, username, password, userType) VALUES ('$firstName', '$lastName', '$username', '$token', '$userType')");

      if (!$result) {
          echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
      }
  }

?>
  <div class="container" style="padding: 15px;">
    <h1 style="text-align: center;">Sign Up</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label>First Name</label>
        <input type="text" class="form-control" name="firstName" placeholder="Enter Your First Name">
      </div>
      <div class="form-group">
        <label>Last Name</label>
        <input type="text" class="form-control" name="lastName" placeholder="Enter Your Last Name">
      </div>
      <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" name="username" placeholder="Enter Your Username">
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="text" class="form-control" name="password" placeholder="Enter Your Password">
      </div>
      <div class="form-group">
        <label>User Type</label>
        <select class="form-control" name="userType">
          <option>Admin</option>
          <option>Customer</option>
        </select>
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary">Sign Up</button>
      </div>
    </form>
  </div>
</body>
</html>
