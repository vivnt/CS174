<!DOCTYPE html>
<html lang ="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Discover</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>

  <!-- Navigation -->
  <?php echo file_get_contents("navigation.html")?>

  <!-- Search Bar -->
  <!-- Author: Raghav Gupta -->
  <div class="container-fluid search">
    <h1>Search</h1>
    <form action="" autocomplete="off" method="post" accept-charset="utf-8">
      <div class="form-group">
        <label>Search By:</label>
        <select class="form-control" name="searchType">
          <option>Image ID</option>
          <option>Customer ID</option>
        </select>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">ID</label>
        <input type="number" class="form-control" name="searchId" value="searchId" placeholder="ID">
      </div>
    <button type="submit" name="search" value="search" class="btn btn-primary">Search</button><br />
    </form>
  </div>
</body>
</html>
