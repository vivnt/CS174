<?php
include('server.php');
echo file_get_contents("navigation.html");
// Reference: Kevin Smith Slides
// Author: Vivian Tran
session_start();

// Updates the profile information with new credits
$username = $_SESSION['username'];
$query = "SELECT * FROM user WHERE username='$username'";
$result = $conn->query($query);

if (!$result) die($connection->error);
elseif ($result->num_rows) {
  $row = $result->fetch_array(MYSQLI_NUM);
  $result->close();
  $_SESSION['credits'] = $row[6];
}


// Function to delete a image
// Author: Vivian Tran
if (isset($_POST['id']) && isset($_POST['delete'])) {
  $id = $_POST['id'];
  $result = $conn->query("DELETE FROM images WHERE id = '$id'");
  echo "Deleted";
  if (!$result) {
    echo "DELETE failed: $query<br>" . $conn->error . "<br><br>";
  }
  echo '<div class="alert alert-success text-center container" role="alert">
  Image has been deleted.
  </div>';
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

  echo "<div class='container'>
  <h1 class='text-center'>Welcome back, $firstName $lastName.</h1>
  <h3 class='text-center'>The amount of credits you have is '$credits'.</h3>
  <p class='text-center'>Your uid is '$uid' and your username is '$username'.</p>
  </div>";
}
else {
  // Will redirect to login if you try to access this page without logged in
  header("Location:login.php");
  exit();
}

?>

<form method="post" enctype="multipart/form-data">
  <div class="text-center">
    <button type="submit" name="logout" value="logout" class="btn btn-primary">Log Out</button>
    <a href="/purchases.php" class="btn btn-success">View Purchases</a>
  </div>
</form>

<?php
// Shows all information in image table
$query = "SELECT * FROM images where author = '$username'";
$result = $conn->query($query);

if (!$result) {
  die($conn->error);
}

$rows = $result->num_rows;
echo "<h1 class='text-center'>Uploaded Images</h1>";
echo '<div class="container">';
echo '<div class="row">';
$uid = $_SESSION['uid'];

// Parses through the table array
// NOTE TO RAG: Use this to make your profile area. If you need help, let me know.
// Maybe add this to the right side and the user information to the left?
for ($j = 0 ; $j < $rows ; ++$j) {

  $result->data_seek($j);
  $author = $result->fetch_assoc()['author'];

  $result->data_seek($j);
  $category = $result->fetch_assoc()['category'];

  $result->data_seek($j);
  $width = $result->fetch_assoc()['width'];

  $result->data_seek($j);
  $height = $result->fetch_assoc()['height'];

  $result->data_seek($j);
  $size = $result->fetch_assoc()['size'];

  $result->data_seek($j);
  $imageID = $result->fetch_assoc()['id'];

  $fileName = "images/" . $author . "_" . $imageID . ".png";
  echo ' <div class="col-sm-4">
  <div class="card">
  <div class="card-body">
  <img class="card-img-top" src="' . $fileName . '" alt="Card image cap">
  <div class="card-body">
  <h5 class="card-title">Card title</h5>
  <form method="post" action="">
  <p class="card-text">Author: ' . $author . '</p>
  <p class="card-text">Category: ' . $category . '</p>
  <p class="card-text">Width: ' . $width . '</p>
  <p class="card-text">Height: ' . $height . '</p>
  <p class="card-text">Size: ' . $size . '</p>
  <p class="card-text">ID: ' . $imageID . '</p>
  <input type="hidden" name="id" value="' . $imageID . '">
  <button type="submit" name="delete" value="delete" class="btn btn-primary">Delete</button>
  </form>
  </div>
  </div>
  </div>
  </div>';

}

echo '</div>';
echo '</div>';

$result->close();
$conn->close();
?>
