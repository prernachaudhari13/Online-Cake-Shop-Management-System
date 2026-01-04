<?php
include("header.php");
?>

<!-- contact section -->
<section id="contact" class="parallax-section" style="background-color:#CCF">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-8 col-sm-10 text-center">
				<h1 class="heading">View Customized order records</h1>
				<hr>
			</div>
			<div class="col-md-offset-1 col-md-10 col-sm-11 wow fadeIn" data-wow-delay="0.9s">
<?php
include("datatables.php");
?>
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th scope="col">Customer</th>
    <th scope="col">Images</th>
    <th scope="col">Item Name</th>
    <th scope="col">Item Description</th>
    <th scope="col">Delivery Date</th>
    <th scope="col">Action</th>
  </tr>
  </thead>
  <tbody>
<?php
$sql = "SELECT * FROM message_reply INNER JOIN customer ON message_reply.cust_id =customer.cust_id  WHERE item_id!='0'";
			if(isset($_SESSION[cust_id]))
			{
				$sql = $sql . " AND customer.cust_id='$_SESSION[cust_id]'";
			}
$qsql = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($qsql))
{
	
	  	$sqlitem = "SELECT * FROM item WHERE item_id='$rs[item_id]'";
  		$qsqlitem = mysqli_query($con,$sqlitem);
		$rsitem = mysqli_fetch_array($qsqlitem);
		
		$sqlbilling_records = "SELECT * FROM billing_records INNER JOIN billing on billing.bill_id=billing_records.bill_id WHERE billing_records.item_id='$rs[item_id]'";
  		$qsqlbilling_records= mysqli_query($con,$sqlbilling_records);
		$rsbilling_records = mysqli_fetch_array($qsqlbilling_records);
	
	echo "<tr>"	;
	echo "<td>$rs[cust_name]<br>$rs[email_id]<br>
Ph. No. $rs[cust_contactno]</td>";
	echo "<td>";
$sqlimage = "SELECT * FROM image WHERE  item_id='$rs[item_id]'";
$qsqlimage = mysqli_query($con,$sqlimage);
while($rsimage = mysqli_fetch_array($qsqlimage))
  {
	 echo "<img src='upload/$rsimage[item_img]' width='50' height='50'>";
  }
	echo "</td>";
	echo "<td>$rsitem[item_name]</td>";
	echo "<td>$rsitem[item_description]</td>";
	echo "<td>$rsbilling_records[delivery_date]</td>";
	echo "<td>";
	if(mysqli_num_rows($qsqlbilling_records) == 0 )
	{
		echo "Unprocessed";
	}
	else
	{
		echo "<a href='billingreceipt.php?billid=$rsbilling_records[bill_id]&viewtype=Customized'>View</a>";
	}
	echo "</td>";
	echo "<tr>"	;	
}
?>
  </tbody>
</table>
  
		  </div>
			<div class="col-md-2 col-sm-1"></div>
		</div>
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