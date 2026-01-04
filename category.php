<?php
session_start();
include("header.php");
if(!isset($_SESSION[user_id]))
{
	echo "<script>window.location='userlogin.php';</script>";
}
if($_POST[randomid] == $_SESSION[randomid])
{
	$imgname = rand().$_FILES["catimg"]["name"];
	move_uploaded_file($_FILES["catimg"]["tmp_name"],"catimg/".$imgname);
	if(isset($_POST[submit]))
	{
		if(isset($_GET[editid]))
		{
			$sql ="UPDATE category SET category_name='$_POST[catname]',category_note='$_POST[note]',status='$_POST[status]'";
			if($_FILES["catimg"]["name"] != "")
			{
			$sql = $sql . " ,img='$imgname' ";
			}
			$sql = $sql . " WHERE category_id='$_GET[editid]'";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Category record updated successfully.');</script>";
			}	
		}
		else
		{
			$sql ="INSERT INTO category(category_name,category_note,status,img) values('$_POST[catname]','$_POST[note]','$_POST[status]','$imgname')";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Category record inserted successfully.');</script>";
			}
		}
	}
}
$_SESSION[randomid] = rand();
if(isset($_GET[editid]))
{
	$sqledit ="select * from category WHERE category_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>


<!-- contact section -->
<section id="contact" class="parallax-section" style="background-color:#CCF">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-8 col-sm-10 text-center">
				<h1 class="heading">Category</h1>
				<hr>
			</div>
			<div class="col-md-offset-1 col-md-10 col-sm-11 wow fadeIn" data-wow-delay="0.9s">
				<form action="" method="post" name="frmcategory" onsubmit="return validateform()" enctype="multipart/form-data">
                <input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>">
                    <div class="col-md-10 col-sm-10">
						<input name="catname" type="text" class="form-control" placeholder="Category Name" value="<?php echo $rsedit[category_name]; ?>">
					    <span id="idcatnm" ></span>
                    </div>
                     <div class="col-md-10 col-sm-10">
						<textarea name="note" class="form-control" placeholder="Note"><?php echo $rsedit[category_note]; ?></textarea>         
					</div>
                    
                    <div class="col-md-10 col-sm-10">
						<input name="catimg" type="file" class="form-control" placeholder="Category image" >
                        <?php
						if($rsedit[img] != "")
						{
						echo "<img src='catimg/".$rsedit[img] . "' width='175' height='150'>";
						}
						?>
                        <span id="idcatimg" ></span>
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
			<div class="col-md-2 col-sm-1"></div>
		</div>
	</div>
</section>


<?php
include("footer.php");
?>
<script type="application/javascript">
function validateform()
{
	var errmsg = 0;
	document.getElementById("idcatnm").innerHTML = "";
	document.getElementById("idcatimg").innerHTML ="";
	document.getElementById("idsts").innerHTML ="";
		
	if(document.frmcategory.catname.value =="")
	{
		document.getElementById("idcatnm").innerHTML ="<font color='red'>Please enter category name.</font>";
		errmsg=1;
	}
	if(document.frmcategory.catimg.value =="")
	{
		document.getElementById("idcatimg").innerHTML ="<font color='red'>Kindly upload an image.</font>";
		errmsg=1;
    }
	if(document.frmcategory.status.value =="")
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