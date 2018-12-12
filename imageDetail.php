<?php
include('server.php');
echo file_get_contents("navigation.html");
?>

<!--  Author: Vivian Tran -->
<?php
session_start();
$credits = $_SESSION['credits'];

$id = $_GET['id'];
$query = "SELECT * FROM images where id = '$id'";
$result = $conn->query($query);

if (!$result) {
  die($conn->error);
}

$rows = $result->num_rows;

// Parses through the table array
$result->data_seek(0);
$author = $result->fetch_assoc()['author'];

$result->data_seek(0);
$category = $result->fetch_assoc()['category'];

$result->data_seek(0);
$category = $result->fetch_assoc()['category'];

$result->data_seek(0);
$width = $result->fetch_assoc()['width'];

$result->data_seek(0);
$height = $result->fetch_assoc()['height'];

$result->data_seek(0);
$size = $result->fetch_assoc()['size'];

$result->data_seek(0);
$id = $result->fetch_assoc()['id'];

$result->data_seek(0);
$fileName = "/images/" . $author . "_" . $id . ".png";

if (isset($_GET['id']) && isset($_POST['purchase'])) {
  $imageId = $_GET['id'];
  $customerID = $_SESSION['uid'];

  $date = date("m/d/Y");

  // INSERT transaction and UPDATE user credits
  $insert = $conn->query("INSERT into transaction (customerId, imageId, date, filename) VALUES ('$customerID', '$imageId', '$date', '$fileName')");
  $update = $conn->query("UPDATE user SET credits = credits - 100 WHERE id = '$customerID'");
  $update = $conn->query("UPDATE images SET popularity = popularity - 100 WHERE id = '$imageId'");

  if (!$update || !$insert) {
    echo "INSERT/UPDATE failed: $query<br>" . $conn->error . "<br><br>";
  }

  echo '<div class="alert alert-success text-center container" role="alert">
  Purchase Complete.
  </div>';
}
?>
<body>
  <div class="container"
  <div id="slides" class="carousel slide" data-ride="carousel">

    <div class="carousel-inner">
      <div class="carousel-item active">
        <img width="500" src="<?php echo $fileName ?>">
        <div class="carousel-caption d-none d-md-block">

        </div>
      </div>
    </div>
  </div>
</div>
<div>

</div>
<div class="container">
  <div class="row">
    <div class="col-sm">
      <h1>Details</h1><br />
      <p>Author: <?php echo $author ?></p>
      <p>Category: <?php echo $category ?></p>
      <p>Width: <?php echo $width ?></p>
      <p>Height: <?php echo $height ?></p>
      <p>Size: <?php echo $size ?></p>
    </div>
    <div class="col-sm">
      <h1>Purchase</h1><br  />
      <h5>Currents Credits: <?php echo $credits; ?></h5>
      <h5>Credits: -100</h5>
      <h5>Total: <?php echo $credits - 100; ?></h5>
      <form method="post">
        <button type="submit" name="purchase" value="purchase"class="btn btn-primary">Purchase</button>
      </form>
    </div>
  </div>


</div>
</body>
