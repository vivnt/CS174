<?php include('server.php') ?>

<html lang="en">

<body>

  <?php
  echo file_get_contents("navigation.html")
  ?>

  <?php

    $conn = new mysqli($hn, $un, $pw, $db);

    if ($conn->connect_error) {
        die($conn->connect_error);
    }
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
    				$_SESSION['uid'] = $row[0];
    				echo "$row[1] $row[2] : Hi $row[0], you are now logged in as '$row[3]'";
    			}
    			else die("Invalid username/password combination");
    		}
    		else die("Invalid username/password combination");
    	}


  ?>
  <div class="container" style="padding: 15px;">
    <h1 style="text-align: center;">Login</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" name="username" placeholder="Enter Your Username">
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="text" class="form-control" name="password" placeholder="Enter Your Password">
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </form>
    <a href="signup.php">Don't have an account? Sign up here.</a>
  </div>
</body>
</html>
