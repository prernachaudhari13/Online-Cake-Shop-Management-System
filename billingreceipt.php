<?php
include("header.php");

$_SESSION[randomid] = rand();

	$sqlbilling ="select * from billing WHERE bill_id='$_GET[billid]'";
	$qsqlbilling = mysqli_query($con,$sqlbilling);
	$rsbilling = mysqli_fetch_array($qsqlbilling);

	$sqlcustomer ="select * from customer WHERE cust_id='$rsbilling[cust_id]'";
	$qsqlcustomer = mysqli_query($con,$sqlcustomer);
	$rscustomer = mysqli_fetch_array($qsqlcustomer);

?>

<!-- contact section -->

<section id="contact" class="parallax-section" style="background-color:#CCF">
  <div class="container">
    <div class="row">
      <div class="col-md-offset-1 col-md-10 col-sm-10 text-center">
        <h2 class="heading">Billing</h2>
        <hr>
      </div>
      
<?php
include("datatables.php");
?>  <form action="" method="post" name="frmbilling" onsubmit="return validateform()">
<?php
session_start();
error_reporting(0);
$dt = date("Y-m-d");
include("dbconnection.php");

?>     
<div id="divprintarea"   >
<table   class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
          <tr style="background-color:#F7EDEE">
            <th colspan="5" scope="col"><center><p style="color:#600;font-size:25px">Online Cake Shop</p></center></th>
            </tr>
          <tr style="background-color:#F7EDEE">
            <td colspan="2" scope="col"><strong>Delivery Address:</strong><br>
              <strong>
            <?php
            echo $rsbilling[name] . "</strong><br>"; 
            echo $rsbilling[deliv_address] . "<br>"; 	
            echo "<strong>PIN Code:</strong>".$rsbilling[pin_code] . "<br>"; 		 
            echo "<strong>Contact No.:</strong>".$rsbilling[mob_no] . "<br>";  
			?></td>
            <td scope="col">&nbsp;<?php
			echo "<strong style='color:red;'>Bill no. : " . $rsbilling[bill_no];
			echo "</strong><br><strong>Bill Date : </strong>" . $rsbilling[bill_date];
			echo "</strong><br><strong>Delivery date and Time : </strong>" . $rsbilling[delivery_date] ;
			echo "</strong><br><strong>Delivery Time : </strong>" . $rsbilling[delivery_time];
			
			?></td>
            <td colspan="3" scope="col">            
            <strong>Billing Address:</strong><br>
              <strong>
            <?php
            echo $rscustomer[cust_name] . "</strong><br>"; 
            echo $rscustomer[cust_addr] . "<br>"; 		 
            echo "<strong>Contact No.:</strong>".$rscustomer[cust_contactno] . "<br>";  
            echo "<strong>Email ID:</strong>".$rscustomer[email_id] . "<br>"; 	
			?>
            </td>
            </tr>
  	</thead>

</table>
  
  
<table   class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr style="background-color:#D5AFB3">
    <th width="40" scope="col">Item Name</th>
    <th width="33" scope="col">Weight</th>
    <th width="33" scope="col">Item Cost</th>
    <th width="33" scope="col">Quantity</th>
    <th width="33" scope="col">Total</th>
  </tr>
  </thead>
  <tbody>
  <?php
  $sql = "SELECT * FROM billing_records WHERE bill_id='$_GET[billid]'";
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
			
	//$totamt =  $rs[item_cost] * $rs[qty] ;
  echo "<tr style='background-color:#F0E7E8'>
    <td style='vertical-align:middle;'>$rsitem[item_name] <br><font color='red'>$rs[cakeshape] shape</font></td>
    <td style='text-align:right;'>&nbsp;$rs[weight] KG</td>
    <td style='text-align:right;'>&nbsp;₹ $totamt</td>
    <td style='text-align:center;'>&nbsp; $rs[qty]</td>
    <td style='text-align:right;'>&nbsp;₹ <span id='totcost$rs[0]'>" . $totamt * $rs[qty]. "</span></td>
  </tr>";
  	$totalamt = $totalamt + ($totamt * $rs[qty]);
  }
  ?>
  </tbody>
  
  <tfooter>
    
  <tr style="background-color:#FFFFFF">
    <th width="40" scope="col">&nbsp;</th>
    <th width="33" scope="col">&nbsp;</th>
    <th width="33" scope="col">&nbsp;</th>
    <th width="33" scope="col"  style="text-align:right;">Sub total</th>
    <th width="33" scope="col" style="text-align:right;">&nbsp;₹ <?php echo $totalamt; ?></th>
  </tr>
  
  <tr style="background-color:#FFFFFF">
    <th width="40" scope="col">&nbsp;</th>
    <th width="33" scope="col">&nbsp;</th>
    <th width="33" scope="col">&nbsp;</th>
    <th width="33" scope="col" style="text-align:right;">Tax amount (<?php echo $rsbilling[tax_amt]; ?>%)</th>
    <th width="33" scope="col" style="text-align:right;">&nbsp;₹ <?php 
	echo $taxamt = ($rsbilling[tax_amt] *$totalamt) / 100;
	?></th>
  </tr>
<?php
$discamt=0;
  if($rsbilling[promocode] != "")
			{
?>
    <tr style="background-color:#FFFFFF">
        <th width="40" scope="col">&nbsp;</th>
        <th width="40" scope="col">&nbsp;Promocode applied</th>
        <th width="33" scope="col">&nbsp;
        <?php
		echo "Promocode : " . $rsbilling[promocode];
		?>
        </th>
        <th width="33" scope="col" style="text-align:right;">Discount (<?php 
		if($rsbilling[promocode_type] == "Percentage discount")
		{
			echo $rsbilling[discount] ."%"; 
			 $discamt = ($rsbilling[discount] * ($totalamt +$taxamt )) / 100;
		}
		if($rsbilling[promocode_type] == "Flat discount")
		{
			echo "₹ ".$rsbilling[discount] ; 	
			$discamt = $rsbilling[discount];		
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
    <th width="33" scope="col">&nbsp;</th>
    <th width="33" scope="col">&nbsp;</th>
    <th width="33" scope="col" style="text-align:right;">Grand Total</th>
    <th width="33" scope="col" style="text-align:right;">&nbsp;₹ <?php echo $totalcost = $taxamt  + $totalamt - $discamt; ?></th>
  </tr>

  </tfooter>
</table>

<table   class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
          <tr style="background-color:#F7EDEE">
            <td colspan="3" scope="col"><strong>Message:</strong><br>
            <?php
            echo $rsbilling[message] ;
			?></>
            <td colspan="3" scope="col">
            <strong>Note:</strong><br>            
            <?php
			echo $rsbilling[note];
			?>
            </td>
            </tr>
  	</thead>

</table>

<?php
if($_GET[viewtype] == "Customized")
{
?>
<h2>Customized order details</h2>
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <tbody>
<?php
$sql = "SELECT * FROM message_reply INNER JOIN customer ON message_reply.cust_id =customer.cust_id  WHERE item_id!='0'";
$qsql = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($qsql))
{
	
	  	$sqlitem = "SELECT * FROM item WHERE item_id='$rs[item_id]'";
  		$qsqlitem = mysqli_query($con,$sqlitem);
		$rsitem = mysqli_fetch_array($qsqlitem);
		
		$sqlbilling_records = "SELECT * FROM billing_records INNER JOIN billing on billing.bill_id=billing_records.bill_id WHERE billing_records.item_id='$rs[item_id]'";
  		$qsqlbilling_records= mysqli_query($con,$sqlbilling_records);
		$rsbilling_records = mysqli_fetch_array($qsqlbilling_records);
	if($rsbilling_records[bill_id] == $_GET[billid])
	{
		
				
		echo "<tr>"	;
		echo "<th>Customer</th>
			<td>
		Name: $rs[cust_name]<br>
		Email ID: $rs[email_id]<br>
	Ph. No. $rs[cust_contactno]</td>";
		echo "</tr>";
		
		
		echo "<tr>"	;
		echo "<th >Title</th>
				<td >$rsitem[item_name]</td>";
		echo "</tr>";
		

		
		echo "<tr>"	;
		echo "<th >Images</th><td>";
	$sqlimage = "SELECT * FROM image WHERE  item_id='$rs[item_id]'";
	$qsqlimage = mysqli_query($con,$sqlimage);
	while($rsimage = mysqli_fetch_array($qsqlimage))
	  {
		 echo "<img src='upload/$rsimage[item_img]' width='600'>";
	  }
		echo "</td>";
		echo "</tr>";
		
		
		echo "<tr>"	;
		echo "<th >Description</th>
				<td >$rsitem[item_description]</td>";
		echo "</tr>";
	}
}
?>
  </tbody>
</table>
<?php
}
?>

<?php
if(isset($_SESSION[user_id]))
{
?>
    <table   class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
              <tr style="background-color:#F7EDEE">
                <td colspan="3" scope="col"><strong>Payment details:</strong><br>
                <?php
                echo  "<strong>Pay type: </strong>".$rsbilling[pay_type] ;
                ?><br>
                <?php
                echo  "<strong>Card number: </strong>".$rsbilling[card_number] ;
                ?><br>
                <?php
                echo  "<strong>Particulars: </strong>".$rsbilling[particulars] ;
                ?><br>
                </td>
                </tr>
        </thead>
    
    </table>
<?php
}
?>
<!-- <input type="text" name="totalcost" value="<?php echo $totalcost; ?>" > -->

      <div class="col-md-offset-1 col-md-12 col-sm-11 wow fadeIn" data-wow-delay="0.9s">  
        
          <div class="col-md-offset-3 col-md-4 col-sm-offset-3 col-sm-5">
            <input name="submit" type="button" class="form-control" id="submit" value="Print" onClick="PrintElem('divprintarea')" >
          </div>
      </div>
      
</div>      
      
      </form>
      
      
      
      <div class="col-md-2 col-sm-1"></div>
    </div>
  </div>
</section>
<?php
include("footer.php");
?>
<script type="application/javascript">
function PrintElem(elem)
    {
      var mywindow = window.open('', 'PRINT', 'height=800,width=900');


        mywindow.document.write('</head><body >');
      mywindow.document.write('<h1>' + document.title  + '</h1>');
        mywindow.document.write(document.getElementById(elem).innerHTML);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();

        return true;

        }
</script>