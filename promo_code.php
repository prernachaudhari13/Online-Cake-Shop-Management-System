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
		if(isset($_GET[editid]))
		{
			$sql ="UPDATE promocode SET promocode='$_POST[promocode]',promocode_type='$_POST[pctype]',disc_perc='$_POST[disper]',disc_amt='$_POST[disamt]',expiry_date='$_POST[expdate]',no_of_qty='$_POST[expdate]',status='$_POST[status]' WHERE promocode_id='$_GET[editid]'";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Promo code record updated successfully.');</script>";
			}	
		}
		else
		{
			$sql ="INSERT INTO promocode(promocode,promocode_type,disc_perc,disc_amt,expiry_date,no_of_qty,status) values('$_POST[promocode]','$_POST[pctype]','$_POST[disper]','$_POST[disamt]','$_POST[expdate]','$_POST[nofqty]','$_POST[status]')";
		    $qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				/*
				include("sendmail.php");
				$msg = "Dear LA COURONNE Customer, Here is the promocode for discount: " . $_POST[promocode] . " Apply promocode and Enjoy shopping.."  ;
				$sql = "SELECT * FROM customer";
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
					sendmail($rs[email_id],"Promocode from LA COURONNE",$msg,$rs[cust_name]);
				}
				*/
				echo "<script>alert('Promo code record inserted successfully.');</script>";
			}
		}
	}
}
$_SESSION[randomid] = rand();
if(isset($_GET[editid]))
{
	$sqledit ="select * from promocode WHERE promocode_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>



<!-- contact section -->
<section id="contact" class="parallax-section" style="background-color:#CCF">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-7 col-sm-9 text-center">
				<h1 class="heading">Promo Code</h1>
				<hr>
			</div>
			<div class="col-md-offset-1 col-md-9 col-sm-11 wow fadeIn" data-wow-delay="0.9s">
				<form action="" method="post" name="frmpromocode" onsubmit="return validateform()">
                 <input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>">
                 <div class="col-md-10 col-sm-10">
						<input name="promocode" type="text" class="form-control" placeholder="Promo Code" value="<?php echo $rsedit[promocode]; ?>">
					<span id="idpm" ></span>
                    </div>
                    <div class="col-md-10 col-sm-10">
					   <select name="pctype" id="pctype" class="form-control"  placeholder="Promocode Type" onChange="calcdiscamt()">
                       <option value="">Select Promocode Type</option>
                        <?php
						$arr = array("Flat discount","Percentage discount");
						foreach($arr as $val)
						{						
							if($val == $rsedit[promocode_type])
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
                    <span id="idpctyp" ></span>
					</div>
                    <div class="col-md-10 col-sm-10">
						<input name="disper" id="disper" type="text" class="form-control" placeholder="Discount Percentage" value="<?php echo $rsedit[disc_perc]; ?>" disabled>
					<span id="iddiscper" ></span>
                    </div>
                    <div class="col-md-10 col-sm-10">
						<input name="disamt" id="disamt" type="text" class="form-control" placeholder="Discount Amount" value="<?php echo $rsedit[disc_amt]; ?>" disabled>
					<span id="iddiscamt" ></span>
                    </div>
                    <div class="col-md-10 col-sm-10">
						<input name="expdate" type="date" min="<?php echo date("Y-m-d"); ?>" class="form-control" placeholder="Expiry Date" value="<?php echo $rsedit[expiry_date]; ?>">
					<span id="idexprydate" ></span>
                    </div>
                    <div class="col-md-10 col-sm-10">
						<input name="nofqty" type="text" class="form-control" placeholder="Number of Quantity" value="<?php echo $rsedit[no_of_qty]; ?>">
					<span id="idnoqty" ></span>
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
					<div class="col-md-offset-3 col-md-4 col-sm-offset-3 col-sm-5">
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
	document.getElementById("idpm").innerHTML = "";
	document.getElementById("idpctyp").innerHTML ="";
	document.getElementById("iddiscper").innerHTML ="";
	document.getElementById("iddiscamt").innerHTML ="";
	document.getElementById("idexprydate").innerHTML  ="";
	document.getElementById("idnoqty").innerHTML  ="";
	document.getElementById("idsts").innerHTML  ="";
	
	if(document.frmpromocode.promocode.value =="")
	{
		document.getElementById("idpm").innerHTML ="<font color='red'>Please enter promocode.</font>";
		errmsg=1;
	}
	if(document.frmpromocode.pctype.value =="")
	{
		document.getElementById("idpctyp").innerHTML ="<font color='red'>Please select promocode type.</font>";
		errmsg=1;
	}


	if(document.getElementById("pctype").value == "Flat discount")
	{
			if(document.frmpromocode.disamt.value =="")  
			{
				document.getElementById("iddiscamt").innerHTML ="<font color='red'>Please enter discount amount.</font>";
				errmsg=1;
			}
	}
	if(document.getElementById("pctype").value == "Percentage discount")
	{
			if(document.frmpromocode.disper.value =="")  
			{
				document.getElementById("iddiscper").innerHTML ="<font color='red'>Please enter dicount percentage.</font>";
				errmsg=1;
			}
	}
		
		
	if(document.frmpromocode.expdate.value =="")
	{
		document.getElementById("idexprydate").innerHTML ="<font color='red'>Please enter expiry date.</font>";
		errmsg=1;
	}
	if(document.frmpromocode.nofqty.value =="")
	{
		document.getElementById("idnoqty").innerHTML ="<font color='red'>Please enter quantity.</font>";
		errmsg=1;
	}	
	if(document.frmpromocode.status.value =="")
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

              /*
                       <select name="pctype" class="form-control"  placeholder="Promocode Type">
                       <option value="">Select Promocode Type</option>
           
						$arr = array("Flat discount","Percentage discount");
						disper
						iddiscamt
						*/
function calcdiscamt()
{
	if(document.getElementById("pctype").value == "Flat discount")
	{
		document.getElementById("disper").disabled=true;
		document.getElementById("disamt").disabled=false;		
	}
	if(document.getElementById("pctype").value == "Percentage discount")
	{
		document.getElementById("disper").disabled=false;
		document.getElementById("disamt").disabled=true;	
	}
}
</script>