<?php
include("header.php");
if(isset($_SESSION[cust_id]))
{
	echo "<script>window.location='index.php';</script>";
}

if(isset($_GET[custid]))
{
	$sql = "UPDATE customer SET  status='Active' WHERE cust_id='$_GET[custid]'";
	$qsql = mysqli_query($con,$sql);
	echo "<script>alert('Your Account Activated successfully...');</script>";
	echo "<script>window.location='customerlogin.php';</script>";
}

if(isset($_POST[submit]))
{
	$pwd = md5($_POST[password]);
	$sql = "SELECT * FROM customer WHERE email_id='$_POST[email]' AND password='$pwd' AND status='Active'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_num_rows($qsql) == 1)
	{
		$rs = mysqli_fetch_array($qsql);
		$_SESSION[cust_id] = $rs[cust_id];
		echo "<script>window.location='index.php';</script>";
	}
	else
	{
		echo "<script>alert('Invalid login credentials.');</script>";
	}
}
?>
<!-- contact section -->
<section id="contact" class="parallax-section" style="background-image:url(images/16570992280_56a27f4755_b.jpg)">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-7 col-sm-9 text-center" style="color:#FFF">
				<h1 class="heading">Sign In</h1>
				<hr>
			</div>
			<div class="col-md-offset-1 col-md-7 col-sm-9 wow fadeIn" data-wow-delay="0.9s">
				<form action="" method="post" name="frmlogin" onsubmit="return validateform()" >
					<div class="col-md-12 col-sm-12">
						<input name="email" type="email" class="form-control" id="email" placeholder="Email ID">
				        <span id="idemail" ></span>
                  	</div>
					<div class="col-md-12 col-sm-12">
						<input name="password" type="password" class="form-control" id="password" placeholder="Password">
				 		<span id="idpassword" ></span>
                  	</div>
					<div class="col-md-12 col-sm-12">
						<strong style="float: left;"><a href="forgot_pswd.php"><u>Forgot Password?</u></a></strong>
						<strong style="float: right;"><a href="register.php"><u>Not Registered?Click Here to Register</u></a></strong>
                    </div>
				  <div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6" style="color:#FFF">
						<input name="submit" type="submit" class="form-control" id="submit" value="Login">
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
	document.getElementById("idpassword").innerHTML ="";	
	if(document.frmlogin.email.value =="")
	{
		document.getElementById("idemail").innerHTML ="<font color='red'>Please enter your email ID.</font>";
		errmsg=1;
	}	
	if(document.frmlogin.password.value =="")
	{
		document.getElementById("idpassword").innerHTML ="<font color='red'>Please enter your password.</font>";
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