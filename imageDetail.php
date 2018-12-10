<?php
include('server.php');
echo file_get_contents("navigation.html");
?>
<?php

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
  $extension = $result->fetch_assoc()['fileName'];
  $fileName = "/images/" . $author . "_" . $id . "." . $extension;
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
      <h1>Purchase</h1><br />
      <p>Author: <?php echo $author ?></p>
      <p>Category: <?php echo $category ?></p>
      <p>Width: <?php echo $width ?></p>
      <p>Height: <?php echo $height ?></p>
      <p>Size: <?php echo $size ?></p>
    </div>
</div>


  </div>
</body>
