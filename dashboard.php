<?php
include("header.php");
if(!isset($_SESSION[user_id]))
{
	echo "<script>window.location='userlogin.php';</script>";
}
?>
<!-- gallery section -->
<section id="gallery" class="parallax-section">
  <div class="container">
    <div class="row">
      <div class="col-md-offset-2 col-md-8 col-sm-12 text-center">
        <p style="font-family:Lucida Calligraphy;font-size:24px;color:#600">Dashboard</p>
        <hr>
      </div>
      <div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.3s">
      	
        <img src="images/users.png" alt="gallery img" style="width:300px;height:300px;">
        <div>
          <h3>Number of User records: 
          <?php
		  $sql= "SELECT * FROM user WHERE status='Active'";
		  $qsql = mysqli_query($con,$sql);
		  echo mysqli_error($con);
		  echo mysqli_num_rows($qsql);
		  ?>
          </h3>
        </div>
        <img src="images/customer.jpg" alt="gallery img" style="width:300px;height:300px;">
        <div>
          <h3>Number of Customer records:
          <?php
		  $sql= "SELECT * FROM customer WHERE status='Active'";
		  $qsql = mysqli_query($con,$sql);
		  echo mysqli_error($con);
		  echo mysqli_num_rows($qsql);
		  ?>
          </h3>
        </div>
        
         <img src="images/discount.jpg" alt="gallery img" style="width:300px;height:300px;">
        <div>
          <h3>Number of promocode records:
          <?php                                   
		  $sql= "SELECT * FROM promocode WHERE status='Active'";
		  $qsql = mysqli_query($con,$sql);
		  echo mysqli_error($con);
		  echo mysqli_num_rows($qsql);
		  ?>
          </h3>
        </div>
      </div>
      
      <div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.9s"> 
      <img src="images/billing.ico" alt="gallery img" style="width:300px;height:300px;">
        <div>
          <h3>Number of billing records:
          <?php
		  $sql= "SELECT * FROM billing WHERE status='Active'";
		  $qsql = mysqli_query($con,$sql);
		  echo mysqli_error($con);
		  echo mysqli_num_rows($qsql);
		  ?>
          </h3>
        </div>
        
        
        <img src="images/category.png" alt="gallery img" style="width:300px;height:300px;">
        <div>
          <h3>Number of Category records:
          <?php
		  $sql= "SELECT * FROM category WHERE status='Active'";
		  $qsql = mysqli_query($con,$sql);
		  echo mysqli_error($con);
		  echo mysqli_num_rows($qsql);
		  ?>
          </h3>
        </div>
        
                
        
  
        
      </div>
      
      <div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.9s"> 
      
      
      <img src="images/cart.png" alt="gallery img" style="width:300px;height:300px;">
        <div>
          <h3>Number of item records:
          <?php
		  $sql= "SELECT * FROM item WHERE status='Active'";
		  $qsql = mysqli_query($con,$sql);
		  echo mysqli_error($con);
		  echo mysqli_num_rows($qsql);
		  ?>
          </h3>
        </div>
        
        
        <img src="images/message.ico" alt="gallery img" style="width:300px;height:300px;">
        <div>
          <h3>Number of Message records:
          <?php
		  $sql= "SELECT * FROM message WHERE status='Active'";
		  $qsql = mysqli_query($con,$sql);
		  echo mysqli_error($con);
		  echo mysqli_num_rows($qsql);
		  ?>
          </h3>
        </div>
        
        
                
        
   
        
      </div>
      
    </div>
  </div>
</section>


<?php
include("footer.php");
?>