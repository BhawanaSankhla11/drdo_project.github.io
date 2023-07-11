<?php
session_start();
if(!isset($_SESSION["user"])){
    header("Location:login.php");
}
if(isset($_POST["logout"])){
    header("Location:logout.php");
}

$UserID=$_SESSION["userID"];
require_once "config.php";

$currMonth = date('m');
$currYear = date('Y');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Control Report</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
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

<?php
$sql="SELECT * FROM user WHERE userid='$UserID'";
$result=mysqli_query($conn,$sql);
$arr=mysqli_fetch_array($result,MYSQLI_ASSOC);
?>
<body id="body">
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
            $sql="SELECT * FROM securitycontrol WHERE userid='$UserID' AND control=$i";
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
                if($arr_res["remark"]==NULL)
                echo "NIL";
                else
                echo $arr_res["remark"];
                ?>
            </td>
            </tr>
            <?php } ?>
   </tbody>
</table>
<?php
$sql="SELECT * FROM control10 WHERE userid='$UserID' AND MONTH(filled_at)=$currMonth AND YEAR(filled_at)=$currYear";
$result=mysqli_query($conn,$sql);
#$arr_res1=mysqli_fetch_array($result,MYSQLI_ASSOC);
$rowCount=mysqli_num_rows($result);
?>
<?php if ($rowCount > 0) { ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Count</th>
                <th scope="col">Remarks, if any</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($arr_res1 = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
                <tr>
                    <td><?php echo $arr_res1["count"]; ?></td>
                    <td>
                        <?php
                        if ($arr_res1["remarks"] == NULL)
                            echo "NIL";
                        else
                            echo $arr_res1["remarks"];
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>


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
                        echo $arr["name"];
                    ?>
                </td>
            </tr>
            <tr>
                <td>Rank :</td>
                <td>
                    <?php
                        echo $arr["rank"];
                    ?>
                </td>
            </tr>
            <tr>
                <td>Group Name :</td>
                <td>
                    <?php
                        echo $arr["groupname"];
                    ?>
                </td>
            </tr>
            <tr>
                <td>Date :</td>
                <td>
                    <?php
                    if(is_null($arr_res))
                    echo " ";
                    else
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
                    echo $arr["oicname"];
                    ?>
                    </td>
                </tr>
                <tr>
                    <td>OIC Designation : </td>
                    <td>
                    <?php
                    echo $arr["oicdesign"];
                    ?>
                    </td>
                </tr>
            </table>
        </div>
        <p>To,</p>
        <p>IT Department</p>
    </div>

    </div>
    <div class="form-btn">
        <button id="printBtn" class="btn btn-warning mb-3" onclick="printForm()">Print</button>
        <a href="logout.php" class="btn btn-warning mb-3">Logout</a>
    </div>
    </div>
</form>
    <script type="text/javascript">
        function printForm(){
            var body=document.getElementById('body').innerHTML;
            var printableCont=document.getElementById('printPage').innerHTML;
            document.getElementById('body').innerHTML=printableCont;
            window.print();
            document.getElementById('body').innerHTML=body;
        }
    </script>
    <script src="js/jQuery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
