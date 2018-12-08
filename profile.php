<?php
  include('server.php');
  echo file_get_contents("navigation.html");
  session_start();

  if(isset($_POST['logout'])) {
    $_SESSION = array();	// Delete all the information in the array
		setcookie(session_name(), '', time() - 2592000, '/');
		session_destroy();
    echo "Logged Out";
  }

	if (isset($_SESSION['username']))
	{
		$username = $_SESSION['username'];
		$firstName = $_SESSION['firstName'];
		$lastName = $_SESSION['lastName'];
		$uid = $_SESSION['uid'];

		echo "Welcome back $firstName $lastName.<br>
    Your uid is '$uid' and your username is '$username'.";
	}
	else {
    echo "Please log in.";
  }

?>

<form method="post" enctype="multipart/form-data">
  <div class="text-center">
    <button type="submit" name="logout" value="logout" class="btn btn-primary">Log Out</button>
  </div>
</form>
