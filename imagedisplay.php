<?php
include("header.php");
	if(!isset($_SESSION[user_id]))
	{
		echo "<script>window.location='userlogin.php';</script>";
	}
	//Coding to change image status
	if(isset($_GET[st]))	
	{
		echo $sql ="UPDATE image SET status='$_GET[st]' WHERE img_id='$_GET[img_id]'";
			mysqli_query($con,$sql);	
			echo mysqli_error($con);
			echo "<script>alert('Image status updated successfully...');</script>";
	}
	if(isset($_GET[defaultid]))
	{
			$sql ="UPDATE image SET img_type='' WHERE item_id='$_GET[item_id]'";
			$qsql = mysqli_query($con,$sql);

			$sql ="UPDATE image SET img_type='Default' WHERE img_id='$_GET[defaultid]'";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Image updated successfully.');</script>";
			}	
	}
	if(isset($_GET[delid]))
	{
		$sql = "DELETE FROM image WHERE img_id='$_GET[delid]'";
		$qsql = mysqli_query($con,$sql);
		if(!qsql)
		{
			echo mysqli_error($con);
		}
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Image deleted successfully.');</script>";
		}
	}
		if($_POST[randomid] == $_SESSION[randomid])
		{
			if(isset($_POST[submit]))
			{
				
				$img = rand() . $_FILES["imgpath"]["name"];
				move_uploaded_file($_FILES["imgpath"]["tmp_name"],"upload/" . $img);
				
				if(isset($_GET[editid]))
				{
					$sql ="UPDATE image SET item_id='$_GET[item_id]',status='$_POST[status]' WHERE img_id='$_GET[editid]'";
					$qsql = mysqli_query($con,$sql);
					if(!$qsql)
					{
						echo mysqli_error($con);
					}
					if(mysqli_affected_rows($con) == 1)
					{
						echo "<script>alert('Image record updated successfully.');</script>";
					}	
				}
				else
				{
				$sql ="INSERT INTO image(img_type,item_id,item_img,status) values('$_POST[imgtype]','$_GET[item_id]','$img','$_POST[status]')";
				$qsql = mysqli_query($con,$sql);
				if(!$qsql)
				{
					echo mysqli_error($con);
				}
				if(mysqli_affected_rows($con) == 1)
				{
					echo "<script>alert('Image is added successfully.');</script>";
				}
			}
		}
}
$_SESSION[randomid] = rand();
if(isset($_GET[editid]))
{
	$sqledit ="select * from image WHERE img_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>


<!-- contact section -->
<section id="contact" class="parallax-section" style="background-color:#CCF">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-8 col-sm-10 text-center">
				<h1 class="heading">Item Image</h1>
				<hr>
			</div>
			<div class="col-md-offset-1 col-md-10 col-sm-11 wow fadeIn" data-wow-delay="0.9s">
<div class="col-md-offset-1 col-md-10 col-sm-11 wow fadeIn" data-wow-delay="0.9s">
				<form action="" method="post" enctype="multipart/form-data" name="frmimgdsply" onsubmit="return validateform()" >
                <input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>">                                              		
                     <div class="col-md-10 col-sm-10">
						<input name="imgpath" type="file" class="form-control" placeholder="Image Path" value="<?php echo $rsedit[item_img]; ?>">
					<span id="idimgpath" ></span>
                    </div>  
                    <div class="col-md-10 col-sm-10">           
						<select name="status" class="form-control" placeholder="Status">
                        <option value="">Select Status</option>
                        <?php
						$arr = array("Active","Inactive");
						foreach($arr as $val)
						{						
							if($val == $rsedit[status])
							{
							echo "<option value='$val' selected>$val</option>";
							}
							else
							{
							echo "<option value='$val'>$val</option>";							
							}
						}
						?>
                        </select>
				  <span id="idsts" ></span>
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

<?php
include("datatables.php");
?>
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th width="89" scope="col">Item Image</th>
    <th width="45" scope="col">Status</th>
    <th width="107" scope="col">Action</th>
  </tr>
  </thead>
  <tbody>
   <?php
  $sql = "SELECT * FROM image WHERE  item_id='$_GET[item_id]'";
  $qsql = mysqli_query($con,$sql);
  while($rs = mysqli_fetch_array($qsql))
  {
	  $sqlimage = "SELECT * FROM  image where img_id='$rs[img_id]'";
	  $qsqlimage = mysqli_query($con,$sqlimage);
	  $rsimage = mysqli_fetch_array($qsqlimage);
	  
	  $sqlitem = "SELECT * FROM  item where item_id='$rs[item_id]'";
	  $qsqlitem = mysqli_query($con,$sqlitem);
	  $rsitem = mysqli_fetch_array($qsqlitem);
	  
  echo "<tr>
		<td>&nbsp;$rsimage[img_type]<br><img src='upload/$rs[item_img]' width='50'></td>
		<td>&nbsp;<strong>$rs[status]</strong> <br><a href='imagedisplay.php?img_id=$rs[img_id]&st=Active&item_id=$_GET[item_id]'>Activate</a> | <a href='imagedisplay.php?img_id=$rs[img_id]&st=Inactive&item_id=$_GET[item_id]'>Inactivate</a></td>
		<td>&nbsp;	
					<a href='imagedisplay.php?defaultid=$rs[img_id]&item_id=$_GET[item_id]'>Set default</a> | 
					<a href='imagedisplay.php?delid=$rs[img_id]&item_id=$_GET[item_id]' onclick='return deleteconfirm();' >Delete</a>
		</td>
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
function validateform()
{
	document.getElementById("idimgpath").innerHTML = "";
	document.getElementById("idsts").innerHTML ="";
	
	if(document.frmimgdsply.imgpath.value =="")
	{
		document.getElementById("idimgpath").innerHTML ="<font color='red'>Kindly upload an image.</font>";
		errmsg=1
	}
	if(document.frmimgdsply.status.value =="")
	{
		document.getElementById("idsts").innerHTML ="<font color='red'>Please select status.</font>";
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