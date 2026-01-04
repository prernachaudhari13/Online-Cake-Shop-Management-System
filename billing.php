<?php
include("header.php");
//if($_POST[randomid] == $_SESSION[randomid])
{
	if(isset($_POST['submitbilling']))
	{
		$sqlbillno ="SELECT max(bill_no) FROM billing WHERE status='Active'";
		$qsqlbillno = mysqli_query($con,$sqlbillno);
		$rsbillno = mysqli_fetch_array($qsqlbillno);
		echo mysqli_num_rows($qsqlbillno);
		if(mysqli_num_rows($qsqlbillno) >=1)
		{
			$billno = $rsbillno[0]+1;
		}
		else
		{
			$billno = 1001;
		} 
$sqlcustomer = "SELECT * FROM customer WHERE cust_id='$_SESSION[cust_id]'";
$qsqlcustomer = mysqli_query($con,$sqlcustomer);
$rscustomer = mysqli_fetch_array($qsqlcustomer);		

	$msg = mysqli_real_escape_string($con,$_POST[msg]);
	$note = mysqli_real_escape_string($con,$_POST[note]);
	//	msg paymenttype acholder cardno cardno expdate cvvno delivaddr landmark pincode mobno
			$sql ="INSERT INTO billing(cust_id,bill_type,bill_no,bill_date,delivery_date,delivery_time,tax_id,tax_amt,promocode,promocode_type,discount,message,note,payment_type,card_number,particulars,status,deliv_address,name,pin_code,mob_no) values('$_SESSION[cust_id]','','$billno','$dt','$_POST[deldate]','$_POST[deltime]','$rstax[0]','$taxpercentage','$_POST[promocodeno]','$_POST[promocodetype]','$_POST[disc_amt]','$msg','$note','$_POST[paymenttype]','$_POST[cardno]','Account holder: $_POST[acholder] | Expriry date:  $_POST[expdate]','Active','$_POST[delivaddr]','$_POST[name]','$_POST[pincode]','$_POST[mobno]')";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
			$insid= mysqli_insert_id($con);
			$sqlbilling_records = "UPDATE billing_records SET status='Active',bill_id='$insid' WHERE status='pending' AND bill_id='0'";
			$qsqlbilling_records = mysqli_query($con,$sqlbilling_records);
				echo "<script>alert('Cake order transaction completed successfully...');</script>";
				echo "<script>window.location='billingreceipt.php?billid=" . $insid ."';</script>"; 
	}
}
$_SESSION['randomid'] = rand();
if(isset($_GET['editid']))
{
	$sqledit ="select * from billing WHERE bill_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>

<!-- contact section -->

<section id="contact" class="parallax-section" style="background-image:url(images/46c9af229755070841796a8ea5351463.jpg)">
  <div class="container">
    <div class="row">
      <div class="col-md-offset-1 col-md-10 col-sm-10 text-center" style="color:#FEF4AF">
        <h2><center>Billing</center></h2>
        <hr>
      </div>
      
<?php
include("datatables.php");
?>  <form action="" method="post" name="frmbilling" onsubmit="return validateform()">
<input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>" >
<div id="idbillingpromo">
<?php
include("billingpromo.php");
?>
</div>

  
      <div class="col-md-offset-1 col-md-12 col-sm-11 wow fadeIn" data-wow-delay="0.9s" style="color:#FEF4AF">
        <div class="col-md-10 col-sm-10">
           &nbsp;<hr><h2><center>Enter the following details</center></h2> 
           <hr>
           
        </div> 
        
        <div class="col-md-5 col-sm-5">
            <strong>Delivery Date:</strong><input name="deldate" type="date" class="form-control" placeholder="Delivery date" min="<?php echo date("Y-m-d"); ?>" onChange="funcheckdate(this.value)" onKeyUp="checkdate(this.value)" >
          	<span id="iddeldate" ></span>
        </div>

        <div class="col-md-5 col-sm-5" id="divdeltime">
           <strong>Delivery time:</strong> <input id="deltime" name="deltime" type="time" class="form-control" placeholder="Delivery Time" >         	<span id="iddeltime" ></span>
        </div>        
        

          <div class="col-md-5 col-sm-5">
           <textarea name="msg" class="form-control" placeholder="Message on Cake"></textarea>
          <span id="idmsg" ></span>
          </div>
          
          <div class="col-md-5 col-sm-5">
            <textarea name="note" class="form-control" placeholder="Any note"></textarea>          
          </div>

        <div class="col-md-10 col-sm-10">
           &nbsp;<hr> <h2><center>Delivery Address</center></h2> 
           <hr>
           
        </div>
          
        <div class="col-md-5 col-sm-5">
         <input name="name" type="text" class="form-control" placeholder="Recipient Name" >
          	<span id="idrecipname" ></span>  
            </div>
            
            <div class="col-md-5 col-sm-5">
            <input name="mobno" type="text" class="form-control" placeholder="Recipient Mobile Number" >
          	<span id="idmobno" ></span>      
            </div>

          <div class="col-md-5 col-sm-5">
          <textarea name="delivaddr" class="form-control" placeholder="Delivery address"></textarea>
          <span id="iddelivaddr" ></span>
          </div>
          
          <div class="col-md-5 col-sm-5">
           <input name="pincode" type="text" class="form-control" onKeyUp="validatepincode(this.value)" placeholder="Pin Code"  >				           <input name="pincodevalidate" id="pincodevalidate" type="hidden" value="0" >
          	<span id="idpincode" ></span>
            </div>          
                       
                    <div class="col-md-10 col-sm-10">
           &nbsp;<hr> <h2><center>Payment details</center></h2>
               <hr>
              <table width="1000px" border="1">
  <tbody>
    <tr>
      <th height="24" scope="col" style="background-color:#E7C0C1"><input type="radio" name="transactiontype" value="Card Payment" checked onClick="funtranstype('Card Payment')" ></th>
      <th scope="col" style="background-color:#E7C0C1">&nbsp;Card Payment</th>
      <th scope="col"  style="background-color:#C9BA92"><input type="radio" name="transactiontype" value="Cash on Delivery"  onClick="funtranstype('Cash on Delivery')"></th>
      <th scope="col" style="background-color:#C9BA92">&nbsp;Cash on Delivery</th>
    </tr>
  </tbody>
</table>

        </div>
<div id="divpaytranstype" >
<?php
include("ajaxtranstype.php");
?>
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
function validateform()
{
	//Coding to validate 7 8 9  mobile number
	var str = document.frmbilling.mobno.value;
    var startingmobno = str.charAt(0);
	
		
	var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
    var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
	var alphanumbericExp = /^[a-zA-Z0-9]+$/; //Variable to validate only alphabets and numbers
	var numericExpression = /^[0-9]+$/; //Variable to validate only numbers


	var errmsg = 0;
	document.getElementById("iddeldate").innerHTML = "";
	document.getElementById("iddeltime").innerHTML ="";
	document.getElementById("idmsg").innerHTML ="";
	document.getElementById("idpaymnttype").innerHTML ="";
	document.getElementById("idacholder").innerHTML  ="";
	document.getElementById("idcardno").innerHTML  ="";
	document.getElementById("idexpdate").innerHTML  ="";
	document.getElementById("idcvvno").innerHTML  ="";
	document.getElementById("iddelivaddr").innerHTML  ="";
	document.getElementById("idpincode").innerHTML  ="";
	document.getElementById("idrecipname").innerHTML  ="";
	document.getElementById("idmobno").innerHTML  ="";
	
	if(document.frmbilling.deldate.value =="")
	{
		document.getElementById("iddeldate").innerHTML ="<font color='red'>Please enter date.</font>";
		errmsg=1;
	}
	if(document.frmbilling.deltime.value =="")
	{
		document.getElementById("iddeltime").innerHTML ="<font color='red'>Please enter time.</font>";
		errmsg=1;
	}
	if(document.frmbilling.msg.value =="")	
	{
		document.getElementById("idmsg").innerHTML ="<font color='red'>Please type message.</font>";
		errmsg=1;
	}	   
	if(!document.frmbilling.name.value.match(alphaspaceExp))
	{
		document.getElementById("idrecipname").innerHTML ="<font color='red'>Enter only alphabets.</font>";
		errmsg=1;
	}
	if(document.frmbilling.name.value =="")	
	{
		document.getElementById("idrecipname").innerHTML ="<font color='red'>Please enter Recipient name.</font><br>";
		errmsg=1;
	}
	if(!document.frmbilling.mobno.value.match(numericExpression)) 
	{
		document.getElementById("idmobno").innerHTML ="<font color='red'>Enter only numeric values.</font>";
		errmsg=1;
	}

	if(document.frmbilling.mobno.value.length != 10)	
	{
		document.getElementById("idmobno").innerHTML ="<font color='red'>KIndly enter 10 digit Mobile Number</font><br>";
		errmsg=1;
	}
	if(startingmobno!= 7)	
	{
		if(startingmobno != 8)
		{
			if(startingmobno!= 9)		
			{
		document.getElementById("idmobno").innerHTML ="<font color='red'>Mobile number should start with 7 or 8 or 9</font><br>";
		errmsg=1;
			}
		}
	}
	if(!document.frmbilling.mobno.value.match(numericExpression)) 
	{
		document.getElementById("idmobno").innerHTML ="<font color='red'>Enter only numeric values.</font>";
		errmsg=1;
	}
	if(document.frmbilling.mobno.value =="")	
	{
		document.getElementById("idmobno").innerHTML ="<font color='red'>Please enter Recipient Mobile Number.</font><br>";
		errmsg=1;
	}
	if(document.frmbilling.delivaddr.value =="")	
	{
		document.getElementById("iddelivaddr").innerHTML ="<font color='red'>Please enter Recipient address.</font><br>";
		errmsg=1;
	}
	if(document.frmbilling.pincodevalidate.value =="0")
	{
		document.getElementById("idpincode").innerHTML ="<font color='red'>PIN code not available for delivery.</font><br>";
		errmsg=1;		
	}
	if(!document.frmbilling.pincode.value.match(numericExpression)) 
	{
		document.getElementById("idpincode").innerHTML ="<font color='red'>Enter only numeric values.</font>";
		errmsg=1;
	}
	if(document.frmbilling.pincode.value =="")	
	{
		document.getElementById("idpincode").innerHTML ="<font color='red'>Please enter pincode.</font><br>";
		errmsg=1;
	}	
	if(document.frmbilling.paymenttype.value =="")  
	{
		document.getElementById("idpaymnttype").innerHTML ="<font color='red'>Please select payment type.</font>";
		errmsg=1;
	}
	if(!document.frmbilling.acholder.value.match(alphaspaceExp))
	{
		document.getElementById("idacholder").innerHTML ="<font color='red'>Please enter only alphabets.</font>";
		errmsg=1;
	}
	if(document.frmbilling.acholder.value =="")
	{
		document.getElementById("idacholder").innerHTML ="<font color='red'>Please enter acoount holder.</font>";
		errmsg=1;
	}
	
	if(document.frmbilling.cardno.value.length != 16)
	{
		document.getElementById("idcardno").innerHTML ="<font color='red'>Please enter 16 digits card number.</font>";
		errmsg=1;
	}
	if(!document.frmbilling.cardno.value.match(numericExpression)) 
	{
		document.getElementById("idcardno").innerHTML ="<font color='red'>Enter only numeric values.</font>";
		errmsg=1;
	}
	if(document.frmbilling.cardno.value =="")
	{
		document.getElementById("idcardno").innerHTML ="<font color='red'>Please enter card number.</font>";
		errmsg=1;
	}
	if(document.frmbilling.expdate.value =="")  
	{
		document.getElementById("idexpdate").innerHTML ="<font color='red'>Please enter expiry date.</font>";
		errmsg=1;
	}	
	if(document.frmbilling.cvvno.value.length != 3)
	{
		document.getElementById("idcvvno").innerHTML ="<font color='red'>Please enter 3 digits cvv number.</font>";
		errmsg=1;
	}
	if(!document.frmbilling.cvvno.value.match(numericExpression)) 
	{
		document.getElementById("idcvvno").innerHTML ="<font color='red'>Enter only numeric values.</font>";
		errmsg=1;
	}	
	if(document.frmbilling.cvvno.value =="")
	{
		document.getElementById("idcvvno").innerHTML ="<font color='red'>Please enter cvv number.</font>";
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

function validatepromocode(promocode)
{
			document.getElementById("idbillingpromo").value="<img src='images/loading.gif'>";
			$.post("billingpromo.php", { promocode: promocode,btnpromosubmit: "btnpromo"},
			   function(data) 
			   {
					document.getElementById("idbillingpromo").innerHTML  =  data;	
			   });
			   //divpromocode
}
</script>
<script>
function funtranstype(trtype) {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) 
			{
                document.getElementById("divpaytranstype").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxtranstype.php?trtype="+trtype,true);
        xmlhttp.send();

}
 
function validatepincode(pincode)
{
			$.post("jspincode.php", { pincode: pincode},
			   function(data) 
			   {
					document.getElementById("pincodevalidate").value  =  data;	
					if(data ==0 )
					{
					document.getElementById("idpincode").innerHTML ="<font color='red'>This PINCODE is not available for delivery..</font><br>";
					}
					else
					{
					document.getElementById("idpincode").innerHTML ="";
					}
			   });
}

function funcheckdate(deldate)
{
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) 
			{
				if(this.responseText != 0)
				{
					//alert(this.responseText);
                document.getElementById("divdeltime").innerHTML = this.responseText;
				}
            }
        };
        xmlhttp.open("GET","ajaxcheckdate.php?deldate="+deldate,true);
        xmlhttp.send();	 
}
</script>