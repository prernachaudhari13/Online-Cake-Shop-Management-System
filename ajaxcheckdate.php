<?php
error_reporting(0);
$dt = date("Y-m-d");
if($_GET[deldate] == $dt)
{
	$newTime = date("H:i",strtotime(date("H:i")." +180 minutes"))
?>
<strong>Delivery time:</strong> <input id="deltime" name="deltime" min="<?php echo $newTime; ?>" type="time" class="form-control" placeholder="Delivery Time" >
<span id="iddeltime" ></span>
<?php
}
else
{
	echo "0";
}
?>