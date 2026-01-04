<?php
session_start();
include("dbconnection.php");
$dttime = date("Y-m-d h:i:s");
$sqlmessage = "SELECT * FROM message WHERE chatid='$_SESSION[chatid]' AND status='Active'";
$qsqlmessage = mysqli_query($con,$sqlmessage);
$rsmessage = mysqli_fetch_array($qsqlmessage);
$countmsg =mysqli_num_rows($qsqlmessage);
$msgid=$rsmessage[0];
if($_POST[custtype] == "Customer")
{
	if($countmsg == 0)
	{
		
		$sql = "INSERT INTO message(chatid,cust_id,user_id,date_time,status) VALUES('$_SESSION[chatid]','$_SESSION[cust_id]','$_SESSION[user_id]','$dttime','Active')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);	
		$msgid = mysqli_insert_id($con);
		$countmsg =1;
	}
		$textmsg = mysqli_real_escape_string($con,$_POST[message]);
		$sql = "INSERT INTO message_reply(message_id,cust_id,user_id,message_reply_text,date_time,msg_type) VALUES('$msgid','$_SESSION[cust_id]','$_SESSION[user_id]','$textmsg','$dttime','$_POST[custtype]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);	
}
?>