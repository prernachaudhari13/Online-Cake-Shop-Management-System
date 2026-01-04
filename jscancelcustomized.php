<?php
include("dbconnection.php");
$sql ="UPDATE item SET status='Cancelled' WHERE item_id='$_POST[item_id]'";
$qsql = mysqli_query($con,$sql);
?>