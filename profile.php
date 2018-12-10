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
  Your uid is '$uid' and your username is '$username'.<br /><br />";
}
else {
  header("Location: http://192.168.64.2/login.php");
  exit();
}

// Shows all information in image table
$query = "SELECT * FROM images";
$result = $conn->query($query);

if (!$result) {
  die($conn->error);
}

$rows = $result->num_rows;

// Parses through the table array
for ($j = 0 ; $j < $rows ; ++$j) {
  $result->data_seek($j);
  $author = $result->fetch_assoc()['author'];
  echo 'Author: ' . $author . '<br>';

  $result->data_seek($j);
  echo 'Category: ' . $result->fetch_assoc()['category'] . '<br>';

  $result->data_seek($j);
  echo 'Size: ' . $result->fetch_assoc()['size'] . 'KB <br>';

  $result->data_seek($j);
  echo 'Width: ' . $result->fetch_assoc()['width'] . '<br>';

  $result->data_seek($j);
  echo 'Height: ' . $result->fetch_assoc()['height'] . '<br>';

  $result->data_seek($j);
  $id = $result->fetch_assoc()['id'];
  echo 'ID: ' . $id . '<br>';

  $result->data_seek($j);
  $extension = $result->fetch_assoc()['fileName'];
  echo 'Extension: ' . $extension . '<br>';

  $fileName = "images/" . $author . "_" . $id . "." . $extension;

  echo "<form method='post' action=''>";
  echo "<input type='hidden' name='id' value='$id'>";
  echo '<button type="submit" name="delete" value="delete" class="btn btn-primary">Delete</button><br /><br/>';
  echo '<button type="submit" name="purchase"  value="purchase" class="btn btn-primary">Purchase</button><br /><br/>';
  echo '</form>';
  echo "Image File Name: '$fileName'<br><img src='$fileName'>";
}

$result->close();
$conn->close();

?>

<form method="post" enctype="multipart/form-data">
  <div class="text-center">
    <button type="submit" name="logout" value="logout" class="btn btn-primary">Log Out</button>
  </div>
</form>
