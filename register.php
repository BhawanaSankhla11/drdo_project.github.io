<?php
session_start();
if(isset($_SESSION["user"])){
    header("Location:index.php");
}

if(isset($_POST["login"])){
  header("Location:login.php");
}
if($_SERVER['REQUEST_METHOD']=="POST"){
      $userid=$_POST["userid"];
      $password=$_POST["password"];
      $name=$_POST["name"];
      $rank=$_POST["rank"];
      $groupname=$_POST["groupname"];
      $oicname=$_POST["oicname"];
      $oicdesign=$_POST["oicdesign"];
      $admin=$_POST["admin"];
      $passwordHash=password_hash($password,PASSWORD_DEFAULT);

      $errors=array();
      if (empty($userid) OR empty($password) OR empty($name) OR empty($rank) OR empty($groupname) OR empty($oicname) OR empty($oicdesign) OR empty($admin)) {
        array_push($errors,"All fields are required");
      }

      if (!filter_var($userid,FILTER_VALIDATE_EMAIL)) {
        array_push($errors,"Email is not valid");
      }

      if (strlen($password)<8) {
        array_push($errors,"Password must be at least 8 characters long");
      }

      require_once "config.php";
      $sql="SELECT * FROM user WHERE userid='$userid'";
      $result=mysqli_query($conn,$sql);
      $rowCount=mysqli_num_rows($result);
      if ($rowCount>0) {
        array_push($errors,"This userid already exists");
      }
      if(count($errors)>0)
      {
        foreach ($errors as $error) {
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>$error<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        }
      }else{
        $sql="INSERT INTO `user` (`userid`, `password`, `name`, `rank`, `groupname`, `oicname`, `oicdesign`, `admin`, `filled_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, current_timestamp())";
        $stmt=mysqli_stmt_init($conn);
        $prepareStmt=mysqli_stmt_prepare($stmt,$sql);
        if($prepareStmt)
        {
          mysqli_stmt_bind_param($stmt,"ssssssss",$userid,$passwordHash,$name,$rank,$groupname,$oicname,$oicdesign,$admin);
          mysqli_stmt_execute($stmt);
          header("Location:index.php");
        }else {
          die("Something Went Wrong");
        }
      }     
}
?>
    
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration form</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
  </head>
  <body>
  <div class="container mt-4">
    <h2>Please Register Here</h2>
    <hr>
    <form action="register.php" method="POST">
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name="userid" class="form-control" id="email" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password">
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" id="name">
      </div>
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
      <div class="mb-3">
        <label for="admin" class="form-label">Are you admin?</label>
        <select name="admin">
                <option value="no">No</option>
                <option value="yes">Yes</option>
            </select>
      </div>
      <div class="form-btn">
        <input type="submit" class="btn btn-primary mb-4" value="Sign Up" name="submit">
        <input type="submit" class="btn btn-primary mb-4" value="Log In" name="login">
      </div>
    </form>
  </div>

<script src="js/jQuery.js"></script>
<script src="js/bootstrap.min.js"></script>
  </body>
</html>

