<?php
error_reporting(0);
if($_GET[trtype] == "Cash on Delivery")
{
?>      
        <div class="col-md-10 col-sm-10">
		<input type="hidden" name="paymenttype" value="Cash on Delivery" >
        <center><strong style="color:#600">Cash on Delivery selected</strong></center>
         </div>   

        <div class="col-md-5 col-sm-5" style="width:100%">
        </div>
                  <div class="col-md-offset-3 col-md-4 col-sm-offset-3 col-sm-5">
            <input name="submitbilling" type="submit" class="form-control" style="color:#600" id="submit" value="Complete Order" >
          </div>
<?php
}
else
{
?>

        <div class="col-md-5 col-sm-5">
        	<select name="paymenttype" class="form-control" placeholder="Select payment type">
            	<option value="">Select Payment type</option>
                <?php
				$arr= array("VISA", "Master Card","Rupay");
				foreach($arr as $val)
				{
					echo "<option value='$val'>$val</option>";	
				}
				?>
            </select>
        <span id="idpaymnttype" ></span>
        </div> 
        
        <div class="col-md-5 col-sm-5">
            <input name="acholder" type="text" class="form-control" placeholder="Account Holder"  >
          	<span id="idacholder" ></span>
        </div>
        
        <div class="col-md-5 col-sm-5">
            <input name="cardno" type="text" class="form-control" placeholder="Card Number"  >
          	<span id="idcardno" ></span>
        </div>

        <div class="col-md-5 col-sm-5">
            <input name="expdate" type="month" class="form-control" placeholder="Expiry Date" min="<?php echo date("Y-m"); ?>"  >
          	<span id="idexpdate" ></span>
        </div>       
        
        <div class="col-md-5 col-sm-5">
            <input name="cvvno" type="text" class="form-control" placeholder="CVV Number"  >
          	<span id="idcvvno" ></span>
        </div>   

        <div class="col-md-5 col-sm-5" style="width:100%">
        </div>
                  <div class="col-md-offset-3 col-md-4 col-sm-offset-3 col-sm-5">
            <input name="submitbilling" type="submit" class="form-control" style="color:#FEF4AF" id="submit" value="<?php 
						if(isset($_GET[editid]))
						{
							echo "Update";
						}
						else
						{
							echo "Make Payment";
						}
						?>">
          </div>
<?php
}
?>