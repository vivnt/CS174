<?php

$hn = 'localhost';
$un = 'root';
$pw = '';
$db = 'fproj';

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
  die($conn->connect_error);
}

// TODO: Create table if not existed

?>
