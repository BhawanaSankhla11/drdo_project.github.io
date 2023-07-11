<?php
require_once "config.php";

if (isset($_POST['removeuser'])) {
    $removeID = $_POST["remove"];
    $sql = "SELECT * FROM user WHERE userid='$removeID'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount > 0) {
        $sql = "DELETE FROM user WHERE userid='$removeID'";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
        if ($prepareStmt) {
            mysqli_stmt_execute($stmt);
            header("Location: removeuser.php");
        }
    } else {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Entered email address does not exist.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Rights</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Security Control Form</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="logout.php">Login</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="profile.php">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="history.php">History</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin.php">Admin</a>
      </li>
    </ul>
  </div>
</nav> 

<div class="container mt-4">
<form action="removeuser.php" method="post">
<div class="mb-3">
        <label for="removedata" class="form-label">Search here the email address of user whose data to be removed</label>
        <input type="text" name="remove" class="form-control" id="remove">
      </div>
      <div class="form-btn">
        <input type="submit" class="btn btn-primary" value="Remove data" name="removeuser">
      </div>
</form>
</div>
<script src="js/jQuery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>