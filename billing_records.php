<?php
include("header.php");
if($_POST[randomid] == $_SESSION[randomid])
{
	if(isset($_POST[submit]))
	{
		if(isset($_GET[editid]))
		{
			$sql ="UPDATE billing_records SET cust_id='$_POST[cust]',item_id='$_POST[item]',item_cost='$_POST[itemcost]',qty='$_POST[qty]' WHERE billing_record_id='$_GET[editid]'";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Billing record updated successfully.');</script>";
			}	
		}
		else
		{
		$sql ="INSERT INTO billing_records (cust_id,item_id,item_cost,qty) values('$_POST[cust]','$_POST[item]','$_POST[itemcost]','$_POST[qty]')";
		$qsql = mysqli_query($con,$sql);
		if(!$qsql)
		{
			echo mysqli_error($con);
		}
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Billing record is inserted successfully.');</script>";
		}
	}
}
}
$_SESSION[randomid] = rand();
if(isset($_GET[editid]))
{
	$sqledit ="select * from billing_records WHERE billing_record_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>

<!-- contact section -->
<section id="contact" class="parallax-section" style="background-color:#CCF">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-8 col-sm-10 text-center">
				<h1 class="heading">Billing Records</h1>
				<hr>
			</div>
             <div class="col-md-offset-1 col-md-10 col-sm-11 wow fadeIn" data-wow-delay="0.9s">
				<form action="" method="post" name="frmbillingrecords" onsubmit="return validateform()">
                <input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>">
			<div class="col-md-10 col-sm-10">                
						<select name="cust" class="form-control"  placeholder="Customer">
              <option value="">Select Customer</option>
                        <?php
						$sqlcustomer = "SELECT * FROM customer where status='Active'";
						$qsqlcustomer = mysqli_query($con,$sqlcustomer);
						while($rscustomer = mysqli_fetch_array($qsqlcustomer))
						{
							if($rscustomer[cust_id] == $rsedit[cust_id])
							{
							echo "<option value='$rscustomer[cust_id]' selected>$rscustomer[cust_name]</option>";
							}
							else
							{
							echo "<option value='$rscustomer[cust_id]'>$rscustomer[cust_name]</option>";
							}
						}
						?>
                        </select>
				  <span id="idcustomer" ></span>
                  </div>
                  <div class="col-md-10 col-sm-10">                
						<select name="item" class="form-control" placeholder="Item">
                        <option value="">Select Item</option>
                        <?php
						$sqlitem = "SELECT * FROM item where status='Active'";
						$qsqlitem = mysqli_query($con,$sqlitem);
						while($rsitem = mysqli_fetch_array($qsqlitem))
						{
							if($rsitem[item_id] == $rsedit[item_id])
							{
							echo "<option value='$rsitem[item_id]' selected>$rsitem[item_name]</option>";
							}
							else
							{
							echo "<option value='$rsitem[item_id]'>$rsitem[item_name]</option>";
							}
						}
						?>
                        </select>
				  <span id="iditm" ></span>
                  </div>           
                    <div class="col-md-10 col-sm-10">
						<input name="itemcost" type="text" class="form-control" placeholder="Item Cost" value="<?php echo $rsedit[item_cost]; ?>">
					<span id="iditmcst" ></span>
                    </div>
                     <div class="col-md-10 col-sm-10">
						<input name="qty" type="text" class="form-control" placeholder="Quantity" value="<?php echo $rsedit[qty]; ?>">
					<span id="idquantity" ></span>
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
	document.getElementById("idcustomer").innerHTML = "";
	document.getElementById("iditm").innerHTML ="";
	document.getElementById("iditmcst").innerHTML ="";
	document.getElementById("idquantity").innerHTML ="";
	
	if(document.frmbillingrecords.cust.value =="")
	{
		document.getElementById("idcustomer").innerHTML ="<font color='red'>Please select customer.</font>";
		errmsg=1;
	}
	if(document.frmbillingrecords.item.value =="")
	{
		document.getElementById("iditm").innerHTML ="<font color='red'>Please select item.</font>";
		errmsg=1;
	}
	if(document.frmbillingrecords.itemcost.value =="")	
	{
		document.getElementById("iditmcst").innerHTML ="<font color='red'>Please enter item cost.</font>";
		errmsg=1;
	}
	if(document.frmbillingrecords.qty.value =="")  
	{
		document.getElementById("idquantity").innerHTML ="<font color='red'>Please enter quantity.</font>";
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