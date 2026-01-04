<?php
include("header.php");
if(!isset($_SESSION[user_id]))
{
	echo "<script>window.location='userlogin.php';</script>";
}
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM item WHERE item_id='$_GET[delid]'";
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
			<div class="col-md-offset-1 col-md-8 col-sm-10 text-center">
				<h1 class="heading">View Item records</h1>
				<hr>
			</div>
			<div class="col-md-offset-1 col-md-11 col-sm-11 wow fadeIn" data-wow-delay="0.9s">
<?php
include("datatables.php");
?>
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th scope="col">Item Name</th>
    <th scope="col">Category</th>
    <th scope="col">Item Cost </th>
    <th scope="col">Extra cost/KG</th>
    <th scope="col">Status</th>
    <th scope="col">Images</th>
    <th scope="col">Active</th>
  </tr>
  </thead>
  <tbody>
   <?php
  $sql = "SELECT * FROM item WHERE item_type='Ready'";
  $qsql = mysqli_query($con,$sql);
  while($rs = mysqli_fetch_array($qsql))
  {
	  $sqlcategory = "SELECT * FROM  category where category_id='$rs[category_id]'";
	  $qsqlcategory = mysqli_query($con,$sqlcategory);
	  $rscategory = mysqli_fetch_array($qsqlcategory);
	  
	  $sqlimage = "SELECT * FROM  image where item_id='$rs[item_id]'";
	  $qsqlimage = mysqli_query($con,$sqlimage);
	  $rsimg = mysqli_fetch_array($qsqlimage);
	  		if(mysqli_num_rows($qsqlimage) ==0)
			{
				$imgname = 'images/default-thumbnail.jpg';
			}
			else
			{
				if (file_exists('upload/'.$rsimg[item_img])) 
				{
					$imgname = 'upload/'.$rsimg[item_img];
				}
				else
				{
					$imgname = 'images/default-thumbnail.jpg';
				}
			}
	  
  echo "<tr>
    <td>&nbsp;$rs[item_name]</td>
    <td>&nbsp;$rscategory[category_name]</td>
    <td>&nbsp;$rs[item_cost]</td>
    <td>&nbsp;$rs[cost_per_kg]</td>
    <td>&nbsp;$rs[status]</td>
    <td>&nbsp;";
	echo "<a href='imagedisplay.php?item_id=$rs[item_id]'>". mysqli_num_rows($qsqlimage) . " images</a>";
	echo "</td>
    <td>&nbsp; <a href='cakemenuinfo.php?itemid=$rs[item_id]&itemdet=true' target='_blank' >View</a>  | <a href='item.php?editid=$rs[item_id]'>Edit</a> | <a href='itemdisplay.php?delid=$rs[item_id]' onclick='return deleteconfirm();' >Delete</a></td>
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