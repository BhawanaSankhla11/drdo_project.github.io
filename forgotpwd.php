<?php
if (isset($_POST['pwdreset'])) {
    require_once "config.php";
    $userid=$_POST["userid"];
    $pwdreset=$_POST["password"];
    $passwordHash=password_hash($pwdreset,PASSWORD_DEFAULT);

    $sql="SELECT * FROM user WHERE userid='$userid'";
    $result=mysqli_query($conn,$sql);
    $rowCount=mysqli_num_rows($result);
    if (empty($userid) OR empty($pwdreset)) {
        echo '<div class="alert alert-danger">All fields are required</div>';
    }
    if (strlen($pwdreset)<8) {
        echo '<div class="alert alert-danger">Password must be atleast 8 characters long.</div>';
    }
    if ($rowCount>0) {
            $sql = "UPDATE user SET password='$passwordHash' WHERE userid='$userid'";
            // Prepare the statement
            $stmt = mysqli_stmt_init($conn);
            $stmt = $conn->prepare($sql);
              // Bind the parameters
            $stmt->bind_param("s", $passwordHash);
            $stmt->execute();
            // Close the statement and connection
            $stmt->close();
            $conn->close();
            // Redirect back to the submit form after insertion
            header("Location: login.php");
            exit();
    }
    else{
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Email address does not exist.Please register.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password reset</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-3">
    <h2>Password Reset</h2>
    <hr>
    <form action="forgotpwd.php" method="post">
    <div class="mb-3">
        <label for="inputEmail" class="form-label">Email address</label>
        <input type="email" name="userid" class="form-control" id="inputEmail" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="inputPassword" class="form-label">Enter new password</label>
        <input type="password" name="password" class="form-control" id="inputPassword">
      </div>
      <div class="form-btn">
        <input type="submit" value="Reset Password" class="btn btn-primary" name="pwdreset">
      </div>
    </form>
    </div>
    <script src="js/jQuery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>