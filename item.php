<?php
include("header.php");
if(!isset($_SESSION['user_id']))
{
	echo "<script>window.location='userlogin.php';</script>";
}
//if($_POST['randomid'] == $_SESSION['randomid'])
{
	if(isset($_POST['submit']))
	{
		if(isset($_GET['editid']))
		{
			if($_GET['itemtype'] == "customized")
			{
				$ordtype = "customized";
			}
			else
			{
				$ordtype = "Ready";
			}
			$sql ="UPDATE item SET item_name='$_POST[itemnm]',item_type='$ordtype',item_description='$_POST[itemdes]',category_id='$_POST[cat]',item_cost='$_POST[itemcost]', cost_per_kg='$_POST[itemextracost]',status='$_POST[status]' WHERE item_id='$_GET[editid]'";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Item record updated successfully.');</script>";
			}
			if($_GET['itemtype'] == "customized") 
			{
					$msg = "
					<strong>Item name: $_POST[itemnm]</strong><br>Cost for this cake is : ₹ $_POST[itemcost] <br>Additional cost/kg : ₹ $_POST[itemextracost]<br>Click here to purchase item : <a onClick='window.open(`cakemenuinfo.php?itemid=$_GET[editid]`,`name`,`height=750,width=950`);' style='cursor:pointer'><strong>Click here to Place Order</strong></a>";
					
			
			$dttime = date("Y-m-d h:i:s");
			$sqlmessage = "SELECT * FROM message WHERE chatid='$_SESSION[chatid]' AND status='Active'";
			$qsqlmessage = mysqli_query($con,$sqlmessage);
			$rsmessage = mysqli_fetch_array($qsqlmessage);
			$countmsg =mysqli_num_rows($qsqlmessage);
			$msgid=$rsmessage[0];
					
				$chtmsg =	mysqli_real_escape_string($con,$msg);
				$sql = "INSERT INTO message_reply(message_id,cust_id,user_id,message_reply_text,date_time,msg_type,item_id) VALUES('$_GET[messageid]','$_GET[custid]','$_SESSION[user_id]','$chtmsg','$dttime','Staff','0')";
				$qsql = mysqli_query($con,$sql);
				echo mysqli_error($con);
			}
		}
		else
		{
			$sql ="INSERT INTO item(item_name,item_type,item_description,category_id,item_cost,status,cost_per_kg) values('$_POST[itemnm]','Ready','$_POST[itemdes]','$_POST[cat]','$_POST[itemcost]','Active','$_POST[itemextracost]')";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Item is added successfully.');</script>";
				echo "<script>window.location='item.php';</script>";
			}
		}
	}
}
//echo $_POST['randomid'];
$_SESSION['randomid'] = rand();
if(isset($_GET['editid']))
{
	$sqledit ="select * from item WHERE item_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
<!-- contact section -->
<section id="contact" class="parallax-section" style="background-color:#CCF">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-7 col-sm-9 text-center">
				<h1 class="heading">
                <?php 
						if(isset($_GET['editid']))
						{
							echo "Update";
						}
						else
						{
							echo "Add";
						}
						?> Item
                </h1>
				<hr>
			</div>
			<div class="col-md-offset-1 col-md-9 col-sm-11 wow fadeIn" data-wow-delay="0.9s">
				<form action="" method="post" name="frmitem" onsubmit="return validateform()">
                <input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>">
                 <div class="col-md-10 col-sm-10">
						<input name="itemnm" type="text" class="form-control" placeholder="Item Name" value="<?php echo $rsedit[item_name]; ?>">
					<span id="iditemname" ></span>
                    </div>                              
                     <div class="col-md-10 col-sm-10">
						<textarea name="itemdes" class="form-control" placeholder="Item Description"><?php echo $rsedit[item_description]; ?></textarea>
					<span id="iditmdes" ></span>
                    </div>
                
                <?php //itemtype=customized
				if($_GET[itemtype] != "customized")    
				{
				?>
                
                    <div class="col-md-10 col-sm-10">           
						<select name="cat" class="form-control" placeholder="Category">
                        <option value="">Select category</option>
                        <?php
						$sqlcategory = "SELECT * FROM category where status='Active'";
						$qsqlcategory = mysqli_query($con,$sqlcategory);
						while($rscategory = mysqli_fetch_array($qsqlcategory))
						{
							if($rscategory[category_id] == $rsedit[category_id])
							{
							echo "<option value='$rscategory[category_id]' selected>$rscategory[category_name]</option>";
							}
							else
							{
							echo "<option value='$rscategory[category_id]'>$rscategory[category_name]</option>";
							}
						}
						?>
                        </select>
				  <span id="idcategory" ></span>
                  </div>	
                <?php
				}
				?>
                     <div class="col-md-10 col-sm-10">
						<input name="itemcost" type="text" class="form-control" placeholder="Item Cost" value="<?php echo $rsedit[item_cost]; ?>">
					<span id="iditmcst" ></span>
                    </div>  		
                     <div class="col-md-10 col-sm-10">
						<input name="itemextracost" id="itemextracost" type="text" class="form-control" placeholder="Extra Cost per KG" value="<?php echo $rsedit[cost_per_kg]; ?>">
					<span id="iditmcst" ></span>
                    </div>  
                <?php
				if($_GET[itemtype] != "customized")    
				{
				?>    
                    
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
                  <?php
				}
				?>
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
	document.getElementById("iditemname").innerHTML = "";
	document.getElementById("iditmdes").innerHTML ="";
	document.getElementById("idcategory").innerHTML ="";
	document.getElementById("iditmcst").innerHTML ="";
	document.getElementById("idsts").innerHTML ="";
	
	if(document.frmitem.itemnm.value =="")
	{
		document.getElementById("iditemname").innerHTML ="<font color='red'>Please enter item name.</font>";
		errmsg=1;
	}
	if(document.frmitem.itemdes.value =="")
	{
		document.getElementById("iditmdes").innerHTML ="<font color='red'>Please enter item description.</font>";
		errmsg=1;
	}
	if(document.frmitem.cat.value =="")	
	{
		document.getElementById("idcategory").innerHTML ="<font color='red'>Please select category.</font>";
		errmsg=1;
	}
	if(document.frmitem.itemcost.value =="")  
	{
		document.getElementById("iditmcst").innerHTML ="<font color='red'>Please enter item cost.</font>";
		errmsg=1;
	}
	if(document.frmitem.status.value =="")  
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