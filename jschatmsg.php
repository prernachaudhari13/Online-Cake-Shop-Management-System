<?php
session_start();
include("dbconnection.php");
$dttime = date("Y-m-d h:i:s");
$sqlmessage = "SELECT * FROM message WHERE chatid='$_SESSION[chatid]' AND status='Active'";
$qsqlmessage = mysqli_query($con,$sqlmessage);
$rsmessage = mysqli_fetch_array($qsqlmessage);
$countmsg =mysqli_num_rows($qsqlmessage);
$msgid=$rsmessage[0];

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
		<?php
        if($countmsg != 0)
        {
        ?>
            <?php
            $sqlreplymsg = "SELECT * FROM message_reply  WHERE message_id='$msgid' ORDER BY date_time";
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
                </div>
            <?php
                }
            }
            ?>
        <?php
        }
        else
        {
        ?>
            <div class="chat-box-right">
                <strong style="color:#1A4512;font-family:'Comic Sans MS', cursive">Staff:</strong><br> <strong style="font-family:'Comic Sans MS', cursive">How can I help you?</strong><br>
                <img src="images/livechat.gif" width="235" height="130" alt=""/>
            </div>
        <?php
        }
        ?>
<!--   <hr class="hr-clas" /> -->