<?php
include("header.php");
if(!isset($_SESSION[user_id]))
{
	echo "<script>window.location='userlogin.php';</script>";
}
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM user WHERE user_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(!$qsql)
	{
		echo mysqli_error($con);
	}
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Record deleted successfully..');</script>";
	}
}
?>


<!-- contact section -->
<section id="contact" class="parallax-section" style="background-color:#CCF">
	<div class="container">
				<h1 class="heading">PIN code</h1>
                <?php
include("datatables.php");
?>
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
				  <tr>
				    <th scope="col">PIN Code</th>
				    <th scope="col">Status</th>
				    <th scope="col">Action</th>
			      </tr>
                  </thead>
<tbody id='divpincode'>  
<?php include("ajaxpincode.php"); ?>
</tbody>
    <tfoot>
    				<th scope="col"><input type="text" name="pincode" id="pincode"></th></th>
				    <th scope="col">
    	<select name="pincodestatus" id="pincodestatus">
        <?php
		$arr = array("Active","Inactive");
		foreach($arr as $val)
		{
			echo "<option value='$val'>$val</option>";
		}
		?>
        </select>
                    </th>
				    <th scope="col"><input type="button" name="submit" value="Submit" onClick="loadpincode(pincode.value,pincodestatus.value)" ></th>
    </tfoot>
			  </table>
	</div>
</section>


<?php
include("footer.php");
?>
<script type="application/javascript">
function deleteconfirm(pincodeid)
{
	if(confirm("Are you sure you want to delete this record?") == true)
	{
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				//alert(this.responseText);
                document.getElementById("divpincode").innerHTML = this.responseText;
            }
        };		
        xmlhttp.open("GET","ajaxpincode.php?pincodeid="+pincodeid+"&btndel=btnpincode",true);
        xmlhttp.send();
	}
	else
	{
		return false;
	}
}
function loadpincode(pincode,pincodestatus)
{
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				document.getElementById("pincode").value ="";
				document.getElementById("pincodestatus").value ="";
                document.getElementById("divpincode").innerHTML = this.responseText;
            }
        };		
        xmlhttp.open("GET","ajaxpincode.php?pincode="+pincode+"&pincodestatus="+pincodestatus+"&btnadd=btnpincode",true);
        xmlhttp.send();
}
function uppincode(pincodeid,pincodestatus)
{
	    if (window.XMLHttpRequest) 
		{
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }	
        xmlhttp.open("GET","ajaxpincode.php?pincodeid="+pincodeid+"&pincodestatus="+pincodestatus+"&btnupd=btnupd",true);
        xmlhttp.send();
}
</script>