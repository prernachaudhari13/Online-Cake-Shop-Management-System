<?php
include("header.php");
if(!isset($_SESSION[user_id]))
{
	echo "<script>window.location='userlogin.php';</script>";
}
if(isset($_POST[btnpromocode]))
{
				include("sendmail.php");
				sendmail($_POST[emailid],"Promocode from ONLINE CAKE SHOP",$_POST[promocode],"ONLINE CAKE SHOP");
	?>
	<iframe   style="visibility:hidden" src="https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=pJFlm0K8BU6bN7GBknSWIA&senderid=lacake&channel=1&DCS=0&flashsms=0&number=91<?php echo $_POST[mobno]; ?>&text=<?php echo $_POST[promocode]; ?>&route=1" ></iframe>  
<?php
	echo "<script>alert('Promocode message sent.');</script>";
	echo "<script>window.location='viewregistrations.php'</script>";
}
?>

<!-- contact section -->
<section id="contact" class="parallax-section" style="background-color:#CCF">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-8 col-sm-10 text-center">
				<h1 class="heading">Send Promo Code</h1>
				<hr>
			</div>
			<div class="col-md-offset-1 col-md-10 col-sm-11 wow fadeIn" data-wow-delay="0.9s">
<?php
include("datatables.php");
?>
<form method="post" name="">
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<?php
$sqlpromocode1 = "SELECT max(promocode_id) FROM promocode  ";
$qsqlpromocode1 = mysqli_query($con,$sqlpromocode1);
$rspromocode1 = mysqli_fetch_array($qsqlpromocode1);

$sqlpromocode = "SELECT * FROM  promocode where promocode_id='$rspromocode1[0]'";
$qsqlpromocode = mysqli_query($con,$sqlpromocode);
$rspromocode = mysqli_fetch_array($qsqlpromocode);
	
$sql = "SELECT * FROM customer WHERE cust_id='$_GET[cust_id]'";
$qsql = mysqli_query($con,$sql);
$rs = mysqli_fetch_array($qsql);
  ?>
  <tr><td>Customer Email ID</td><td><input type="text" readonly name='emailid' value="<?php echo $rs[email_id];?>"></td></tr> 
  <tr><td>Customer Mobile No.</td><td><input type="text" readonly name='mobno' value="<?php echo $rs[cust_contactno];?>"></td></tr>
  <tr><td>Message</td><td><textarea id="promocode" name="promocode" style="width: 300px; height: 100px;" >Dear Online Cake Shop Customer, Apply promocode for discount. Promocode -  <?php echo $rspromocode[promocode]; ?>. Apply promocode and Enjoy shopping.</textarea></td></tr>
  <tr><td></td><td></td></tr>
  <tr><td></td><td><input type="submit" style="color: black"  name='btnpromocode' value="Send Promocode"></td></tr>
  </tbody>
</table>
</form>
		  </div>
			<div class="col-md-2 col-sm-1"></div>
		</div>
	</div>
</section>


<?php
include("footer.php");
?>
<script type="application/javascript">
function deleteconfirm()
{
	if(confirm("Are you sure you want to delete this record?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>