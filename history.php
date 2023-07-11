<?php
session_start();
$UserID = $_SESSION["userID"];
require_once "config.php";

if (isset($_POST['showhistory'])) {
  $_SESSION["selectedMonth"] = $_POST["historyMonth"];
  $_SESSION["selectedYear"] = $_POST["historyYear"];
  
  $selectedMonth = $_SESSION["selectedMonth"];
  $selectedYear = $_SESSION["selectedYear"];
  
  $sql = "SELECT * FROM securitycontrol WHERE userid='$UserID' AND MONTH(filled_at)='$selectedMonth' AND YEAR(filled_at)='$selectedYear'";
  $result = mysqli_query($conn, $sql);
  $rowCount = mysqli_num_rows($result);
  $_SESSION["arr"] = mysqli_fetch_array($result, MYSQLI_ASSOC);
  if ($rowCount > 0) {
    header("Location: showhistory.php");
    exit();
  } else {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">No records found for this month.
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
    <title>Document</title>
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
        <a class="nav-link" href="logout.php">Login</a>
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
<form action="history.php" method="post">
<div class="mb-3">
        <label for="history" class="form-label">Search here the month</label>
        <input type="text" name="historyMonth" class="form-control" id="month">
        <label for="history" class="form-label">Search here the year</label>
        <input type="text" name="historyYear" class="form-control" id="year">
      </div>
      <div class="form-btn">
        <input type="submit" class="btn btn-primary" value="Show history" name="showhistory">
      </div>
</form>
</div>
<script src="js/jQuery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>