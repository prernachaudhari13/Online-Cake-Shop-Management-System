<?php
include("header.php");
if($_POST[randomid] == $_SESSION[randomid])
{
	if(isset($_POST[submit]))
	{
			$sql ="UPDATE customer SET cust_name='$_POST[name]',cust_addr='$_POST[address]',cust_contactno='$_POST[phone]',email_id='$_POST[email]',status='$_POST[status]' WHERE cust_id='$_SESSION[cust_id]'";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Customer record updated successfully.');</script>";
			}
	}
}
$_SESSION[randomid] = rand();
if(isset($_SESSION[cust_id]))
{
	$sqledit ="select * from customer WHERE cust_id='$_SESSION[cust_id]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
<!-- contact section -->
<section id="contact" class="parallax-section" style="background-image:url(images/051120081-01-chocolate-irish-whiskey-cake-recipe_xlg.jpg)">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-7 col-sm-7 text-center" style="color:#600">
				<h1 class="heading">Customer Profile</h1>
				<hr>
			</div>
			<div class="col-md-offset-1 col-md-8 col-sm-10 wow fadeIn" data-wow-delay="0.9s">
				<form action="" method="post" name="frmregister" onsubmit="return validateform()" >
                <input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>">
                    <div class="col-md-10 col-sm-10">
						<input name="name" type="text" class="form-control"  placeholder="Full Name" value="<?php echo $rsedit[cust_name]; ?>" >
                        <span id="idname" ></span>
					</div>
                    
                    <div class="col-md-10 col-sm-10">
						<textarea name="address" class="form-control" placeholder="Address"><?php echo $rsedit[cust_addr]; ?></textarea>
                        <span id="idaddress"></span>
					</div>
                    <div class="col-md-10 col-sm-10">
						<input name="phone" type="text" class="form-control" placeholder="Mobile Number" value="<?php echo $rsedit[cust_contactno]; ?>">
                        <span id="idphone"></span>
					</div>
                   <div class="col-md-10 col-sm-10">                
                        <input name="email" type="email" class="form-control" placeholder="Email ID" value="<?php echo $rsedit[email_id]; ?>" onchange="validateemail(this.value)" onkeyup="validateemail(this.value)" >
                        <input type="hidden" name="emailidchk" id="emailidchk" value="0"/>
                        <span id="idemail"></span>
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
	var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
    var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
	var alphanumbericExp = /^[a-zA-Z0-9]+$/; //Variable to validate only alphabets and numbers
	var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
	var errmsg = 0;
	document.getElementById("idname").innerHTML = "";
	document.getElementById("idaddress").innerHTML ="";
	document.getElementById("idphone").innerHTML ="";
	document.getElementById("idpassword").innerHTML ="";
	document.getElementById("idcpassword").innerHTML  ="";
	document.getElementById("idemail").innerHTML  ="";
	
	if(!document.frmregister.name.value.match(alphaspaceExp))
	{
		document.getElementById("idname").innerHTML ="<font color='red'>Please enter only alphabets.</font>";
		errmsg=1;
	}
	if(document.frmregister.name.value =="")
	{
		document.getElementById("idname").innerHTML ="<font color='red'>Please enter your name.</font>";
		errmsg=1;
	}
	if(document.frmregister.address.value =="")
	{
		document.getElementById("idaddress").innerHTML ="<font color='red'>Please enter your address.</font>";
		errmsg=1;
	}
	if(document.frmregister.phone.value.length != 10)  
	{
		document.getElementById("idphone").innerHTML ="<font color='red'>Kindly enter 10 digit mobile number.</font>";
		errmsg=1;
	}
	if(!document.frmregister.phone.value.match(numericExpression)) 
	{
		document.getElementById("idphone").innerHTML ="<font color='red'>Enter only numeric values.</font>";
		errmsg=1;
	}
	if(document.frmregister.phone.value =="")  
	{
		document.getElementById("idphone").innerHTML ="<font color='red'>Please enter your mobile number.</font>";
		errmsg=1;
	}
	if(document.frmregister.email.value =="")
	{
		document.getElementById("idemail").innerHTML ="<font color='red'>Please enter Email ID.</font>";
		errmsg=1;
	}
	if(document.frmregister.password.value.length < 6)  
	{
		document.getElementById("idpassword").innerHTML ="<font color='red'>Password should be atleast 6 characters. </font>";
		errmsg=1;
	}
	if(document.frmregister.password.value =="")
	{
		document.getElementById("idpassword").innerHTML ="<font color='red'>Please enter the password.</font>";
		errmsg=1;
	}
	if(document.frmregister.password.value != document.frmregister.cpassword.value)
	{
		document.getElementById("idcpassword").innerHTML ="<font color='red'>Password and confirm password are not matching.</font>";
		errmsg=1;
	}
	if(document.frmregister.cpassword.value =="")
	{
		document.getElementById("idcpassword").innerHTML ="<font color='red'>Please confirm your password.</font>";
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
function validateemail(emailid)
{
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("emailidchk").value = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxemailid.php?emailid="+emailid,true);
        xmlhttp.send();
}
</script>