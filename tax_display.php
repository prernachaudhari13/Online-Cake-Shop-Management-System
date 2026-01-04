<?php
include("header.php");
if(!isset($_SESSION[user_id]))
{
	echo "<script>window.location='userlogin.php';</script>";
}
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM tax WHERE tax_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(!qsql)
	{
		echo mysqli_error($con);
	}
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Record deleted successfully..');</script>";
	}
}
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
<?php
include("datatables.php");
?>
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th width="90" scope="col">Tax Percentage</th>
    <th width="44" scope="col">Status</th>
    <th width="44" scope="col">Active</th>
  </tr>
</thead>
<tbody>  
  <?php
  $sql = "SELECT * FROM tax";
  $qsql = mysqli_query($con,$sql);
  while($rs = mysqli_fetch_array($qsql))
  {
  echo "<tr>
    <td>&nbsp;$rs[tax_percentage]</td>
    <td>&nbsp;$rs[status]</td>
    <td>&nbsp;<a href='tax_settings.php?editid=$rs[tax_id]'>Edit</a> | <a href='tax_display.php?delid=$rs[tax_id]' onclick='return deleteconfirm();' >Delete</a></td>
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