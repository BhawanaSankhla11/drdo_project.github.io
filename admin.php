<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location:login.php");
}

$UserID = $_SESSION["userID"];
require_once "config.php";

$sql = "SELECT * FROM user WHERE userid='$UserID'";
$result = mysqli_query($conn, $sql);
$arr = mysqli_fetch_array($result, MYSQLI_ASSOC);

if ($arr["admin"] === "yes") {
    require_once "removeuser.php";
}else {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Sorry ! Only admin can access this page.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <script src="js/jQuery"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>


