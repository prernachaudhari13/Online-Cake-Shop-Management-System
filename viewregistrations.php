<?php
include("header.php");
if(!isset($_SESSION[user_id]))
{
	echo "<script>window.location='userlogin.php';</script>";
}
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM customer WHERE cust_id='$_GET[delid]'";
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
			<div class="col-md-offset-1 col-md-10 col-sm-10 text-center">
				<h1 class="heading">View Customers</h1>
				<hr>
			</div>
			<div class=" col-md-12 col-sm-12 wow fadeIn" data-wow-delay="0.9s">
<?php
include("datatables.php");
?>
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th scope="col">Customer name</th>
    <th scope="col">Customer Address</th>
    <th scope="col">Contact No.</th>
    <th scope="col">Email ID</th>
    <th scope="col">Status</th>
    <th scope="col">Action</th>
   <!-- <th scope="col">Promocode</th>-->
  </tr>
  </thead>
<tbody>  
  <?php
  $sql = "SELECT * FROM customer";
  $qsql = mysqli_query($con,$sql);
  while($rs = mysqli_fetch_array($qsql))
  {
  echo "<tr>
    <td>&nbsp;$rs[cust_name]</td>
    <td>&nbsp;$rs[cust_addr]</td>
    <td>&nbsp;$rs[cust_contactno]</td>
    <td>&nbsp;$rs[email_id]</td>
    <td>&nbsp;$rs[status]</td>
    <td>&nbsp;<a href='register.php?editid=$rs[cust_id]'>Edit</a>  | <a href='viewregistrations.php?delid=$rs[cust_id]' onclick='return deleteconfirm();' >Delete</a></td>
    <!--<td>&nbsp;<a href='sendpromocode.php?cust_id=$rs[0]'>Send</a></td>-->
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