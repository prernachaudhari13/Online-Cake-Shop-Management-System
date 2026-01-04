<?php
session_start();
error_reporting(0);
include("dbconnection.php");
		$sqlpincode = "SELECT * FROM pincode WHERE pincode='$_POST[pincode]' AND status='Active'";
		$qsqlpincode = mysqli_query($con,$sqlpincode);
		echo mysqli_num_rows($qsqlpincode);
?>