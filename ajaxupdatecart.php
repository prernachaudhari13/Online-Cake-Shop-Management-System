<?php
session_start();
include("dbconnection.php");
$sqlcart ="UPDATE billing_records SET qty='$_GET[qty]' WHERE billing_record_id='$_GET[cartid]'";
$qsqlcart = mysqli_query($con,$sqlcart);
?>