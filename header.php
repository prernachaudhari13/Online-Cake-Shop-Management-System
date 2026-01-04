<?php
session_start();
error_reporting(0);
date_default_timezone_set("Asia/Kolkata");
$dt = date("Y-m-d");
include("dbconnection.php");
//if($_POST[randomidcustorder] == $_SESSION[randomidcustorder])
{
	if(isset($_POST['btnsubmitcustomizedorder']))
	{
			$imgpath1 = rand() .  $_FILES[imgpath1][name];
			$imgpath2 = rand() .  $_FILES[imgpath2][name];
			move_uploaded_file($_FILES[imgpath1][tmp_name],"upload/".$imgpath1);
			move_uploaded_file($_FILES[imgpath2][tmp_name],"upload/".$imgpath2);
		//itemnm imgpath1 imgpath2 note 
			$sql ="INSERT INTO item(item_name,item_type,item_description,status,category_id) values('$_POST[itemnm]','Customized','$_POST[note]','','$_SESSION[cust_id]')";
			$qsql = mysqli_query($con,$sql);
			$insid = mysqli_insert_id($con);
			if($_FILES['imgpath1']['name'] != "")
			{
				$sql ="INSERT INTO image(img_type,item_id,item_img,status) values('Customized','$insid','$imgpath1','Active')";
				$qsql = mysqli_query($con,$sql);
				echo mysqli_error($con);
			}
			if($_FILES['imgpath2']['name'] != "")
			{			
				$sql ="INSERT INTO image(img_type,item_id,item_img,status) values('Customized','$insid','$imgpath2','Active')";
				$qsql = mysqli_query($con,$sql);
				echo mysqli_error($con);
			}				
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Customized order added successfully.. Kindly contact 24X7 staff to process this order..');</script>";
			}
			$imgpath2 = rand() .  $_FILES['imgpath2']['name'];
			
			//echo file_exists("upload/".$imgpath1);
			//echo " - ". file_exists("upload/".$imgpath2);
if (file_exists("upload/".$imgpath1)) 
{
   $img1 = "<img src='upload/$imgpath1' width='250px' height='250px'>";
}
if (file_exists("upload/".$imgpath2)) {
    $img2 = "<img src='upload/$imgpath2' width='250px' height='250px'>";
}
			$msg = "Item title: $_POST[itemnm] <br> Description: $_POST[note] <br>";
			$msg = $msg . $img1 . $img2;
			
$dttime = date("Y-m-d h:i:s");
$sqlmessage = "SELECT * FROM message WHERE chatid='$_SESSION[chatid]' AND status='Active'";
$qsqlmessage = mysqli_query($con,$sqlmessage);
$rsmessage = mysqli_fetch_array($qsqlmessage);
$countmsg =mysqli_num_rows($qsqlmessage);
$msgid=$rsmessage[0];
		
	if($countmsg == 0)
	{		
		$sql = "INSERT INTO message(chatid,cust_id,user_id,date_time,status) VALUES('$_SESSION[chatid]','$_SESSION[cust_id]','$_SESSION[user_id]','$dttime','Active')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);	
		$msgid = mysqli_insert_id($con);
		$countmsg =1;
	}
		
	$chtmsg =	mysqli_real_escape_string($con,$msg);
		
		$sql = "INSERT INTO message_reply(message_id,cust_id,user_id,message_reply_text,date_time,msg_type,item_id) VALUES('$msgid','$_SESSION[cust_id]','$_SESSION[user_id]','$chtmsg','$dttime','Customer','$insid')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
			
	}
}
//Unique chat ID for customer
if(!isset($_SESSION["chatid"]))
{
	$_SESSION["chatid"] = rand(111111,999999);
}
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
	<title>Online Cake Order</title>

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
<section class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
			</button>
            
			<a href="index.php" class="navbar-brand"><p style="color:#600;font-size:25px">Welcome To Cake Shop</p></a>

        </div>
		<div class="collapse navbar-collapse">
 <nav1>

        <ul class="nav1 navbar-nav navbar-right">
            <?php
			if(isset($_SESSION['cust_id']))
			{
			?>
            		<li><a href="index.php" >HOME</a></li>            
                    <li><a href="cakemenu.php">CAKE MENU</a></li>
                    
                
                
                <li><a href="#">PROFILE</a>
                    <ul>
                        <li><a href="cust_change_pswd.php">Change password</a></li>
                        <li><a href="customerprofile.php">Update profile</a></li>                        
                    </ul>        
            	</li>
                
                

                
                <li><a href="#">REPORT</a>
                    <ul>
                       <li><a href="billingdisplaycustomer.php">BILLING</a></li>
                         <li><a href="viewcustomizedorder.php">CUSTOMIZED ORDERS</a></li>                        
                    </ul>        
            	</li>
                
                
                
				<li><a  href="logout.php" class="smoothScroll" onClick="return confirmlogout()">LOGOUT</a></li>
                    <li><a href="index.php#contact">FEEDBACK</a></li>
                  <!--  <li><a href="index.php#team">DEVELOPER</a></li> -->
            <?php
			}
			else if(isset($_SESSION['user_id']))
			{
				if($_SESSION['user_type'] == "admin")
				{
			?>
				<li><a  href="dashboard.php" class="smoothScroll">DASHBOARD</a></li>
                
                <li><a href="#">PROFILE</a>
                    <ul>
                        <li><a href="user_change_pswd.php">Change Password</a></li>
                        <li><a href="userprofile.php">Update profile</a></li>
                    </ul>        
            	</li>
                
                <li><a href="#">USER</a>
                    <ul>
                        <li><a href="user.php">Add user</a></li>
                        <li><a href="userdisplay.php">View user</a></li>
                    </ul>        
            	</li>
                
                <li><a href="#">CATEGORY</a>
                    <ul>
                     <!--   <li><a href="tax_settings.php">Tax settings</a></li> -->
                        <li><a href="category.php">Add category</a></li>
                        <li><a href="categorydisplay.php">View category</a></li>
                        <li><a href="pincode.php">PIN Code</a></li>
                    </ul>        
            	</li>
            
            <li><a href="#">ITEMS</a>
                    <ul>
                        <li><a href="item.php">Add cake item</a></li>
                        <li><a href="itemdisplay.php">View cake item</a></li>
                       
                    </ul>        
            	</li>
                
                
                <li><a href="#">CUSTOMIZED ORDER</a>
                    <ul>
                       <!-- <li><a href="message.php">Inbox</a></li>-->
                        <li><a href="viewcustomizedorder.php">Customized order</a></li>
                        </ul>        
            	</li>
                
                
                <li><a href="#">REPORT</a>
                    <ul>
                        <li><a href="billingdisplay.php?billdate=today">Today's Orders</a></li>
                        <li><a href="billingdisplay.php">Billing report</a></li>
                        <li><a href="billing_records_display.php">Purchase report</a></li>
                        <li><a href="billingdeliverydisplay.php">Delivery report</a></li>
                        <li><a href="viewregistrations.php">View customers</a></li>
                    </ul>        
            	</li>
            
				<li><a  href="logout.php" class="smoothScroll" onClick="return confirmlogout()">LOGOUT</a></li> 
                  
            <?php
				}
				if($_SESSION['user_type'] == "employee" || $_SESSION['user_type'] == "Employee")
				{
				?>
				<li><a  href="dashboard.php" class="smoothScroll">DASHBOARD</a></li>
                
                <li><a href="#">PROFILE</a>
                    <ul>
                        <li><a href="user_change_pswd.php">Change Password</a></li>
                        <li><a href="userprofile.php">Update profile</a></li>
                    </ul>        
            	</li>
                
                
                <li><a href="#">MESSAGE</a>
                    <ul>
                        <li><a href="message.php">Inbox</a></li>
                        <li><a href="viewcustomizedorder.php">Customized order</a></li>
                        </ul>        
            	</li>
                
                
                <li><a href="#">REPORT</a>
                    <ul>
                        <li><a href="billingdisplay.php">Billing report</a></li>
                        <li><a href="billing_records_display.php">Purchase report</a></li>
                        <li><a href="billingdeliverydisplay.php">Delivery report</a></li>
                        <li><a href="viewregistrations.php">View customers</a></li>
                    </ul>        
            	</li>
            
				<li><a  href="logout.php" class="smoothScroll" onClick="return confirmlogout()">LOGOUT</a></li> 
                <?php
				}
			}
			else
			{
			?>
            		<li><a href="index.php" >HOME</a></li>
                    <li><a  href="customerlogin.php">LOGIN</a></li>
					<li><a  href="register.php">REGISTER</a></li>                
                    <li><a href="index.php#gallery">CAKE GALLERY</a></li>
                    <li><a href="cakemenu.php">CAKE MENU</a></li>
                   <!--    <li><a href="index.php#team">CHEFS</a></li>-->
                    <li><a href="index.php#contact">FEEDBACK</a></li>
                    
            <?php
			}
			?>
             <li style="background-color:#D0A4BE; width:120px; text-align:center; vertical-align:middle; font-size:12px;" id="divcart"></li>
        </ul>
    </nav1>	

		</div>
	</div>
</section>
<script type="application/javascript">
function confirmlogout()
{
	if(confirm("Are you sure do you want to logout??") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
<style>
/* CSS menu code */
/*
h1 {
		text-align: center;
	color: #FFF;
}	

h3 {
	text-align: center;
	color: #FFF;
}

h3 a {
	color: #FFF;
}

a {
	color: #FFF;
}

h1 {
	margin-top: 100px;
	text-align:center;
	}
*/
#container {
	margin: 0 auto;
}
/*
p {
	text-align: center;
}
*/
nav1 {
	/*margin: 50px 0;*/
	background-color: #FFFFFF;
}

nav1 ul {
	padding: 0;
  	margin: 0;
	list-style: none;
	position: relative;
	}
	
nav1 ul li {
	display:inline-block;
	/*background-color: #E64A19;*/
	}

nav1 a {
	display:block;
	padding:0 10px;	
	color:#000;
	font-size:20px;
	line-height: 60px;
	text-decoration:none;
}

nav1 a:hover { 
	background-color: #FFFFFF; 
}

/* Hide Dropdowns by Default */
nav1 ul ul {
	display: none;
	position: absolute; 
	top: 50px; /* the height of the main nav1 */
	background-color: #FFFFFF;
}
	
/* Display Dropdowns on Hover */
nav1 ul li:hover > ul {
	display:inherit;
		background-color: #FFFFFF;
}
	
/* Fisrt Tier Dropdown */
nav1 ul ul li {
	width:170px;
	float:none;
	display:list-item;
	position: relative;
}

/* Second, Third and more Tiers	*/
nav1 ul ul ul li {
	position: relative;
	top:-60px; 
	left:170px;
}

	
/* Change this in order to change the Dropdown symbol */
li > a:after { content:  ' '; }
li > a:only-child:after { content: ''; }
</style>