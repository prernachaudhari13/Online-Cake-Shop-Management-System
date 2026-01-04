<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM billing_records WHERE billing_record_id='$_GET[delid]'";
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
    <th width="26" scope="col">Customer</th>
    <th width="26" scope="col">Bill No.</th>
    <th width="26" scope="col">Bill date</th>
    <th width="40" scope="col">Item name</th>
    <th width="33" scope="col">Item Cost</th>
    <th width="33" scope="col">Quantity</th>
    <th width="33" scope="col">Total</th>
  </tr>
  </thead>
  <tbody>
  <?php
  $sql = "SELECT * FROM billing_records WHERE status='Active'";
  $qsql = mysqli_query($con,$sql);
  while($rs = mysqli_fetch_array($qsql))
  {
	  $sqlcustomer = "SELECT * FROM  customer where cust_id='$rs[cust_id]'";
	  $qsqlcustomer = mysqli_query($con,$sqlcustomer);
	  $rscustomer = mysqli_fetch_array($qsqlcustomer);
	  
	  $sqlitem = "SELECT * FROM  item where item_id='$rs[item_id]'";
	  $qsqlitem = mysqli_query($con,$sqlitem);
	  $rsitem = mysqli_fetch_array($qsqlitem);
	  
	$sqlbilling ="select * from billing WHERE bill_id='$rs[bill_id]'";
	$qsqlbilling = mysqli_query($con,$sqlbilling);
	$rsbilling = mysqli_fetch_array($qsqlbilling);
	  
	  $tot = $rs[item_cost] *$rs[qty];
  echo "<tr>
    <td>&nbsp;$rscustomer[cust_name]</td>
    <td>&nbsp;$rsbilling[bill_no]</td>
    <td>&nbsp;$rsbilling[bill_date]</td>
    <td>&nbsp;$rsitem[item_name]</td>
    <td>&nbsp;Rs. $rs[item_cost]</td>
    <td>&nbsp;$rs[qty]</td>
    <td>&nbsp;Rs. $tot</td>
  </tr>";
  }
  ?>
  </tbody>
</table>

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