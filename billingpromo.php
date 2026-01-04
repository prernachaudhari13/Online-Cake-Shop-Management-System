<?php
session_start();
error_reporting(0);
$dt = date("Y-m-d");
include("dbconnection.php");

// Tax record
$sqltax = "SELECT * FROM tax WHERE tax_id='1'";
$qsqltax = mysqli_query($con,$sqltax);
$rstax = mysqli_fetch_array($qsqltax);
$taxpercentage = $rstax[tax_percentage];

	if(isset($_POST[btnpromosubmit]))
	{
		 $sqlpromocode = "SELECT * FROM promocode WHERE promocode='$_POST[promocode]' AND expiry_date>'$dt' AND status='Active'";
		$qsqlpromocode = mysqli_query($con,$sqlpromocode);
		$rspromocode = mysqli_fetch_array($qsqlpromocode);
		//echo "promo code". mysqli_num_rows($qsqlpromocode);
	}
?>        
        <div class="col-md-offset-1 col-md-12 col-sm-11 wow fadeIn" data-wow-delay="0.9s">  
            <?php
			if(mysqli_num_rows($qsqlpromocode) >=1)
			{
				?>
				
                <div class="col-md-10 col-sm-10">
                <center><strong style="color:#0B9E37;">Promocode successfully applied..</strong></center>
                <input type="hidden" name="promocodeno" value="<?php echo $rspromocode[promocode]; ?>" >

                <input type="hidden" name="promocodetype" value="<?php echo $rspromocode[promocode_type]; ?>" >
				<?php
				if($rspromocode[promocode_type] == "Percentage discount")
				{
				?>
                <input type="hidden" name="disc_amt" value="<?php echo $rspromocode[disc_perc]; ?>" >
                <?php
				}
				if($rspromocode[promocode_type] == "Flat discount")
				{
				?>
                <input type="hidden" name="disc_amt" value="<?php echo $rspromocode[disc_amt]; ?>" >
                <?php
				}
				?>
            </div>
                <?php
			}
			else
			{
					if(isset($_POST[btnpromosubmit]))
					{
			?>
            	<div class="col-md-10 col-sm-10">
                	<center><strong style="color:#C90844;">You have entered Invalid promocode..</strong></center><br>
            	</div>
                <?php
					}
				?>
            <div class="col-md-5 col-sm-5">
                <input name="promocode" id="promocode" type="text" class="form-control" placeholder="Enter Promocode here"  >
                <span id="iddisc" ></span>
            </div>
            <div class="col-md-5 col-sm-5">
                <input name="btnpromocode" type="submit" class="form-control" style="color:#600" placeholder="Enter Promocode here" value="Submit Promocode" onClick="validatepromocode(promocode.value);return false;" >
                <span id="iddisc" ></span>
            </div>
            <?php
			}
			?>
        </div>
      

          

  <input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>"> 
  
  
<table   class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr style="background-color:#D5AFB3">
    <th width="40" scope="col">Image</th>
    <th width="40" scope="col">Item Name</th>
    <th width="40" scope="col">Weight</th>
    <th width="33" scope="col">Item Cost</th>
    <th width="23" scope="col">Quantity</th>
    <th width="33" scope="col">Total</th>
  </tr>
  </thead>
  <tbody>
  <?php
  $totalamt=0;
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
	//$totamt = $totamt + ($totamt * $taxpercentage/100);
	//$totamt =  $totamt * $rs[qty] ;
  echo "<tr style='background-color:#F0E7E8'>
    <td>&nbsp;<img src='$imgname' width='50' height='50'></td>
    <td style='vertical-align:middle;'>$rsitem[item_name]
<br><font color='red'>$rs[cakeshape] shape</font></td>
    <td style='vertical-align:middle;'>&nbsp;$rs[weight] KG</td>
    <td style='text-align:right;'>&nbsp;₹ $totamt</td>
    <td style='text-align:center;'>&nbsp; $rs[qty]</td>
    <td style='text-align:right;'>&nbsp;₹ <span id='totcost$rs[0]'>" . $totamt * $rs[qty] . "</span></td>
  </tr>";
  	$totalamt = $totalamt + ($totamt * $rs[qty]);
  }
  ?>
  </tbody>
  
  <tfooter>
    
  <tr style="background-color:#FFFFFF">
    <th width="40" scope="col">&nbsp;</th>
    <th width="40" scope="col">&nbsp;</th>
    <th width="33" scope="col">&nbsp;</th>
    <th width="33" scope="col">&nbsp;</th>
    <th width="33" scope="col"  style="text-align:right;">Sub total</th>
    <th width="33" scope="col" style="text-align:right;">&nbsp;₹ <?php echo $totalamt; ?></th>
  </tr>
  
  <tr style="background-color:#FFFFFF">
    <th width="40" scope="col">&nbsp;</th>
    <th width="40" scope="col">&nbsp;</th>
    <th width="33" scope="col">&nbsp;</th>
    <th width="33" scope="col">&nbsp;</th>
    <th width="33" scope="col" style="text-align:right;">Tax amount (<?php echo $taxpercentage[tax_percentage]; ?>%)</th>
    <th width="33" scope="col" style="text-align:right;">&nbsp;₹ <?php 
	echo $taxamt = ($taxpercentage[tax_percentage] *$totalamt) / 100;
	?></th>
  </tr>
<?php
$discamt=0;
  if(mysqli_num_rows($qsqlpromocode) >=1)
			{
?>
    <tr style="background-color:#FFFFFF">
        <th width="40" scope="col">&nbsp;</th>
    <th width="33" scope="col">&nbsp;</th>
        <th width="40" scope="col">&nbsp;Promocode applied</th>
        <th width="33" scope="col">&nbsp;
        <?php
		echo "Promocode : " . $rspromocode[promocode];
		?>
        </th>
        <th width="33" scope="col" style="text-align:right;">Discount (<?php 
		if($rspromocode[promocode_type] == "Percentage discount")
		{
			echo $rspromocode[disc_perc] ."%"; 
			 $discamt = ($rspromocode[disc_perc] * ($totalamt +$taxamt )) / 100;
		}
		if($rspromocode[promocode_type] == "Flat discount")
		{
			echo "₹ ".$rspromocode[disc_amt] ; 	
			$discamt = $rspromocode[disc_amt];		
		}
		?>)</th>
        <th width="33" scope="col" style="text-align:right;">&nbsp;₹ <?php 
        echo   "-".$discamt;
        ?></th>
    </tr>
<?php				
			}
?>
  <tr style="background-color:#FFFFFF">
    <th width="40" scope="col">&nbsp;</th>
    <th width="40" scope="col">&nbsp;</th>
    <th width="33" scope="col">&nbsp;</th>
    <th width="33" scope="col">&nbsp;</th>
    <th width="33" scope="col" style="text-align:right;">Grand Total</th>
    <th width="33" scope="col" style="text-align:right;">&nbsp;₹ <?php echo $totalcost = $taxamt  + $totalamt - $discamt; ?></th>
  </tr>

  </tfooter>
</table>

<!-- <input type="text" name="totalcost" value="<?php echo $totalcost; ?>" > -->