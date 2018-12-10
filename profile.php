<?php
include('server.php');
echo file_get_contents("navigation.html");
// Reference: Kevin Smith Slides
// Author: Vivian Tran
session_start();

// Function to delete a image
// Author: Vivian Tran
if (isset($_POST['id']) && isset($_POST['delete'])) {
  $id = $_POST['id'];
  $result = $conn->query("DELETE FROM images WHERE id = '$id'");
  echo "Deleted";
  if (!$result) {
      echo "DELETE failed: $query<br>" . $conn->error . "<br><br>";
  }

}

// Function to log out the username
// Author: Vivian Tran
if(isset($_POST['logout'])) {
  $_SESSION = array();
  setcookie(session_name(), '', time() - 2592000, '/');
  session_destroy();
  echo "Logged Out";
}

// Function to get user information to show in the profile page
// NOTE TO RAG: Use this to get user information
// Author: Vivian Tran
if (isset($_SESSION['username']))
{
  $username = $_SESSION['username'];
  $firstName = $_SESSION['firstName'];
  $lastName = $_SESSION['lastName'];
  $uid = $_SESSION['uid'];
  $credits = $_SESSION['credits'];

  echo "Welcome back $firstName $lastName.<br>
  Your uid is '$uid' and your username is '$username'.
  The amount of credits you have is '$credits'.<br /><br />";
}
else {
  // Will redirect to login if you try to access this page without logged in
  header("Location: http://192.168.64.2/login.php");
  exit();
}

// Shows all information in image table
$query = "SELECT * FROM images where author = '$username'";
$result = $conn->query($query);

if (!$result) {
  die($conn->error);
}

$rows = $result->num_rows;

// Parses through the table array
// NOTE TO RAG: Use this to make your profile area. If you need help, let me know.
// Maybe add this to the right side and the user information to the left?
for ($j = 0 ; $j < $rows-1 ; ++$j) {
  $result->data_seek($j);
  $author = $result->fetch_assoc()['author'];
  $result->data_seek($j);
  $id = $result->fetch_assoc()['id'];
  $result->data_seek($j);
  $extension = $result->fetch_assoc()['fileName'];

  $result->data_seek($j);
  echo 'Category: ' . $result->fetch_assoc()['category'] . '<br>';

  $result->data_seek($j);
  echo 'Size: ' . $result->fetch_assoc()['size'] . 'KB <br>';

  $result->data_seek($j);
  echo 'Width: ' . $result->fetch_assoc()['width'] . '<br>';

  $result->data_seek($j);
  echo 'Height: ' . $result->fetch_assoc()['height'] . '<br>';

  $fileName = "images/" . $author . "_" . $id . "." . $extension;

  echo "<img height='250' width='250' src='$fileName'><br/>";
  echo "<form method='post' action=''>";
  echo "<input type='hidden' name='id' value='$id'>";
  echo '<button type="submit" name="delete" value="delete" class="btn btn-primary">Delete</button><br />';
  echo '</form>';

}

$result->close();
$conn->close();

?>

<form method="post" enctype="multipart/form-data">
  <div class="text-center">
    <button type="submit" name="logout" value="logout" class="btn btn-primary">Log Out</button>
  </div>
</form>
