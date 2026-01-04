<?php
include("header.php");
if(!isset($_SESSION[user_id]))
{
	echo "<script>window.location='userlogin.php';</script>";
}
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM promocode WHERE promocode_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(!qsql)
	{
		echo mysqli_error($con);
	}
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Record deleted successfully..');</script>";
	}
}?>



<!-- contact section -->
<section id="contact" class="parallax-section" style="background-color:#CCF">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-8 col-sm-10 text-center">
				<h1 class="heading">Promo Code</h1>
				<hr>
			</div>
			<div class="col-md-offset-1 col-md-10 col-sm-11 wow fadeIn" data-wow-delay="0.9s">
<?php
include("datatables.php");
?>
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th width="64" scope="col">Promo Code</th>
    <th width="84" scope="col">Promo Code Type</th>
    <th width="71" scope="col">Discount Percent</th>
    <th width="69" scope="col">Discount Amount</th>
    <th width="65" scope="col">Expiry Date</th>
    <th width="99" scope="col">Number Of Quantity</th>
    <th width="42" scope="col">Status</th>
    <th width="38" scope="col">Active</th>
  </tr>
  </thead>
<tbody>  
  <?php
  $sql = "SELECT * FROM promocode";
  $qsql = mysqli_query($con,$sql);
  while($rs = mysqli_fetch_array($qsql))
  {
	  $sqlpromocode = "SELECT * FROM  promocode where promocode_id='$rs[promocode_id]'";
	  $qsqlpromocode = mysqli_query($con,$sqlpromocode);
	  $rspromocode = mysqli_fetch_array($qsqlpromocode);
	  
  echo "<tr>
    <td>&nbsp;$rs[promocode]</td>
    <td>&nbsp;$rspromocode[promocode_type]</td>
    <td>&nbsp;$rs[disc_perc]</td>
    <td>&nbsp;$rs[disc_amt]</td>
    <td>&nbsp;$rs[expiry_date]</td>
    <td>&nbsp;$rs[no_of_qty]</td>
    <td>&nbsp;$rs[status]</td>
    <td>&nbsp;<a href='promo_code.php?editid=$rs[promocode_id]'>Edit</a> | <a href='promocode_display.php?delid=$rs[promocode_id]' onclick='return deleteconfirm();' >Delete</a></td>
  </tr>";
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