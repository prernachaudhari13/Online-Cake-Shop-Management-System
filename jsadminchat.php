<?php
session_start();
error_reporting(0);
include("dbconnection.php");
$dttime = date("Y-m-d h:i:s");	
$sqlmessage = "SELECT * FROM message WHERE message_id='$_POST[message_id]' AND status='Active'";
$qsqlmessage = mysqli_query($con,$sqlmessage);
$rsmessage = mysqli_fetch_array($qsqlmessage);
$countmsg =mysqli_num_rows($qsqlmessage);
if($rsmessage[cust_id] == 0 )
{
	$cname = "Customer";
}
else
{
	$sqlcustomer = "SELECT * FROM customer WHERE cust_id='$rsmessage[cust_id]'";
	$qsqlcustomer = mysqli_query($con,$sqlcustomer);
	$rscustomer = mysqli_fetch_array($qsqlcustomer);
	$cname = $rscustomer[cust_name];
}

if($rsmessage[user_id] == 0 )
{
	$sname = "Staff";
}
else
{
	$sqluser = "SELECT * FROM user WHERE user_id='$rsmessage[user_id]'";
	$qsqluser = mysqli_query($con,$sqluser);
	$rsuser = mysqli_fetch_array($qsqluser);
	$sname = $rsuser[name];
}
?>
<input type="hidden" name="message_id" id="message_id" value="<?php echo $_POST[message_id]; ?>" >
    	<div  style="height:400px; overflow-y: scroll;" id="divchatrecords">
        <?php
		$sqlreplymsg = "SELECT * FROM message_reply  WHERE message_id='$_POST[message_id]' ORDER BY date_time";
		$qsqlreplymsg = mysqli_query($con,$sqlreplymsg);
		while($rsreplymsg = mysqli_fetch_array($qsqlreplymsg))
		{
			
			if($rsreplymsg[msg_type] != 'Customer' )
			{
		?>            
            <div class="chat-box-left">
                <strong style="color:#9B0305;"><?php echo $sname; ?>:</strong>
                <?php echo "<br>".$rsreplymsg[message_reply_text]; ?>
            </div>  
            <?php
			}
			if($rsreplymsg[msg_type] != 'Staff' )
			{
			?>
            <div class="chat-box-right">
                <strong style="color:#1A4512;"><?php echo $cname; ?>:</strong>
                <?php echo "<br>".$rsreplymsg[message_reply_text]; ?>      
               <?php
			   if($rsreplymsg[item_id] !=0 )
			   {
			   ?><br>
                <strong ><a href='#' onClick="window.open('item.php?editid=<?php echo $rsreplymsg[item_id]; ?>&itemtype=customized&custid=<?php echo $rsreplymsg[cust_id]; ?>&messageid=<?php echo $rsreplymsg[message_id]; ?>','name','height=500,width=550');" >Accept</a> | <a href='#'  onClick="cancelcustomized('<?php echo $rsreplymsg[item_id]; ?>')">Cancel</a></strong>
              
            <?php
			   }
			?>
            </div> 
        <?php
			}
		}
		?>                   
        </div>
           <div class="chat-box-footer"  id="chattext">
                <div class="input-group">
                    <input type="text" class="form-control" id="txtadminchat" placeholder="Press Enter key to Send.."  onkeyup="submitadminchat('<?php echo $_POST[message_id]; ?>','Staff',this.value,event);">
                    <span class="input-group-btn">
        <a href='viewcustomizedorder.php?cust_id=<?php echo $rsmessage[cust_id]; ?>'><button class="btn btn-info" type="button" id="myBtn"><span class="fa fa-birthday-cake"></span></button></a>
                    </span>   
                    <!-- <span class="fa fa-paperclip"></span> -->
                </div>
        	</div>