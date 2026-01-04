<?php
include("header.php");
if(isset($_SESSION[user_id]))
{
	echo "<script>window.location='dashboard.php';</script>";
}
if(isset($_POST[submit]))
{
	$pwd = md5($_POST[password]);
	$sql = "SELECT * FROM user WHERE login_id='$_POST[login]' AND password='$pwd' AND status='Active'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_num_rows($qsql) == 1)
	{
		$rs = mysqli_fetch_array($qsql);
		$_SESSION[user_id] = $rs[user_id];
		$_SESSION[user_type] = $rs[user_type];
		echo "<script>window.location='dashboard.php';</script>";
	}
	else
	{
		echo "<script>alert('Invalid login credentials.');</script>";
	}
}
?>

<!-- contact section -->
<section id="contact" class="parallax-section" style="background-color:#CCF">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-7 col-sm-9 text-center">
				<h1 class="heading">Sign In</h1>
				<hr>
			</div>
			<div class="col-md-offset-1 col-md-7 col-sm-9 wow fadeIn" data-wow-delay="0.9s">
				<form action="" method="post" name="frmlogin" onsubmit="return validateform()" >
					<div class="col-md-12 col-sm-12">
						<input name="login" type="text" class="form-control" id="email" placeholder="Login ID">
				  <span id="idemail" ></span>
                  </div>
					<div class="col-md-12 col-sm-12">
						<input name="password" type="password" class="form-control" id="password" placeholder="Password">
				  <span id="idpassword" ></span>
                  </div>
					<div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6">
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
	if(document.frmlogin.login.value =="")
	{
		document.getElementById("idemail").innerHTML ="<font color='red'>Please enter your email ID.</font>";
		errmsg=1;
	}
	if(document.frmlogin.password.value =="")
	{
		document.getElementById("idpassword").innerHTML ="<font color='red'>Please enter the password.</font>";
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