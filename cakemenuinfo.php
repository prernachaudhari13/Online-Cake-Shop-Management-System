<?php
session_start();
error_reporting(0);
include("dbconnection.php");
// Tax record
$sqltax = "SELECT * FROM tax WHERE tax_id='1'";
$qsqltax = mysqli_query($con,$sqltax);
$rstax = mysqli_fetch_array($qsqltax);
$taxpercentage = $rstax[tax_percentage];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Online Cake Shop</title>

	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/nivo-lightbox.css">
	<link rel="stylesheet" href="css/nivo_themes/default/default.css">
	<link rel="stylesheet" href="css/style.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
    <script src="js/jquery.js"></script>
</head>
<body>
<!-- preloader section -->
<section class="preloader">
	<div class="sk-spinner sk-spinner-pulse"></div>
</section>

<!-- navigation section -->
<section class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color:#936">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
			</button>
            
			<a href="#" class="navbar-brand"><p style="color:#FFF;font-size:36px">Online Cake Shop</p></a>

        </div>
		<div class="collapse navbar-collapse">
		
		</div>
	</div>
</section>

<?php

	$sql = "SELECT * FROM item where item_id='$_GET[itemid]'";
	$qsql = mysqli_query($con,$sql);
	$rs=mysqli_fetch_array($qsql);
	$taxamt = ($taxpercentage * $rs[item_cost] ) /100;
?>

<!-- gallery section -->
<section id="gallery" class="parallax-section">
  <div class="container">
    <div class="row">
   
      
      <div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.3s"> 
<?php
			$taxamt = ($taxpercentage * $rs[item_cost] ) /100;
			
		  	$sqlimg = "SELECT * from image WHERE item_id='$_GET[itemid]' AND img_type='Default' AND status='Active'";
		  	$qsqlimg = mysqli_query($con,$sqlimg);
			if(mysqli_num_rows($qsqlimg) == 0)
			{
				$sqlimg = "SELECT * from image WHERE item_id='$_GET[itemid]' AND status='Active'";
		  		$qsqlimg = mysqli_query($con,$sqlimg);
			}
		 	$rsimg = mysqli_fetch_array($qsqlimg);
			if(mysqli_num_rows($qsqlimg) ==0)
			{
				$imgname = 'images/default-thumbnail.jpg';
			}
			else
			{
				if (file_exists('upload/'.$rsimg[item_img])) 
				{
					$imgname = 'upload/'.$rsimg[item_img];
				}
				else
				{
					$imgname = 'images/default-thumbnail.jpg';
				}
			}
?>
      	<a href="<?php echo $imgname; ?>" data-lightbox-gallery="zenda-gallery" id="imgClickAndChangeurl"><img src="<?php echo $imgname; ?>" alt="gallery img"  id="imgClickAndChange"></a>
        <div>
<?php			
		  	$sqlimg = "SELECT * from image WHERE item_id='$_GET[itemid]' AND status='Active'";
		  	$qsqlimg = mysqli_query($con,$sqlimg);
		 	while($rsimg = mysqli_fetch_array($qsqlimg))
			{
				if(mysqli_num_rows($qsqlimg) ==0)
				{
?>
<img src="images/default-thumbnail.jpg" alt="gallery img"  onclick="changeImage(`images/default-thumbnail.jpg`)" style="cursor:pointer;">
<?php
				}
				else
				{
					if (file_exists('upload/'.$rsimg[item_img])) 
					{
?>
<img src="upload/<?php echo $rsimg[item_img]; ?>" style="width:50px;height:50px;cursor:pointer;"  onclick="changeImage('upload/<?php echo $rsimg[item_img]; ?>')" >
<?php
					}
					else
					{
?>
<img src="images/default-thumbnail.jpg" alt="gallery img"  style="width:50px;height:50px;cursor:pointer;"  onclick="changeImage(`images/default-thumbnail.jpg`)" style="cursor:pointer;">
<?php
					}
				}
			}
?>

        </div>

   
      </div>
      
      <div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.6s">
        <div>
          <h1 style="font-family: 'Comic Sans MS', cursive"><?php
          echo $rs[item_name];
		  ?>
		 </h1>
        
         <p> <?php
		   echo $rs[item_description];
		  ?>
</p>
        </div>
      </div>
      
  
      
      <div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.6s"> 
<?php
if(!isset($_GET[itemdet])) 
{
?>
       <center><h2><span id="divcost"><?php
	 $totamt = $rs[item_cost] +$taxamt;
          echo  "₹ ". round($totamt) ;
		  ?></span></h2>
          
          <p> <input type="radio" name="cakeshape" id="cakeshape" value="Round" checked > Round | <input type="radio" name="cakeshape" id="cakeshape" value="Rectangle"> Rectangle</p>
          
          <p> Weight : 
          <select name="weight" id="weight" onChange="calculatekg('<?php echo $rs[item_cost]; ?>','<?php echo $taxpercentage; ?>',this.value,'<?php echo $rs[cost_per_kg]; ?>')">
			  <?php
			  	$arr = array("1 KG","1.5 KG","2 KG","2.5 KG","3 KG","3.5 KG","4 KG","4.5 KG","5 KG","5.5 KG","6 KG","6.5 KG","7 KG");
				foreach($arr as $val)
				{
					echo "<option value='$val'>$val</option>";	
				}
              ?>
          </select><br>
		  <font color='red'>₹ <?php
		   echo $rs[cost_per_kg];
		  ?> Extra cost per KG..</font></p>
           <p>&nbsp;</p>
          </center>
          
<div id="cartbanner">
<?php
include("ajaxcart.php");
?>
</div>

<?php
}
else
{
?>
<h2><?php
	 $totamt = $rs[item_cost] +$taxamt;
          echo  "₹ ". round($totamt) . ".00";
		  ?></h2>
<?php
}
?>
      </div>
     
      
    </div>
  </div>
</section>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.parallax.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/nivo-lightbox.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/custom.js"></script>
<script type="application/javascript">
$("#close-panel,#lightbox").click(function(){
     $("#lightbox, #lightbox-panel").fadeOut(300);
 })
</script>
<script>
function addtocart(item_id,category_id,addtocart,cakeshape,weight,cost_per_kg)
{
	
	document.getElementById("cartbanner").innerHTML = "<br><img src='images/loading.gif' width='150' height='150'>";
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("cartbanner").innerHTML = this.responseText;
            }
        };
		var cshape = $("input[name='cakeshape']:checked").val();
        xmlhttp.open("GET","ajaxcart.php?itemid="+item_id+"&category_id="+category_id+"&btncart=addtocart&cakeshape="+cshape+"&weight="+weight+"&cost_per_kg="+cost_per_kg,true);
        xmlhttp.send();
}
</script>
<script language="javascript">
    function changeImage(imgsrc) {
            document.getElementById("imgClickAndChange").src = imgsrc;
            document.getElementById("imgClickAndChangeurl").href = imgsrc;
    }
	function calculatekg(item_cost,taxpercentage,selectedkg,cost_per_kg)
	{
		var totamt = 0;
		var totkg = (parseFloat(selectedkg)-1) * parseFloat(cost_per_kg);
		totamt =parseFloat(item_cost) + parseFloat(totkg);
		totamt = Math.round(totamt+ totamt * taxpercentage /100);
		document.getElementById("divcost").innerHTML = "₹" + totamt ;
	}
</script>