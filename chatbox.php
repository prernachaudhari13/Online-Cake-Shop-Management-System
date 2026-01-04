            <div class="col-lg-3 col-md-3 col-sm-3"  style="position: fixed;bottom: 0;right: 0px;">
                <div class="chat-box-div">
                
                    <div class="chat-box-head">
                        Chat with our Agent
                            <div class="btn-group pull-right">
<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false"  onclick="funminmaxbtn()"  id="buttonchat" style="height:30px;">
    <span class="fa fa-window-minimize"></span>
    <span class="sr-only">Toggle Dropdown</span>
</button>
                                <!--
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#"><span class="fa fa-map-marker"></span>&nbsp;Invisible</a></li>
                                    <li><a href="#"><span class="fa fa-comments-o"></span>&nbsp;Online</a></li>
                                    <li><a href="#"><span class="fa fa-lock"></span>&nbsp;Busy</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><span class="fa fa-circle-o-notch"></span>&nbsp;Logout</a></li>
                                </ul>
                                -->
                            </div>
                    	</div>
<div class="panel-body chat-box-main" id="chatmessage" style="background-color:#F8F8F8">                        
	<?php
    include("jschatmsg.php");
    ?>
</div>         
                    <div class="chat-box-footer"  id="chattext">
                        <div class="input-group">
                            <input type="text" class="form-control" id="txtchat" placeholder="Press Enter key to Send.."  onkeyup="submitchat('<?php echo $_SESSION["chatid"]; ?>','Customer',this.value,event);">
                            <span class="input-group-btn">
                                <button class="btn btn-info" type="button" id="myBtn"><span class="fa fa-birthday-cake"></span></button>




                            </span>   
                            <!-- <span class="fa fa-paperclip"></span> -->
                        </div>
                    </div>

                </div>

            </div>