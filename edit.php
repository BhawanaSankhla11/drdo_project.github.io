<?php
session_start();
$UserID=$_SESSION["userID"];
require_once "config.php";

if(!isset($_SESSION["user"])){
  header("Location:login.php");
}

if (isset($_POST['editprofile'])) {
    // Prepare the SQL statement for insertion
    $editrank = $_POST["rank"];
    $editgroupname = $_POST["groupname"];
    $editoicname = $_POST["oicname"];
    $editoicdesign = $_POST["oicdesign"];

    if (empty($editrank) OR empty($editgroupname) OR empty($editoicname) OR empty($editoicdesign)) {
       echo '<div class="alert alert-danger">All fields are required</div>';
    }

    else{
      $sql = "UPDATE user SET rank='$editrank', groupname='$editgroupname', oicname='$editoicname', oicdesign='$editoicdesign' WHERE userid='$UserID'";

    // Prepare the statement
    $stmt = mysqli_stmt_init($conn);
    $stmt = $conn->prepare($sql);
    // Bind the parameters
    $stmt->bind_param("ssss", $editrank, $editgroupname, $editoicname, $editoicdesign);
    $stmt->execute();
    // Close the statement and connection
    $stmt->close();
    $conn->close();
    // Redirect back to the profile after updation
    header("Location: profile.php");
    exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
    <div class="container mt-3">
    <form action="edit.php" method="post">
      <div class="mb-3">
        <label for="rank" class="form-label">Rank</label>
        <input type="text" name="rank" class="form-control" id="rank">
      </div>
      <div class="mb-3">
        <label for="groupname" class="form-label">Group Name</label>
        <input type="text" name="groupname" class="form-control" id="groupname">
      </div>
      <div class="mb-3">
        <label for="oicname" class="form-label">OIC Name</label>
        <input type="text" name="oicname" class="form-control" id="oicname">
      </div>
      <div class="mb-3">
        <label for="oicdesign" class="form-label">OIC Designation</label>
        <input type="text" name="oicdesign" class="form-control" id="oicdesign">
      </div>
      <input type="submit" class="btn btn-primary" value="Edit" name="editprofile">
    </form>
    </div>
    <script src="js/jQuery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>