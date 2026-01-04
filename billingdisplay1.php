<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM billing WHERE bill_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(!qsql)
	{
		echo mysqli_error($con);
	}
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Billing record deleted successfully.');</script>";
	}
}

if(isset($_GET[bildelveryid]))
{
	
	$sql = "UPDATE billing SET user_id='$_SESSION[user_id]', status='Delivered' WHERE bill_id='$_GET[bildelveryid]' ";
	$qsql = mysqli_query($con,$sql);
	if(!$qsql)
	{
		echo mysqli_error($con);
	}
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Item delivered successfully.');</script>";
	}
	$msgtext = "Dear LA COURONNE Customer, Your Order Number - " . $_GET[bill_no] ." delivered Successfully.. Thank you for ordering cake..";
?>
<iframe   style="visibility:hidden" src="https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=pJFlm0K8BU6bN7GBknSWIA&senderid=TESTIN&channel=1&DCS=0&flashsms=0&number=91<?php echo $_GET[cust_contactno]; ?>&text=<?php echo $msgtext; ?>&route=1" ></iframe>
<?php
}
?>

<!-- contact section -->
<section id="contact" class="parallax-section" style="background-color:#CCF">
		<div class="row">
			<div class="col-md-offset-1 col-md-10 col-sm-10 text-center">
				<h1 class="heading">Billing Records</h1>
				<hr>
			</div>
             <div class="col-md-offset-1 col-md-10 col-sm-11 wow fadeIn" data-wow-delay="0.9s">
<?php
include("datatables.php");
?>
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
   <!-- <th scope="col">Customer</th>-->
    <th scope="col">Bill No</th>
    <th scope="col">Bill date</th>
    <th scope="col">Delivery <br>date & time</th>
    <th scope="col">Sub total</th>
    <th scope="col">Tax Amount</th>
    <th scope="col">Discount</th>
    <th scope="col">Grand Total</th>
    <th scope="col">Status</th>
    <th scope="col">Info</th>
<?php
  if($_GET[billdate] == "today")
  {
?>    
    <th scope="col">Deliver</th>
<?php
  }
?>
<?php
		if($_SESSION[user_type] == "admin")
		{
?>			
    <th scope="col">Action</th>
<?php
		}
?>
  </tr>
  </thead>
  <tbody>
   <?php
  $sql = "SELECT * FROM billing WHERE status='Active' ";
  if($_GET[billdate] == "today")
  {
	  $sql  = $sql . " AND delivery_date='" . $dt . "'";
  }
  $sql = $sql . " ORDER BY bill_id DESC";
  $qsql = mysqli_query($con,$sql);
  while($rs = mysqli_fetch_array($qsql))
  { 
  
  	$sqlbilling ="select * from billing WHERE bill_id='$rs[0]'";
	$qsqlbilling = mysqli_query($con,$sqlbilling);
	$rsbilling = mysqli_fetch_array($qsqlbilling);
	
	
      $sqlcustomer = "SELECT * FROM  customer where cust_id='$rs[cust_id]'";
	  $qsqlcustomer = mysqli_query($con,$sqlcustomer);
	  $rscustomer = mysqli_fetch_array($qsqlcustomer);
	  
	  $sqluser = "SELECT * FROM  user where user_id='$rs[user_id]'";
	  $qsqluser = mysqli_query($con,$sqluser);
	  $rsuser = mysqli_fetch_array($qsqluser);
	  
	  $sqltax = "SELECT * FROM  tax where tax_id='$rs[tax_id]'";
	  $qsqltax = mysqli_query($con,$sqltax);
	  $rstax = mysqli_fetch_array($qsqltax);
	  
	  $sqlpromocode = "SELECT * FROM  promocode where promocode_id='$rs[promocode_id]'";
	  $qsqlpromocode = mysqli_query($con,$sqlpromocode);
	  $rspromocode = mysqli_fetch_array($qsqlpromocode);
	  
//#########################################################################################################################################
  $sql1 = "SELECT * FROM billing_records WHERE bill_id='$rs[0]'";
  $qsql1 = mysqli_query($con,$sql1);
  while($rs1 = mysqli_fetch_array($qsql1))
  {
	  $sqlcustomer = "SELECT * FROM  customer where cust_id='$rs1[cust_id]'";
	  $qsqlcustomer = mysqli_query($con,$sqlcustomer);
	  $rscustomer = mysqli_fetch_array($qsqlcustomer);
	  
	  $sqlitem = "SELECT * FROM  item where item_id='$rs1[item_id]'";
	  $qsqlitem = mysqli_query($con,$sqlitem);
	  $rsitem = mysqli_fetch_array($qsqlitem);
	  
	  $sqlimage = "SELECT * FROM  image where item_id='$rsitem[item_id]' AND img_type='Default'";
	  $qsqlimage = mysqli_query($con,$sqlimage);
	  $rsitemimage = mysqli_fetch_array($qsqlimage);

		$weight=$rs1[weight]-1;
		$totkg = $weight * $rs1[cost_per_kg];
		$totamt = $rsitem[item_cost] + $totkg;
		$totalamt = $totalamt + ($totamt * $rs1[qty]);
	//$totamt =  $rs1[item_cost] * $rs1[qty] ;
  	//$totalamt = $totamt + $totalamt;
  }
	 $taxamt = ($rsbilling[tax_amt] *$totalamt) / 100;

$discamt=0;
  if($rsbilling[promocode] != "")
			{
?>
<?php 
		if($rsbilling[promocode_type] == "Percentage discount")
		{
			 $discamt = ($rsbilling[discount] * ($totalamt +$taxamt )) / 100;
		}
		if($rsbilling[promocode_type] == "Flat discount")
		{ 	
			$discamt = $rsbilling[discount];		
		}
		?>
<?php				
			}
?>
	<?php  $totalcost = $taxamt  + $totalamt - $discamt;

//###########################################################################################################################################
	  
	  
	  echo"<tr>
   <!-- <td>&nbsp;$rscustomer[cust_name]</td>-->
    <td>&nbsp;$rs[bill_no]</td>
    <td>&nbsp;$rs[bill_date]</td>
    <td>&nbsp;$rs[delivery_date] &nbsp;$rs[delivery_time]</td>
    <td>&nbsp;₹ $totalamt</td>
    <td>&nbsp;₹ $taxamt ($rsbilling[tax_amt]%)</td>
    <td>&nbsp;₹ $discamt</td>
    <td>&nbsp;₹ $totalcost</td>
    <td>&nbsp;$rs[status]</td>
	<td><a href='billingreceipt.php?billid=$rs[bill_id]' >More</a></td>";
	  if($_GET[billdate] == "today")
  		{
    echo "<td>&nbsp;<a href='billingdisplay.php?bildelveryid=$rs[bill_id]&billdate=today&cust_contactno=$rscustomer[cust_contactno]&bill_no=$rs[bill_no]' >Delivered</a></td>";
		}
		if($_SESSION[user_type] == "admin")
		{
    echo "<td>&nbsp;<a href='billingdisplay.php?delid=$rs[bill_id]' onclick='return deleteconfirm();' >Delete</a></td>";
		}
  echo "</tr>";
  }
  ?>
  </tbody>
</table>
			</div>
			<div class="col-md-2 col-sm-1"></div>
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