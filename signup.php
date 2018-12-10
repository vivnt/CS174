<?php include('server.php') ?>
<!-- Author: Raghav Gupta -->
<html lang="en">

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
  <div class="container" style="padding: 15px;">
    <h1 style="text-align: center;">Sign Up</h1>
    <form method="post" enctype="multipart/form-data">
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
      <!-- <div class="form-group">
      <label>User Type</label>
      <select class="form-control" name="userType">
      <option>Admin</option>
      <option>Customer</option>
    </select>
  </div> -->
  <div class="text-center">
    <button type="submit" class="btn btn-primary">Sign Up</button>
  </div>
</form>
<a href="login.php">Already have an account? Log in here.</a>
</div>
</body>
</html>
