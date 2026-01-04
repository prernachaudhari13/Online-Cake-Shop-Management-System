<?php
include("header.php");
?>
<!-- gallery section -->
<section id="gallery" class="parallax-section">
  <div class="container">
    <div class="row">
      <div class="col-md-offset-2 col-md-8 col-sm-12 text-center">
        <p style="font-family:Lucida Calligraphy;font-size:24px;color:#600">Cake Menu <hr style="width:200px;"></p><p class="col-sm-3">
       
      </div>
	<?php
      $sql = "SELECT * FROM item WHERE status='Active' AND category_id='$_GET[catid]'";
      $qsql = mysqli_query($con,$sql);
      while($rs = mysqli_fetch_array($qsql))
      {
			$taxamt = ($taxpercentage * $rs['item_cost'] ) /100;
			
		  	$sqlimg = "SELECT * from image WHERE item_id='$rs[item_id]' AND img_type='Default'";
		  	$qsqlimg = mysqli_query($con,$sqlimg);
		 	$rsimg = mysqli_fetch_array($qsqlimg);
			if(mysqli_num_rows($qsqlimg) ==0)
			{
				$imgname = 'images/default-thumbnail.jpg';
			}
			else
			{
				if (file_exists('upload/'.$rsimg['item_img'])) 
				{
					$imgname = 'upload/'.$rsimg['item_img'];
				}
				else
				{
					$imgname = 'images/default-thumbnail.jpg';
				}
			}
	?>
    
          <div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.3s" > 
      	
        
        <a href="cakemenuinfo.php?itemid=<?php echo $rs['item_id']; ?>" ><img src="<?php echo $imgname; ?>" alt="gallery img" style="width:350px;height:350px;">        </a>
        <div>
          <h3><?php echo $rs['item_name'];?> </h3>
          <span style="text-align:right;color:#006">
          <strong>₹ <?php echo $totamt = round($rs['item_cost'] + $taxamt). ".00";
		  ?></strong></span>
        </div>
      </div>
	<?php
        }
    ?>
      
 
    </div>
  </div>
</section>

<?php
include("footer.php");
?>
<?php
include("lightbox.php");
?>