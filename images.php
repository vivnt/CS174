<?php
// Resource: image.php from Kevin Smith
// Author: Raghav Gupta
// CS: 174

//to connect to the SQL Database with root access
require_once 'login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

//to access the database with the unique image_ID and delete the chosen image
if (isset($_POST['delete']) && isset($_POST['image_ID']))
{
  //check what image was deleted on the webpage
  var_dump ($_POST);
  $image_ID = get_post($conn, 'image_ID');
  $query = "DELETE FROM image WHERE image_ID = '$image_ID'";
  $result = $conn->query($query);

  //check for failure
  if (!$result) echo "DELETE failed: $query<br>" .
  $conn->error . "<br><br>";
}

//check input from the user and add to the database
if (isset($_POST['source']) &&
isset($_POST['genre']))
{
  $source = get_post($conn, 'source');
  $genre = get_post($conn, 'genre');

  $image = $_FILES['image']['name'];
  $imagefile = "$image";
  $imageTemp = $_FILES['image']['tmp_name'];
  $sizeOf = getimagesize($imageTemp);
  $width = $sizeOf[0];
  $height = $sizeOf[1];
  $size = $_FILES['image']['size'];

  //insert the gathered information into the database
  // it is important to note that the sequence of the rows and the sequence of the values need to be the same
  $query = "INSERT INTO image (source, genre, width, height, size) VALUES('$source', '$genre', '$width', '$height', '$size')";
  $result = $conn->query($query);
  if (!$result) echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
}


echo "Please <a href='customer.php'>click here</a> to register as a customer";
//simple HTML form for user input
echo <<<_END
<form action="images.php" method="post" enctype="multipart/form-data"><pre>
<input type="file" name="image" />
Source (Photographer) <input type="text" name="source">
Genre <input type="text" name="genre">
<input type="submit" value="UPLOAD">
</pre></form>
_END;

//query from the SQL database and add the infornation to the database as the correct rows
$query = "SELECT * FROM image";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
$rows = $result->num_rows;

//loop logic to fetch the rows from the database
for ($j = 0 ; $j < $rows ; ++$j) {
  $result->data_seek($j);
  $row = $result->fetch_array(MYSQLI_NUM);

  //simple HTML view for the results of our output
  echo <<<_END
  <pre>
  Image_ID $row[0]
  Source (Photographer) $row[1]
  Genre $row[2]
  Width $row[3]
  Height $row[4]
  Size $row[5]
  </pre>
  <form action="images.php" method="post">
  <input type="hidden" name="delete" value="yes">
  <input type="hidden" name="image_ID" value="$row[0]">
  <input type="submit" value="DELETE IMAGE"></form>
  _END;
}
$result->close();
$conn->close();
function get_post($conn, $var)
{
  return $conn->real_escape_string($_POST[$var]);
}
?>
