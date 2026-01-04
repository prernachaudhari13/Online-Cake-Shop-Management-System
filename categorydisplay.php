<?php
include("header.php");
if(!isset($_SESSION[user_id]))
{
	echo "<script>window.location='userlogin.php';</script>";
}
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM category WHERE category_id='$_GET[delid]'";
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
				<h1 class="heading">Category</h1>
				<hr>
			</div>
			<div class="col-md-offset-1 col-md-10 col-sm-11 wow fadeIn" data-wow-delay="0.9s">
<?php
include("datatables.php");
?>
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th scope="col">Icon</th>
    <th scope="col" style="width:200px;">Category Name</th>
    <th scope="col">Category Note</th>
    <th scope="col">Status</th>
    <th scope="col">Action</th>
  </tr>
  </thead>
  <tbody>
  <?php
  $sql = "SELECT * FROM category";
  $qsql = mysqli_query($con,$sql);
  while($rs = mysqli_fetch_array($qsql))
  {
  echo "<tr>
    <td>&nbsp;<img src='catimg/$rs[img]' width='50' height='50'></td>
    <td>&nbsp;$rs[category_name]</td>
    <td>&nbsp;$rs[category_note]</td>
    <td>&nbsp;$rs[status]</td>
    <td>&nbsp;<a href='category.php?editid=$rs[category_id]'>Edit</a> | <a href='categorydisplay.php?delid=$rs[category_id]' onclick='return deleteconfirm();' >Delete</a></td>
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