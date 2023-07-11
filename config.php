<?php
/* To connect Database */
define('DB_SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','monthlyreport');

$conn=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);
if (!$conn) {
    echo "Connection Failed!".mysqli_connect_error();
}
/*
else
{
    echo "Connection successful!";
}
*/
?>