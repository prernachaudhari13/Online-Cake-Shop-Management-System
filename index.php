<?php
include("header.php");
?>
<!-- home section -->
<section id="home" class="parallax-section" >
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12" > <img src="images/ttc-logo.jpg" width="250" height="200"><br />
        <br />
        <br />
        <p style="font-family:Lucida Calligraphy;font-size:24px;color:#000000">A Little Bliss In Every Bite</p>
        <br />
        <br />
        <br />
        <a href="cakemenu.php" class="smoothScroll btn btn-default" style=" padding-left:40px; padding-right:40px;" ><img src="images/cake-icon.png" width="55" height="55"> Place Your Order</a> </div>
    </div>
  </div>
</section>

<!-- gallery section -->
<section id="gallery" class="parallax-section" >
  <div class="container">
    <div class="row">
      <div class="col-md-offset-2 col-md-8 col-sm-12 text-center">
        <p style="font-family:Lucida Calligraphy;font-size:24px;color:#600">Food Gallery</p>       
        <hr>
      </div>
      <div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.3s"> <a href="images/gallery-img1.jpg" data-lightbox-gallery="zenda-gallery"><img src="images/gallery-img1.jpg" alt="gallery img"></a>
        <div>
          <h3>Black Forest Cake</h3>
        </div>
        <a href="images/gallery-img2.jpg" data-lightbox-gallery="zenda-gallery"><img src="images/gallery-img2.jpg" alt="gallery img"></a>
        <div>
          <h3>Oreo Cake</h3>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.6s"> <a href="images/gallery-img3.jpg" data-lightbox-gallery="zenda-gallery"><img src="images/gallery-img3.jpg" alt="gallery img"></a>
        <div>
          <h3>Vanilla Cake</h3>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.9s"> <a href="images/gallery-img4.jpg" data-lightbox-gallery="zenda-gallery"><img src="images/gallery-img4.jpg" alt="gallery img"></a>
        <div>
          <h3>Chocolate Brownie Kitkat Cake</h3>
        </div>
        <a href="images/gallery-img5.jpg" data-lightbox-gallery="zenda-gallery"><img src="images/gallery-img5.jpg" alt="gallery img"></a>
        <div>
          <h3>Strawberry Cake</h3>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- team section 
<section id="team" class="parallax-section" style="padding:10px;">
  <div class="container">
    <div class="row">
      <div class="col-md-offset-2 col-md-8 col-sm-12 text-center">
        <p style="font-family:Lucida Calligraphy;font-size:24px;color:#600">Developers</p>
        <hr style="width:300px;">
      </div>
      <div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.3s"> <img src="images/team1.jpg" class="img-responsive center-block" alt="team img">
        <h3>Main Chef</h3>
      </div>
      <div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.6s"> <img src="images/team2.jpg" class="img-responsive center-block" alt="team img">
        <h3>Bake Specialist</h3>
      </div>
      <div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.9s"> <img src="images/team3.jpg" class="img-responsive center-block" alt="team img">
        <h3>New Baker</h3>
      </div>
    </div>
  </div>
</section> -->

<!-- contact section -->
<section id="contact" class="parallax-section">
  <div class="container">
<?php
if(isset($_POST[submit]))
{
	include("sendmail.php");
	$msg = "Name: ". $_POST[name] . "<br>Email ID : " . $_POST[email] . "<br>". $_POST[message];
	sendmail("lacouronnecakeorder@gmail.com","Enquiry Form",$msg,$_POST[name]);
}
?>
  <form method="post" action="">
    <div class="row">
      <div class="col-md-offset-1 col-md-10 col-sm-12 text-center">
        <p style="font-family:Lucida Calligraphy;font-size:24px;color:#600">Feedback</p>
        <hr>
      </div>
      <div class="col-md-offset-1 col-md-10 col-sm-12 wow fadeIn" data-wow-delay="0.9s">
        <form action="#" method="post">
          <div class="col-md-6 col-sm-6">
            <input name="name" type="text" class="form-control" id="name" placeholder="Name">
          </div>
          <div class="col-md-6 col-sm-6">
            <input name="email" type="email" class="form-control" id="email" placeholder="Email">
          </div>
          <div class="col-md-12 col-sm-12">
            <textarea name="message" rows="8" class="form-control" id="message" placeholder="Message"></textarea>
          </div>
          <div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6">
            <input name="submit" type="submit" class="form-control" id="submit" value="Send Message">
          </div>
        </form>
      </div>
      <div class="col-md-2 col-sm-1"></div>
    </div>
    </form>
  </div>
</section>
<?php
include("footer.php");
?>