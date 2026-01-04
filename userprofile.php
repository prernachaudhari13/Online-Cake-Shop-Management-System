<?php
include("header.php");
if(!isset($_SESSION[user_id]))
{
	echo "<script>window.location='userlogin.php';</script>";
}
if($_POST[randomid] == $_SESSION[randomid])
{
	if(isset($_POST[submit]))
	{
			$sql ="UPDATE user SET user_type='$_POST[usertype]',login_id='$_POST[loginid]',name='$_POST[name]',mob_no='$_POST[phone]',address='$_POST[address]',status='$_POST[status]' WHERE user_id='$_SESSION[user_id]'";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Profile updated successfully.');</script>";
			}
	}
}
$_SESSION[randomid] = rand();
if(isset($_SESSION[user_id]))
{
	$sqledit ="select * from user WHERE user_id='$_SESSION[user_id]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>


<!-- contact section -->
<section id="contact" class="parallax-section" style="background-color:#CCF">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-7 col-sm-9 text-center">
				<h1 class="heading">User Profile</h1>
				<hr>
			</div>
			<div class="col-md-offset-1 col-md-9 col-sm-11 wow fadeIn" data-wow-delay="0.9s">
				<form action="" method="post" name="frmuser" onsubmit="return validateform()">
                <input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>">
                    <div class="col-md-10 col-sm-10">
						<select name="usertype" class="form-control"  placeholder="User Type">
                       <option value="">Select User Type</option>
                        <?php
						$arr = array("employee","admin");
						foreach($arr as $val)
						{						
							if($val == $rsedit[user_type])
							{
							echo "<option value='$val' selected>$val</option>";
							}
							else
							{
							echo "<option value='$val'>$val</option>";							
							}
						}
						?>
                        </select>
					<span id="idusrtyp" ></span>
                    </div>
                    <div class="col-md-10 col-sm-10">
						<input name="loginid" type="text" class="form-control" placeholder="Login ID" value="<?php echo $rsedit[login_id]; ?>">
					<span id="idlgid" ></span>
                    </div>
                     <div class="col-md-10 col-sm-10">
						<input name="name" type="text" class="form-control" placeholder="Name" value="<?php echo $rsedit[name]; ?>">
					<span id="idnm" ></span>
                    </div>
                   
                    <div class="col-md-10 col-sm-10">
						<input name="phone" type="text" class="form-control" placeholder="Mobile Number" value="<?php echo $rsedit[mob_no]; ?>">
					<span id="idmob" ></span>
                    </div>
                     <div class="col-md-10 col-sm-10">
						<textarea name="address" class="form-control" placeholder="Address"><?php echo $rsedit[address]; ?></textarea>
					<span id="idadd" ></span>
                    </div>
                    <div class="col-md-10 col-sm-10">                
						<select name="status" class="form-control" placeholder="Status">
                        <?php
						$arr = array("Active","Inactive");
						foreach($arr as $val)
						{						
							if($val == $rsedit[status])
							{
							echo "<option value='$val' selected>$val</option>";
							}
						}
						?>
                        </select>
				  <span id="idsts" ></span>
                  </div>
					
                 
					<div class="col-md-offset-3 col-md-4 col-sm-offset-3 col-sm-5">
						<input name="submit" type="submit" class="form-control" id="submit" value="Update Profile">
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
	var str = document.frmuser.phone.value;
    var startingmobno = str.charAt(0);
	
	var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
    var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
	var alphanumbericExp = /^[a-zA-Z0-9]+$/; //Variable to validate only alphabets and space
	var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
	var errmsg = 0;
	document.getElementById("idusrtyp").innerHTML = "";
	document.getElementById("idlgid").innerHTML  ="";
	document.getElementById("idnm").innerHTML = "";
	document.getElementById("idmob").innerHTML ="";
	document.getElementById("idadd").innerHTML ="";			
	document.getElementById("idsts").innerHTML = "";
	
	
	if(document.frmuser.usertype.value =="")
	{
		document.getElementById("idusrtyp").innerHTML ="<font color='red'>Please select user type.</font>";
		errmsg=1;
	}
	if(document.frmuser.loginid.value =="")
	{
		document.getElementById("idlgid").innerHTML ="<font color='red'>Please enter login ID.</font>";
		errmsg=1;
	}	
	if(!document.frmuser.name.value.match(alphaspaceExp))
	{
		document.getElementById("idname").innerHTML ="<font color='red'>Enter only alphabets.</font>";
		errmsg=1;
	}
	if(document.frmuser.name.value =="")
	{
		document.getElementById("idnm").innerHTML ="<font color='red'>Please enter your name.</font>";
		errmsg=1;
	}
	if(document.frmuser.phone.value.length != 10)  
	{
		document.getElementById("idmob").innerHTML ="<font color='red'>Kindly enter 10 digit mobile number.</font>";
		errmsg=1;
	}
	if(startingmobno!= 7)	
	{
		if(startingmobno != 8)
		{
			if(startingmobno!= 9)		
			{
		document.getElementById("idmob").innerHTML ="<font color='red'>Mobile number should start with 7 or 8 or 9</font><br>";
		errmsg=1;
			}
		}
	}
	if(!document.frmuser.phone.value.match(numericExpression)) 
	{
		document.getElementById("idmob").innerHTML ="<font color='red'>Enter only numeric values.</font>";
		errmsg=1;
	}
	if(document.frmuser.phone.value =="")  
	{
		document.getElementById("idmob").innerHTML ="<font color='red'>Please enter your mobile number.</font>";
		errmsg=1;
	}
	if(document.frmuser.address.value =="")
	{
		document.getElementById("idadd").innerHTML ="<font color='red'>Please enter your address.</font>";
		errmsg=1;
	}	
	if(document.frmuser.status.value =="")
	{
		document.getElementById("idsts").innerHTML ="<font color='red'>Please select status.</font>";
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