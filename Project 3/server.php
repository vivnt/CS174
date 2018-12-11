<?php

require_once 'login.php';

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die($conn->connect_error);
}

// echo "Query: <br /><br />";
//
// $query = "SELECT * FROM images";
// $result = $conn->query($query);
//
// if (!$result) {
//     die($conn->error);
// }
//
// $rows = $result->num_rows;
//
// for ($j = 0 ; $j < $rows ; ++$j) {
//     $result->data_seek($j);
//     echo 'ID: ' . $result->fetch_assoc()['id'] . '<br>';
//
//     $result->data_seek($j);
//     echo 'Genre: ' . $result->fetch_assoc()['genre'] . '<br>';
//
//     $result->data_seek($j);
//     echo 'Size: ' . $result->fetch_assoc()['size'] . '<br>';
//
//     $result->data_seek($j);
//     echo 'ISBN: ' . $result->fetch_assoc()['type'] . '<br><br>';
// }
// $result->close();
// $conn->close();

?>
