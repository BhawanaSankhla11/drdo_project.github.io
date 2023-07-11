<?php
session_start();
if(isset($_SESSION["user"])){
    header("Location:index.php");
}
if(isset($_POST["signup"])){
  header("Location:register.php");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
  <div class="container mt-4">
    <?php
    if (isset($_POST["login"])) {
      $userId=$_POST["userid"];
      $password=$_POST["password"];
      
      require_once "config.php";
      $sql="SELECT * FROM user WHERE userid='$userId'";
      $result=mysqli_query($conn,$sql);
      $userLoggedIn=mysqli_fetch_array($result,MYSQLI_ASSOC);
      if($userLoggedIn){
        if(password_verify($password,$userLoggedIn["password"])){
          session_start();
          $_SESSION["user"]="yes";
          $_SESSION["userID"]=$_POST["userid"];
          header("Location:index.php");
          die();
        }else{
          echo "<div class='alert alert-danger'>Password does not match</div>";
        }
      }else{
        echo "<div class='alert alert-danger'>Email address does not exist.Please register.</div>";
      }
    }
    ?>
    <h2>Please Login Here</h2>
    <hr>
    <form action="login.php" method="post">
      <div class="mb-3">
        <label for="inputEmail" class="form-label">Email address</label>
        <input type="email" name="userid" class="form-control" id="inputEmail" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="inputPassword" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="inputPassword">
      </div>
      <div class="form-btn">
        <input type="submit" value="Login" class="btn btn-primary mb-4" name="login">
        <input type="submit" value="Sign Up" class="btn btn-primary mb-4" name="signup">
      </div>
      <a href="forgotpwd.php" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Forgot Password ?</a>
    </form>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    
  </body>
</html>