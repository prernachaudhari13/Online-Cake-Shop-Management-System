<?php
include("dbconnection.php");
$sqlcustomer = "SELECT * FROM customer WHERE email_id='$_GET[emailid]'";
$qsqlcustomer = mysqli_query($con,$sqlcustomer);
echo mysqli_num_rows($qsqlcustomer);
?>