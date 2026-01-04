<?php
include("header.php");
if(isset($_POST[submit]))
{
	echo $sql = "SELECT * FROM customer WHERE email_id='$_POST[email]'";
	$qsql = mysqli_query($con,$sql);
	$rs = mysqli_fetch_array($qsql);
	include("sendmail.php");
	sendmail($rs[email_id],"Password Recovery Mail from LA COURONNE","Kindly recover password by clicking following link: http://localhost/online%20cake%20order/recoverpassword.php?cust_id=$rs[0]",$rs[cust_name]);
}
?>

<!-- contact section -->
<section id="contact" class="parallax-section" style="background-image:url(images/16570992280_56a27f4755_b.jpg)">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-7 col-sm-9 text-center" style="color:#FFF">
				<h1 class="heading">Forgot Password</h1>
				<hr>
			</div>
			<div class="col-md-offset-1 col-md-7 col-sm-9 wow fadeIn" data-wow-delay="0.9s">
				<form action="" method="post" name="frmforgot" onsubmit="return validateform()">
					<div class="col-md-12 col-sm-12">
						<input name="email" type="email" class="form-control" id="email" placeholder="Email ID">
				  <span id="idemail" ></span>
                  </div>
					
					<div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6">
						<input name="submit" type="submit" class="form-control" id="submit" value="Recover Password">
					</div>
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
function validateform()
{
	var errmsg = 0;
	document.getElementById("idemail").innerHTML = "";	
	if(document.frmforgot.email.value =="")
	{
		document.getElementById("idemail").innerHTML ="<font color='red'>Please enter your email ID.</font>";
		errmsg=1;
	}
	if(errmsg==1)
	{
		return false;
	}
	else
	{
		return true;
	}
}
</script>