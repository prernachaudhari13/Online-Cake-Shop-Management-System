<?php
session_start();
include("dbconnection.php");
if(isset($_GET[btnadd]))
{
	$sql = "INSERT INTO pincode(pincode,status) VALUES('$_GET[pincode]','$_GET[pincodestatus]')";	
	$qsql = mysqli_query($con,$sql);
}
if(isset($_GET[btnupd]))
{
	$sql = "UPDATE pincode SET status='$_GET[pincodestatus]' WHERE pincodeid='$_GET[pincodeid]'";	
	$qsql = mysqli_query($con,$sql);
}
if(isset($_GET[btndel]))
{
	 $sql = "DELETE FROM pincode WHERE pincodeid='$_GET[pincodeid]'";	
	$qsql = mysqli_query($con,$sql);	
	echo mysqli_error($con);
}
?>
<?php
$sql = "SELECT * FROM pincode";
$qsql = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($qsql))
{
	echo"<tr>
	   <td>&nbsp;$rs[pincode]</td>
	   <td>&nbsp;";
?>
	<select name="pincodestatus" onChange="uppincode('<?php echo $rs[0]; ?>',this.value)">
	<?php
	$arr = array("Active","Inactive");
	foreach($arr as $val)
	{
		if($val == $rs[status])
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
<?php		   
	   echo "</td>
	   <td>&nbsp;<a href='#' onclick='return deleteconfirm(`$rs[0]`)' >Delete</a></td>
</tr>";
}
?>