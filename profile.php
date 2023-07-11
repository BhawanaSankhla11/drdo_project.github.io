<?php
session_start();
if(!isset($_SESSION["user"])){
  header("Location:login.php");
}
$UserID=$_SESSION["userID"];
require_once "config.php";
$sql="SELECT * FROM user WHERE userid='$UserID'";
$result=mysqli_query($conn,$sql);
$arr=mysqli_fetch_array($result,MYSQLI_ASSOC);
?>
<?php
if(isset($_POST['edit'])){
    header("Location:edit.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <style>
        #edit{
            float:right;
        }
    </style>
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
    <form action="profile.php" method="post">
    <button id="edit" class="btn btn-primary" name="edit">Edit Profile</button>
        <h2>Profile</h2>
        <hr>
        <table class="table table-striped table-bordered">
  <tbody>
    <tr>
      <td>Name</td>
      <td><?php echo $arr["name"]; ?></td>
    </tr>
    <tr>
      <td>Email </td>
      <td><?php echo $arr["userid"]; ?></td>
    </tr>
    <tr>
      <td>Rank</td>
      <td><?php echo $arr["rank"]; ?></td>
    </tr>
    <tr>
      <td>Group Name</td>
      <td><?php echo $arr["groupname"]; ?></td>
    </tr>
    <tr>
      <td>OIC Name</td>
      <td><?php echo $arr["oicname"]; ?></td>
    </tr>
    <tr>
      <td>OIC Designation</td>
      <td><?php echo $arr["oicdesign"]; ?></td>
    </tr>
    <tr>
      <td>Registered Date</td>
      <td><?php echo $arr["filled_at"]; ?></td>
    </tr>
  </tbody>
</table>
</form>
</div>
  <script src="js/jQuery.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>