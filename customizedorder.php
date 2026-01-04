<?php
session_start();
?>
<style>
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    -webkit-animation-name: fadeIn; /* Fade in the background */
    -webkit-animation-duration: 0.4s;
    animation-name: fadeIn;
    animation-duration: 0.4s
}

/* Modal Content */
.modal-content {
    position: fixed;
    bottom: 0;
    background-color: #fefefe;
    width: 100%;
    -webkit-animation-name: slideIn;
    -webkit-animation-duration: 0.4s;
    animation-name: slideIn;
    animation-duration: 0.4s
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
}

/* Add Animation */
@-webkit-keyframes slideIn {
    from {bottom: -300px; opacity: 0} 
    to {bottom: 0; opacity: 1}
}

@keyframes slideIn {
    from {bottom: -300px; opacity: 0}
    to {bottom: 0; opacity: 1}
}

@-webkit-keyframes fadeIn {
    from {opacity: 0} 
    to {opacity: 1}
}

@keyframes fadeIn {
    from {opacity: 0} 
    to {opacity: 1}
}
</style>


<!-- The Modal -->
<?php
if(isset($_SESSION[cust_id]))
{
?>
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Customized Order panel</h2>
    </div>
    <?php
	if(isset($_SESSION[cust_id]))
	{
		$_SESSION[randomidcustorder] = rand();
	?>
    <div class="modal-body">
		<div class="row">

			<div class="col-md-offset-1 col-md-10 col-sm-11 wow fadeIn" data-wow-delay="0.9s">
				<form action="" method="post" name="frmcustomizedorder" enctype="multipart/form-data">
                <input type="hidden" name="randomidcustorder" value="<?php echo $_SESSION[randomidcustorder]; ?>">
                 	
                    <div class="col-md-5 col-sm-5">
						<input name="itemnm" type="text" autocomplete="off" class="form-control" placeholder="Item title" value="<?php echo $rsedit[item_name]; ?>">
					<span id="iditemname" ></span>
                    </div>                              
                     <div class="col-md-5 col-sm-5">
						<input name="imgpath1" type="file" class="form-control" placeholder="Image Path" value="<?php echo $rsedit[item_img]; ?>">
					<span id="iditmdes" ></span>
                    </div>
                    
                    
                    <div class="col-md-5 col-sm-5">
						<textarea name="note" class="form-control" placeholder="Write order details here"><?php echo $rsedit[item_description]; ?></textarea>
					<span id="iditmdes" ></span>
                    </div>                              
                     <div class="col-md-5 col-sm-5">
						<input name="imgpath2" type="file" class="form-control" placeholder="Image Path" value="<?php echo $rsedit[item_img]; ?>">
					<span id="iditmdes" ></span>
                    </div>
               

				
			</div>
			<div class="col-md-2 col-sm-1"></div>
		</div>
    </div>
    <div class="modal-footer">
                     		
					<div class="col-md-offset-3 col-md-4 col-sm-offset-3 col-sm-5">
						<input name="btnsubmitcustomizedorder" type="submit" class="form-control" id="submit" value="Add to Customized Order">
					</div>
                    </form>
    </div>
    <?php
	}
	else
	{
?>
					    <div class="modal-footer">
                     		
					<div class="col-md-offset-3 col-md-4 col-sm-offset-3 col-sm-5">
		<input name="btnsubmitcustomizedorder" type="button" class="form-control" id="submit" value="Click here to Login" onClick="window.location='customerlogin.php';">
					</div>
    </div>
<?php
	}
	?>
  </div>

</div>
<?php
}
?>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
