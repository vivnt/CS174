<?php include('server.php');
echo file_get_contents("navigation.html");
?>
<?php
//  Simple example of how you can use input type='file' form gadget
//
//  CS 174 - Kevin Smith   11/9/2018

echo <<<_END
<form action="upload.php" method="post" enctype="multipart/form-data"><pre>
	Select File: <input type='file' name='filename'>
	<input type="submit" value="Upload" name="submit" >
</pre></form>
_END;

if (isset($_POST['submit'])) {
	// Get filename that the user selected
	//
	$name = $_FILES['filename']['name'];

	// the file input action puts the file in a temp file in your server file system.
	// move it to a permanent file.
	//
	move_uploaded_file($_FILES['filename']['tmp_name'], "images/test.jpg");

	echo "Uploaded image '$name'<br><img src='$name'>";
}

?>
