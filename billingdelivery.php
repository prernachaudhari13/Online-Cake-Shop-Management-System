<?php
include("header.php");
if($_POST[randomid] == $_SESSION[randomid])
{
	if(isset($_POST[submit]))
	{
		if(isset($_GET[editid]))
		{
			$sql ="UPDATE billing SET cust_id='$_POST[cust]',user_id='$_POST[user]',bill_no='$_POST[billno]',bill_date='$_POST[billdate]',delivery_date='$_POST[deldate]',delivery_time='$_POST[deltime]',other_charges='$_POST[othrchrg]',tax_id='$_POST[tax]',promocode_id='$_POST[promocode]',discount='$_POST[discount]',message='$_POST[message]',note='$_POST[note]',status='$_POST[status]' WHERE bill_id='$_GET[editid]'";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Billing record updated successfully.');</script>";
			}	
		}
		else
		{
			 $sql ="INSERT INTO billing(cust_id,user_id,bill_no,bill_date,delivery_date,delivery_time,other_charges,tax_id,promocode_id,discount,message,note,status) values('$_POST[cust]','$_POST[user]','$_POST[billno]','$_POST[billdate]','$_POST[deldate]','$_POST[deltime]','$_POST[othrchrg]','$_POST[tax]','$_POST[promocode]','$_POST[discount]','$_POST[message]','$_POST[note]','$_POST[status]')";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Billing record inserted successfully.');</script>";
			}
		}
	}
}
$_SESSION[randomid] = rand();
if(isset($_GET[editid]))
{
	$sqledit ="select * from billing WHERE bill_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>

<!-- contact section -->

<section id="contact" class="parallax-section" style="background-color:#CCF">
  <div class="container">
    <div class="row">
      <div class="col-md-offset-1 col-md-8 col-sm-10 text-center">
        <h1 class="heading">Billing</h1>
        <hr>
      </div>
      
<?php
include("datatables.php");
?>
<table   class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th width="40" scope="col">Image</th>
    <th width="40" scope="col">Item Name</th>
    <th width="33" scope="col">Item Cost</th>
    <th width="33" scope="col">Quantity</th>
    <th width="33" scope="col">Total Cost</th>
    <th width="34" scope="col">Action</th>
  </tr>
  </thead>
  <tbody>
  <?php
  $sql = "SELECT * FROM billing_records";
  $qsql = mysqli_query($con,$sql);
  while($rs = mysqli_fetch_array($qsql))
  {
	  $sqlcustomer = "SELECT * FROM  customer where cust_id='$rs[cust_id]'";
	  $qsqlcustomer = mysqli_query($con,$sqlcustomer);
	  $rscustomer = mysqli_fetch_array($qsqlcustomer);
	  
	  $sqlitem = "SELECT * FROM  item where item_id='$rs[item_id]'";
	  $qsqlitem = mysqli_query($con,$sqlitem);
	  $rsitem = mysqli_fetch_array($qsqlitem);
	  
	  $sqlimage = "SELECT * FROM  image where item_id='$rsitem[item_id]' AND img_type='Default'";
	  $qsqlimage = mysqli_query($con,$sqlimage);
	  $rsitemimage = mysqli_fetch_array($qsqlimage);
	    	if(mysqli_num_rows($qsqlimage) ==0)
			{
				$imgname = 'images/default-thumbnail.jpg';
			}
			else
			{
				if (file_exists('upload/'.$rsitemimage[item_img])) 
				{
					$imgname = 'upload/'.$rsitemimage[item_img];
				}
				else
				{
					$imgname = 'images/default-thumbnail.jpg';
				}
			}
	  
  echo "<tr>
    <td>&nbsp;<img src='$imgname' width='50' height='50'></td>
    <td>&nbsp;$rsitem[item_name]</td>
    <td>&nbsp;Rs.$rs[item_cost]</td>
    <td>&nbsp; $rs[qty]</td>
    <td>&nbsp;Rs. <span id='totcost$rs[0]'>" . $rs[item_cost] * $rs[qty] . "</span></td>
    <td>&nbsp;<a href='cart.php?delid=$rs[billing_record_id]' onclick='return deleteconfirm();' >Delete</a></td>
  </tr>";
  }
  ?>
  </tbody>
</table>

      
      <div class="col-md-offset-1 col-md-10 col-sm-11 wow fadeIn" data-wow-delay="0.9s">
        <form action="" method="post" name="frmbilling" onsubmit="return validateform()">
          <input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>">

          <div class="col-md-10 col-sm-10">
            <select name="user" class="form-control"  placeholder="User">
             <option value="">Select User</option>
                        <?php
						$sqluser = "SELECT * FROM user where status='Active'";
						$qsqluser = mysqli_query($con,$sqluser);
						while($rsuser = mysqli_fetch_array($qsqluser))
						{
							if($rsuser[user_id] == $rsedit[user_id])
							{
							echo "<option value='$rsuser[user_id]' selected>$rsuser[name]</option>";
							}
							else
							{
							echo "<option value='$rsuser[user_id]'>$rsuser[name]</option>";
							}
						}
						?>
                        </select>
          <span id="idusr" ></span>
          </div>
          <div class="col-md-10 col-sm-10">
            <input name="billno" type="text" class="form-control" placeholder="Bill Number" value="<?php echo $rsedit[bill_no]; ?>">
          <span id="idbilno" ></span>
          </div>
          <div class="col-md-10 col-sm-10">
            <input name="billdate" type="date" class="form-control" placeholder="Bill Date" value="<?php echo $rsedit[bill_date]; ?>">
            <span id="idbildate" ></span>
          </div>
          <div class="col-md-10 col-sm-10">
            <input name="deldate" type="date" class="form-control" placeholder="Delivery Date" value="<?php echo $rsedit[delivery_date]; ?>">
          <span id="iddeldte" ></span>
          </div>
          <div class="col-md-10 col-sm-10">
            <input name="deltime" type="time" class="form-control" placeholder="Delivery Time" value="<?php echo $rsedit[delivery_time]; ?>">
          <span id="iddeltym" ></span>
          </div>
          <div class="col-md-10 col-sm-10">
            <input name="othrcharg" type="text" class="form-control" placeholder="Other Charges" value="<?php echo $rsedit[other_charges]; ?>">
          <span id="idothrchrg" ></span>
          </div>
          <div class="col-md-10 col-sm-10">
            <select name="tax" class="form-control"  placeholder="Tax">
             <option value="">Select Tax</option>
                        <?php
						$sqltax = "SELECT * FROM tax where status='Active'";
						$qsqltax = mysqli_query($con,$sqltax);
						while($rstax = mysqli_fetch_array($qsqltax))
						{
							if($rstax[tax_id] == $rsedit[tax_id])
							{
							echo "<option value='$rstax[tax_id]' selected>$rstax[tax_percentage]</option>";
							}
							else
							{
							echo "<option value='$rstax[tax_id]'>$rstax[tax_percentage]</option>";
							}
						}
						?>
                        </select>
          <span id="idtx" ></span>
          </div>
          <div class="col-md-10 col-sm-10">
            <select name="promocode" class="form-control"  placeholder="Promo Code">
              <option value="">Select Promo Code</option>
                        <?php
						$sqlpromocode = "SELECT * FROM promocode where status='Active'";
						$qsqlpromocode = mysqli_query($con,$sqlpromocode);
						while($rspromocode = mysqli_fetch_array($qsqlpromocode))
						{
							if($rspromocode[promocode_id] == $rsedit[promocode_id])
							{
							echo "<option value='$rspromocode[promocode_id]' selected>$rspromocode[promocode]</option>";
							}
							else
							{
							echo "<option value='$rspromocode[promocode_id]'>$rspromocode[promocode]</option>";
							}
						}
						?>
                        </select>
          <span id="idpromocd" ></span>
          </div>
          <div class="col-md-10 col-sm-10">
            <input name="discount" type="text" class="form-control" placeholder="Discount" value="<?php echo $rsedit[discount]; ?>">
          <span id="iddisc" ></span>
          </div>
          <div class="col-md-10 col-sm-10">
            <textarea name="message" class="form-control" placeholder="Message"><?php echo $rsedit[message]; ?></textarea>
          <span id="idmsg" ></span>
          </div>
          <div class="col-md-10 col-sm-10">
            <textarea name="note" class="form-control" placeholder="Note"><?php echo $rsedit[note]; ?></textarea>          
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
	document.getElementById("idbilno").innerHTML = "";
	document.getElementById("idbildate").innerHTML ="";
	document.getElementById("iddeldte").innerHTML ="";
	document.getElementById("iddeltym").innerHTML ="";
	document.getElementById("idothrchrg").innerHTML  ="";
	document.getElementById("iddisc").innerHTML  ="";
	document.getElementById("idmsg").innerHTML  ="";	
	document.getElementById("idcustomer").innerHTML  ="";
	document.getElementById("idusr").innerHTML  ="";
	document.getElementById("idtx").innerHTML  ="";
	document.getElementById("idpromocd").innerHTML  ="";
	document.getElementById("idsts").innerHTML  ="";
	
	if(document.frmbilling.cust.value =="")
	{
		document.getElementById("idcustomer").innerHTML ="<font color='red'>Please select customer.</font>";
		errmsg=1;
	}
	if(document.frmbilling.user.value =="")
	{
		document.getElementById("idusr").innerHTML ="<font color='red'>Please select user.</font>";
		errmsg=1;
	}
	if(document.frmbilling.billno.value =="")	
	{
		document.getElementById("idbilno").innerHTML ="<font color='red'>Please enter bill number.</font>";
		errmsg=1;
	}
	if(document.frmbilling.billdate.value =="")  
	{
		document.getElementById("idbildate").innerHTML ="<font color='red'>Please enter bill date.</font>";
		errmsg=1;
	}
	if(document.frmbilling.deldate.value =="")
	{
		document.getElementById("iddeldte").innerHTML ="<font color='red'>Please enter delivery date.</font>";
		errmsg=1;
	}
	if(document.frmbilling.deltime.value =="")
	{
		document.getElementById("iddeltym").innerHTML ="<font color='red'>Please enter delivery time.</font>";
		errmsg=1;
	}
	if(document.frmbilling.othrcharg.value =="")  
	{
		document.getElementById("idothrchrg").innerHTML ="<font color='red'>Please enter other charges.</font>";
		errmsg=1;
	}
	if(document.frmbilling.tax.value =="")
	{
		document.getElementById("idtx").innerHTML ="<font color='red'>Please select tax.</font>";
		errmsg=1;
	}
	if(document.frmbilling.promocode.value =="")
	{
		document.getElementById("idpromocd").innerHTML ="<font color='red'>Please select promo code.</font>";
		errmsg=1;
	}
	if(document.frmbilling.discount.value =="")
	{
		document.getElementById("iddisc").innerHTML ="<font color='red'>Please enter discount.</font>";
		errmsg=1;
	}
	if(document.frmbilling.message.value =="")
	{
		document.getElementById("idmsg").innerHTML ="<font color='red'>Please type message.</font>";
		errmsg=1;
	}
	if(document.frmbilling.status.value =="")
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