<?php
session_start();
$UserID = $_SESSION["userID"];
$arr = $_SESSION["arr"];

$selectedMonth = $_SESSION["selectedMonth"];
$selectedYear = $_SESSION["selectedYear"];

require_once "config.php";

$sql = "SELECT * FROM user WHERE userid='$UserID'";
$result = mysqli_query($conn, $sql);
$arrUser = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Document</title>
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
    <div id="printPage">
    <h2 style="text-align:right"><u>Annexure - 'B'</u></h2>
    <h2>Compliance Report on Security Controls for handling Cyber Incidents dated</h2>
    <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">S.No.</th>
      <th scope="col">Security Control</th>
      <th scope="col">Compliance/Non-compliance</th>
      <th scope="col">Remarks,if any</th>
    </tr>
  </thead>
  <tbody>
        <?php for ($i = 1; $i <= 10; $i++) { ?>
            <?php
            $sql="SELECT * FROM securitycontrol WHERE userid='$UserID' AND control=$i AND MONTH(filled_at)='$selectedMonth' AND YEAR(filled_at)='$selectedYear'";
            $result=mysqli_query($conn,$sql);
            $arr_res=mysqli_fetch_array($result,MYSQLI_ASSOC);
            ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td>Control <?php echo $i; ?></td>
            <td>
                <?php
                echo $arr_res["compliance"];
                ?>
            </td>
            <td>
                <?php
                echo $arr_res["remark"];
                ?>
            </td>
            </tr>
            <?php } ?>
   </tbody>
</table>
    <div>
        <p>It is also certified that no incident of security threat has been reported in the division / group since past one month.In case of any such incidence the same will be reported to Lab,ISO immediately.</p>
    </div>
    <div>
        <div align="right">
        <table>
            <tr>
                <td>Signature :</td>
                <td></td>
            </tr>
            <tr>
                <td>Name :</td>
                <td>
                    <?php
                        echo $arrUser["name"];
                    ?>
                </td>
            </tr>
            <tr>
                <td>Rank :</td>
                <td>
                    <?php
                        echo $arrUser["rank"];
                    ?>
                </td>
            </tr>
            <tr>
                <td>Group Name :</td>
                <td>
                    <?php
                        echo $arrUser["groupname"];
                    ?>
                </td>
            </tr>
            <tr>
                <td>Date :</td>
                <td>
                    <?php
                        echo $arr_res["filled_at"];
                    ?>
                </td>
            </tr>
        </table>
        </div>
        <div align="left">
            <table>
                <tr>
                    <td>Signature :</td>
                    <td></td>
                </tr>
                <tr>
                    <td>OIC Name :</td>
                    <td>
                    <?php
                    echo $arrUser["oicname"];
                    ?>
                    </td>
                </tr>
                <tr>
                    <td>OIC Designation : </td>
                    <td>
                    <?php
                    echo $arrUser["oicdesign"];
                    ?>
                    </td>
                </tr>
            </table>
        </div>
        <p>To,</p>
        <p>IT Department</p>
    </div>
    </div>
    <script src="js/jQuery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>