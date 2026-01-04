<?php
include("header.php");
if(!isset($_SESSION[user_id]))
{
	echo "<script>window.location='userlogin.php';</script>";
}
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM user WHERE user_id='$_GET[delid]'";
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
				<h1 class="heading">Add user</h1>
                <?php
include("datatables.php");
?>
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
				  <tr>
				    <th scope="col">User Type</th>
				    <th scope="col">Login ID</th>
				    <th scope="col">Name</th>
				    <th scope="col">Mobile No.</th>
				    <th scope="col">Address</th>
				    <th scope="col">Status</th>
				    <th scope="col">Action</th>
			      </tr>
                  </thead>
<tbody>  
  <?php
  $sql = "SELECT * FROM user";
  $qsql = mysqli_query($con,$sql);
  while($rs = mysqli_fetch_array($qsql))
  {
	  $sqluser = "SELECT * FROM  user where user_id='$rs[user_id]'";
	  $qsqluser = mysqli_query($con,$sqluser);
	  $rsuser = mysqli_fetch_array($qsqluser);
	  
		echo"<tr>
		   <td>&nbsp;$rsuser[user_type]</td>
		   <td>&nbsp;$rs[login_id]</td>
		   <td>&nbsp;$rs[name]</td>
		   <td>&nbsp;$rs[mob_no]</td>
		   <td>&nbsp;$rs[address]</td>
		   <td>&nbsp;$rs[status]</td>
		   <td>&nbsp;<a href='user.php?editid=$rs[user_id]'>Edit</a>  | <a href='userdisplay.php?delid=$rs[user_id]' onclick='return deleteconfirm();' >Delete</a></td>
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