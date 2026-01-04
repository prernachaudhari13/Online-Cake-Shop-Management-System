<!-- footer section -->
<footer class="parallax-section">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.6s">
				<h2 class="heading">Contact Info.</h2>
				<div class="ph">
					<p><i class="fa fa-phone"></i> Phone</p>
					<h4>9876543211</h4>
				</div>
                <div class="email">
					<p><i class="fa fa-envelope-open-o"></i> Mail us at</p>
					<h4>contact@onlinecakeorder.com</h4>
				</div>
				<div class="address">
					<p><i class="fa fa-map-marker"></i> Our Location</p>
					<h4>SSVPS College of Polytechnic,.</h4>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.6s">
				<h2 class="heading">Open Hours</h2>
					<p>Sunday <span>10:30 AM - 10:00 PM</span></p>
					<p>Mon-Fri <span>9:00 AM - 8:00 PM</span></p>
					<p>Saturday <span>11:30 AM - 10:00 PM</span></p>
			</div>
			<div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.6s">
				<h2 class="heading">Follow Us</h2>
				<ul class="social-icon">
					<li><a href="#" class="fa fa-facebook wow bounceIn" data-wow-delay="0.3s"></a></li>
					<li><a href="#" class="fa fa-twitter wow bounceIn" data-wow-delay="0.6s"></a></li>
					<li><a href="#" class="fa fa-behance wow bounceIn" data-wow-delay="0.9s"></a></li>
					<li><a href="#" class="fa fa-dribbble wow bounceIn" data-wow-delay="0.9s"></a></li>
					<li><a href="#" class="fa fa-github wow bounceIn" data-wow-delay="0.9s"></a></li>
				</ul>
			</div>
		</div>
	</div>
</footer>


<!-- copyright section -->
<section id="copyright">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h3>ONLINE CAKE ORDER</h3>
				<p>Copyright © <?php echo date("Y"); ?> 
                | Designed by SSVPS POLY STUDENT
                | <a href="userlogin.php">Staff Login Panel</a>
                </p>
			</div>
		</div>
	</div>
</section>
<?php
if(!isset($_SESSION['user_id']))
{
	//include("chatbox.php");
}
?>

<!-- ############ Chat code starts here  #####################  -->
<!-- BOOTSTRAP CORE STYLE CSS -->
<link href="onlinechat/css/bootstrap.css" rel="stylesheet" />
<!-- FONT AWESOME  CSS -->
<link href="onlinechat/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet" />
<!-- CUSTOM STYLE CSS -->
<link href="onlinechat/css/style.css" rel="stylesheet" />
<!-- USING SCRIPTS BELOW TO REDUCE THE LOAD TIME -->
<!-- CORE JQUERY SCRIPTS FILE -->
<script src="onlinechat/js/jquery-1.11.1.js"></script>
<!-- CORE BOOTSTRAP SCRIPTS  FILE -->
<script src="onlinechat/js/bootstrap.js"></script>
<!-- ############ Chat code ends here  #####################  -->    
    
<!-- JAVASCRIPT JS FILES -->	
<!--<script src="js/jquery.js"></script> -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.parallax.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/nivo-lightbox.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/custom.js"></script>
<div id="sound" style="visibility:hidden"></div>
</body>
<?php
if(!isset($_SESSION['user_id']))
{
?>
	<script type="application/javascript">	
        //On page load the message scroll box goes to bottom.
        $( window ).on( "load", function() {
           $('#chatmessage').animate({ scrollTop: $('#chatmessage').prop('scrollHeight')}, 1000);	
        });
    </script>
    <script type="application/javascript">
        function funminmaxbtn()
        {
            var button = document.getElementById('buttonchat');
            var divchatmessage = document.getElementById('chatmessage');
            var divchattext = document.getElementById('chattext');
        
            if (divchatmessage.style.display === 'none') 
            {		
                button.innerHTML = '<span class="fa fa-window-minimize"></span><span class="sr-only">Toggle Dropdown</span>';	
                divchatmessage.style.display = 'block';
                divchattext.style.display = 'block';
            } 
            else
            {
                button.innerHTML = '<span class="fa fa-window-maximize"></span><span class="sr-only">Toggle Dropdown</span>';		
                divchatmessage.style.display = 'none';
                divchattext.style.display = 'none';
            }
        }
        function mychatFunction()
        {
        
            var divuserslist = document.getElementById('divuserslist');
        
            if (divuserslist.style.display === 'none') 
            {		
                //button.innerHTML = '<span class="fa fa-window-minimize"></span><span class="sr-only">Toggle Dropdown</span>';	
                divuserslist.style.display = 'block';
            } 
            else
            {
                //button.innerHTML = '<span class="fa fa-window-maximize"></span><span class="sr-only">Toggle Dropdown</span>';		
                divuserslist.style.display = 'none';
            }
        }	
    
        //Submit chat message
        function submitchat(chatsessionid,custtype,message,e)
        {		
            if(message != "")
            {
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code == 13) //Enter keycode
                {
                    var chatsessionid = chatsessionid;
                    var txtmessage = message;
                    document.getElementById("txtchat").value="";
                    $.post("jschatmsgins.php", { chatsessionid: chatsessionid, custtype: custtype,message: message});
                }
            }
        }
    </script>
    <script>
    var chatdata = "";
         function auto_load()
         {
             
            $.ajax({
              url: "jscart.php",
              cache: false,
              success: function(data){
                 $("#divcart").html(data);
              } 
            });
            
            
            $.ajax({
              url: "jschatmsg.php",
              cache: false,
              success: function(data){
                  if(data == chatdata)
                  {
                  }
                  else
                  {
                      chatdata = data;
                    $("#chatmessage").html(data);
                    $('#chatmessage').animate({ scrollTop: $('#chatmessage').prop('scrollHeight')}, 1000);	
                   // document.getElementById("sound").innerHTML  ="<audio autoplay ><source src='onlinechat/mp3/surprise.mp3' type='audio/mp3' >";
                  }
              } 
            });	
         }
     
          $(document).ready(function(){
            auto_load(); //Call auto_load() function when DOM is Ready
          });
     
          //Refresh auto_load() function after 10000 milliseconds
          setInterval(auto_load,1000);
    </script>
<?php
}
include("customizedorder.php");
?>
</html>