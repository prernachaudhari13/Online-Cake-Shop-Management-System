<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM billing_records WHERE billing_record_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(!qsql)
	{
		echo mysqli_error($con);
	}
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Billing record deleted successfully.');</script>";
	}
}
?>
<!-- contact section -->
<section id="contact" class="parallax-section" style="background-color:#CCF">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-10 col-sm-12 text-center">
				<h1 class="heading">Item Cart</h1>
				<hr>
			</div>
             <div class="col-md-offset-1 col-md-10 col-sm-11 wow fadeIn" data-wow-delay="0.9s">
<?php
include("datatables.php");
?>
<table   class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th width="40" scope="col">Image</th>
    <th width="40" scope="col">Item Name</th>
    <th width="40" scope="col">Weight</th>
    <th width="33" scope="col">Item Cost</th>
    <th width="33" scope="col">Quantity</th>
    <th width="33" scope="col">Total Cost</th>
    <th width="34" scope="col">Action</th>
  </tr>
  </thead>
  <tbody>
  <?php
  $sql = "SELECT * FROM billing_records WHERE status='pending'";
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
			
			$weight=$rs[weight]-1;
			
			 $totkg = $weight * $rs[cost_per_kg];
			
			$totamt = $rsitem[item_cost] + $totkg;
			
			$totamt = $totamt + ($totamt * $taxpercentage/100);
			
			//$taxamt = ($taxpercentage * $rs[item_cost] ) /100;			
			//$item_cost = 	$taxamt   +  $rsitem[item_cost];
	  
	  		//$totamt = $rs[item_cost] + $taxamt;
	  $totamt = round($totamt);
  echo "<tr >
    <td>&nbsp;<img src='$imgname' width='50' height='50'></td>
    <td>$rsitem[item_name]<br><font color='red'>$rs[cakeshape] shape</font>
</td>
    <td>&nbsp;$rs[weight] KG</td>
    <td>&nbsp;₹ " . $totamt ."</td>
    <td>&nbsp;<input type='number' value='$rs[qty]'  style='width:50px;' onkeyup='changecost(`$rs[0]`,this.value,$totamt,$taxpercentage)' onchange='changecost(`$rs[0]`,this.value,$totamt,$taxpercentage)' ></td>
    <td>&nbsp;₹ <span id='totcost$rs[0]'>" .  $rs[qty]* $totamt . "</span></td>
    <td>&nbsp;<a href='cart.php?delid=$rs[billing_record_id]' onclick='return deleteconfirm();' >Delete</a></td>
  </tr>";
  }
  ?>
  </tbody>
</table>

			</div>
			<div class="col-md-12 col-sm-1" >
            <?php
			if(isset($_SESSION[cust_id]))
			{
			?>
                <form method="post" action="billing.php">
                <center><input type="submit" name="submit" value="Proceed to Checkout" ></center>
                </form>
            <?php
			}
			else
			{
			?>
            <center><input type="submit" name="submit" onClick="window.location='customerlogin.php';" value="Click here to Login" ></center>
            <?php
			}
			?>
            </div>
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
function changecost(cartid,qty,item_cost,taxpercentage)
{
	document.getElementById("totcost"+cartid).innerHTML = qty * item_cost ;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.open("GET","ajaxupdatecart.php?cartid="+cartid+"&qty="+qty,true);
        xmlhttp.send();
}
</script>