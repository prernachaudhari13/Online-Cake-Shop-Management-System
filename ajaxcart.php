<?php
session_start();
include("dbconnection.php");
// Tax record
$sqltax = "SELECT * FROM tax WHERE tax_id='1'";
$qsqltax = mysqli_query($con,$sqltax);
$rstax = mysqli_fetch_array($qsqltax);
$taxpercentage = $rstax[tax_percentage];

$sql = "SELECT * FROM item where item_id='$_GET[itemid]'";
$qsql = mysqli_query($con,$sql);
$rs=mysqli_fetch_array($qsql);
$taxamt = ($taxpercentage * $rs[item_cost] ) /100;
 
if($_GET[btncart] == "addtocart")
{
	$sqlcart ="INSERT INTO billing_records(cust_id,item_id,item_cost,qty,status,cakeshape,weight,cost_per_kg)values('$_SESSION[cust_id]','$_GET[itemid]','$rs[item_cost]','1','pending','$_GET[cakeshape]','$_GET[weight]','$_GET[cost_per_kg]') ";
	$qsqlcart = mysqli_query($con,$sqlcart);
	echo mysqli_error($con);
}
?>

<?php
$sqlbilling_records = "SELECT * FROM billing_records WHERE status='Pending' AND item_id='$_GET[itemid]'";
$qsqlbilling_records = mysqli_query($con,$sqlbilling_records);
if(mysqli_num_rows($qsqlbilling_records) >= 1)
{
	echo "<br>
<br><center><h4>Product added in the cart..</h4></center>";
	// echo "<br><br><center><img src='images/viewcart.jpg'  style='cursor:pointer;height:150px;' ></center>"; 
}
else
{
?>  
   <a onclick='addtocart(`<?php echo $rs[item_id]; ?>`,`<?php echo $rs[category_id]; ?>`,`addtocart`,cakeshape.value,weight.value,`<?php echo $rs[cost_per_kg]; ?>`)' ><img src="images/addtocart.jpg" alt="gallery img" style="cursor:pointer;"></a> 
<?php
}
?>
