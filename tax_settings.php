<?php
include("header.php");
if(!isset($_SESSION[user_id]))
{
	echo "<script>window.location='userlogin.php';</script>";
}
if($_POST[randomid] == $_SESSION[randomid])
{
	$sqledit ="select * from tax WHERE tax_id='1'";
	$qsqledit = mysqli_query($con,$sqledit);
		if(mysqli_num_rows($qsqledit) !=0)
		{
			$sql ="UPDATE tax SET tax_percentage='$_POST[taxper]',status='$_POST[status]' WHERE  tax_id='1'";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Tax record updated successfully.');</script>";
			}	
		}
		else
		{
			$sql ="INSERT INTO tax(tax_id,tax_percentage,status) values('1','$_POST[taxper]','$_POST[status]')";
		    $qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Tax record inserted successfully.');</script>";
			}
		}
}
$_SESSION[randomid] = rand();
	$sqledit ="select * from tax WHERE tax_id='1'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
?>
<!-- contact section -->
<section id="contact" class="parallax-section" style="background-color:#CCF">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-8 col-sm-7 text-center">
				<h1 class="heading">Tax Settings</h1>
				<hr>
			</div>
			<div class="col-md-offset-1 col-md-9 col-sm-11 wow fadeIn" data-wow-delay="0.9s">
				<form action="" method="post" name="frmtaxsettings" onsubmit="return validateform()">
                <input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>">
                    <div class="col-md-10 col-sm-10">
						<input name="taxper" type="text" class="form-control" placeholder="Tax Percentage" value="<?php echo $rsedit[tax_percentage]; ?>">
					 <span id="idtaxper" ></span>
                    </div>              
                    <div class="col-md-10 col-sm-10">                
						<select name="status" class="form-control" placeholder="Status">
                        <option value="">Select Status</option>
                        <?php
						$arr = array("Active","Inactive");
						foreach($arr as $val)
						{						
							if($val == $rsedit[status])
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
				  
                  <span id="idsts" ></span>
                  </div>
                 <div class="col-md-offset-3 col-md-5 col-sm-offset-1 col-sm-5">
						<input name="submit" type="submit" class="form-control" id="submit" value="<?php 
						if(isset($_GET[editid]))
						{
							echo "Update";
						}
						else
						{
							echo "Submit";
						}
						?>">
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
	document.getElementById("idtaxper").innerHTML = "";
	document.getElementById("idsts").innerHTML = "";
	
	if(document.frmtaxsettings.taxper.value =="")
	{
		document.getElementById("idtaxper").innerHTML ="<font color='red'>Please enter tax percentage.</font>";
		errmsg=1;
	}
	if(document.frmtaxsettings.status.value =="")
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