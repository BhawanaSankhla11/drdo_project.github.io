<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$UserID = $_SESSION["userID"];
require_once "config.php";

$currMonth = date('m');
$currYear = date('Y');

$sql = "SELECT * FROM securitycontrol WHERE userid='$UserID' AND MONTH(filled_at) = $currMonth AND YEAR(filled_at) = $currYear";
$result = mysqli_query($conn, $sql);
$rowCount = mysqli_num_rows($result);

$query = "SELECT * FROM control10 WHERE userid='$UserID' AND MONTH(filled_at) = $currMonth AND YEAR(filled_at) = $currYear";
$res = mysqli_query($conn, $query);
$rowCount2 = mysqli_num_rows($res);

if (isset($_POST['submitForm'])) {
    if ($rowCount > 0) {
        $arr = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $filledDate = $arr["filled_at"];
        
        $sql = "UPDATE securitycontrol SET compliance = ?, remark = ? WHERE userid = ? AND control = ? AND filled_at = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Error: " . $conn->error);
        }
        $stmt->bind_param("sssis", $compliance, $remarks, $UserID, $scontrol, $filledDate);

        // Loop through the submitted data
        for ($i = 1; $i <= 10; $i++) {
            // Get the values from the form submission
            $scontrol = $i;
            $compliance = $_POST["compliance_" . $i];
            $remarks = $_POST["remarks_" . $i];
            // Execute the statement
            $stmt->execute();
        }
        // Close the statement
        $stmt->close();
        // Redirect back to the submit form after updating
        //exit(); 
    }
    else {
        $sql = "INSERT INTO securitycontrol (userid, control, compliance, remark, filled_at) VALUES (?, ?, ?, ?, current_timestamp())";
        // Prepare the statement
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Error: " . $conn->error);
        }
        // Bind the parameters
        $stmt->bind_param("siss", $UserID, $scontrol, $compliance, $remarks);
        // Loop through the submitted data
        for ($i = 1; $i <= 10; $i++) {
            // Get the values from the form submission
            $scontrol = $i;
            $compliance = $_POST["compliance_" . $i];
            $remarks = $_POST["remarks_" . $i];
            // Execute the statement
            $stmt->execute();
        }
        // Close the statement
        $stmt->close();
    }

    if ($rowCount2 > 0) {
        $arr_res = mysqli_fetch_array($res, MYSQLI_ASSOC);
        $filledDate = $arr_res["filled_at"];
        
        if ($_POST['count'] == $rowCount2) {
            $sql = "UPDATE control10 SET remarks = ? WHERE userid = ? AND filled_at = ? AND count=?";
            $stmt = $conn->prepare($sql);
            
            if (!$stmt) {
                die("Error: " . $conn->error);
            }
            
            $stmt->bind_param("sssi", $remark, $UserID, $filledDate, $count);
    
            // Loop through the submitted data
            for ($i = 1; $i <= $_POST['count']; $i++) {
                // Get the values from the form submission
                $count = $_POST["count_".$i];
                $remark = $_POST["remark_" . $i];
                // Execute the statement
                $stmt->execute();
            }
            
            // Close the statement
            $stmt->close();
        } elseif ($_POST['count'] > $rowCount2) {
            $sql = "UPDATE control10 SET remarks = ? WHERE userid = ? AND filled_at = ? AND count=?";
            $stmt = $conn->prepare($sql);
            
            if (!$stmt) {
                die("Error: " . $conn->error);
            }
            
            $stmt->bind_param("sssi", $remark, $UserID, $filledDate, $count);
    
            // Loop through the submitted data
            for ($i = 1; $i <= $rowCount2; $i++) {
                // Get the values from the form submission
                $count = $_POST["count_".$i];
                $remark = $_POST["remark_" . $i];
                // Execute the statement
                $stmt->execute();
            }
            
            // Close the statement
            $stmt->close();
            
            // Insert extra records
            $query = "INSERT INTO control10 (userid, count, remarks, filled_at) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            
            if (!$stmt) {
                die("Error: " . $conn->error);
            }
            
            $stmt->bind_param("siss", $UserID, $count, $remark, $filledDate);
            
            for ($i = $rowCount2 + 1; $i <= $_POST['count']; $i++) {
                // Get the values from the form submission
                $count = $_POST["count_" . $i];
                $remark = $_POST["remark_" . $i];
                // Execute the statement
                $stmt->execute();
            }
            
            // Close the statement
            $stmt->close();
        } else {
            $sql = "UPDATE control10 SET remarks = ? WHERE userid = ? AND filled_at = ? AND count=?";
            $stmt = $conn->prepare($sql);
            
            if (!$stmt) {
                die("Error: " . $conn->error);
            }
            
            $stmt->bind_param("sssi", $remark, $UserID, $filledDate, $count);
    
            // Loop through the submitted data
            for ($i = 1; $i <= $_POST['count']; $i++) {
                // Get the values from the form submission
                $count = $_POST["count_".$i];
                $remark = $_POST["remark_" . $i];
                // Execute the statement
                $stmt->execute();
            }
            
            // Close the statement
            $stmt->close();
            
            // Delete extra records
            $val = $_POST['count'];
            $value = intval($val);
            $sql = "DELETE FROM control10 WHERE userid = ? AND filled_at = ? AND count > ?";
            $stmt = $conn->prepare($sql);
            
            if (!$stmt) {
                die("Error: " . $conn->error);
            }
            
            $stmt->bind_param("ssi", $UserID, $filledDate, $value);
            $stmt->execute();
            
            // Close the statement
            $stmt->close();
        }
    } else {
        $query = "INSERT INTO control10 (userid, count, remarks, filled_at) VALUES (?, ?, ?, current_timestamp())";
        $stmt = $conn->prepare($query);
        
        if (!$stmt) {
            die("Error: " . $conn->error);
        }
        
        $stmt->bind_param("sis", $UserID, $count, $remark);
    
        for ($i = 1; $i <= $_POST['count']; $i++) {
            // Get the values from the form submission
            $count = $_POST["count_" . $i];
            $remark = $_POST["remark_" . $i];
            // Execute the statement
            $stmt->execute();
        }
        
        // Close the statement
        $stmt->close();
    }
    
    header("Location:submit.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Controls Form</title>
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
<div class="container">
    <h2 style="text-align:right"><u>Annexure - 'B'</u></h2>
    <h2>Compliance Report on Security Controls for handling Cyber Incidents dated</h2>
    <form method="post" action="index.php">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">S. No.</th>
                    <th scope="col">Security Control</th>
                    <th scope="col">Compliance / Non-compliance</th>
                    <th scope="col">Remarks, if any</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>1</td>
                        <td>Control 1</td>
                        <td>
                            <select name="compliance_1">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </td>
                        <td>
                            <textarea name="remarks_1"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Control 2</td>
                        <td>
                            <select name="compliance_2">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </td>
                        <td>
                            <textarea name="remarks_2"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Control 3</td>
                        <td>
                            <select name="compliance_3">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </td>
                        <td>
                            <textarea name="remarks_3"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Control 4</td>
                        <td>
                            <select name="compliance_4">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </td>
                        <td>
                            <textarea name="remarks_4"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Control 5</td>
                        <td>
                            <select name="compliance_5">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </td>
                        <td>
                            <textarea name="remarks_5"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Control 6</td>
                        <td>
                            <select name="compliance_6">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </td>
                        <td>
                            <select name="remarks_6">
                                <option value="Applicable">Applicable</option>
                                <option value="Not Applicable">Not Applicable</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Control 7</td>
                        <td>
                            <select name="compliance_7">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </td>
                        <td>
                            <textarea name="remarks_7"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Control 8</td>
                        <td>
                            <select name="compliance_8">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </td>
                        <td>
                            <textarea name="remarks_8"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Control 9</td>
                        <td>
                            <select name="compliance_9">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </td>
                        <td>
                            <textarea name="remarks_9"></textarea>
                        </td>
                    </tr>
                <tr>
                    <td>10</td>
                    <td>Control 10</td>
                    <td>
                        <select name="compliance_10" id="control10">
                            <option value="no">No</option>
                            <option value="yes">Yes</option>
                        </select>
                        <br><br>
                        <input type="number" placeholder="Enter the number ofrows to be inserted" id="count" style="display: none;" name="count">
                    </td>
                    <td>
                        <textarea name="remarks_10"></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered" id="additionalTable" style="display: none;">
            <thead>
                <tr>
                    <th>Count</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody id="additionalTableBody">
                <!-- Additional rows will be dynamically added here -->
            </tbody>
        </table>
        <input type="submit" class="btn btn-primary mt-3 mb-3" value="Submit" name="submitForm" id="submitForm">
        <input type="reset" class="btn btn-primary mt-3 mb-3" value="Reset" name="resetForm">
    </form>
</div>
<script type="text/javascript" src="js/jQuery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#control10').on('change', function() {
        if ($(this).val() === 'yes') {
            $('#count').show();
            $('#additionalTable').show();
        } else {
            $('#count').hide();
            $('#additionalTable').hide();
        }
    });

    $('#count').on('input', function() {
        var count = parseInt($(this).val());
        var additionalTableBody = $('#additionalTableBody');
        additionalTableBody.empty();
        if (count > 0) {
            for (var i = 1; i <= count; i++) {
                additionalTableBody.append('<tr><td><input type="text" name="count_' + i + '"></td><td><input type="text" name="remark_' + i + '"></td></tr>');
            }
        }
    });
});
</script>
</body>
</html>
