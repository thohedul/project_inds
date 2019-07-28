
<?php 

require_once("classes/class.frontend.php");
$frontendobj = new FRONTEND();

$sstm = $frontendobj->runQuery("SELECT * FROM settings WHERE setting_id=1");
$sstm->execute();
$settings=$sstm->fetch(PDO::FETCH_ASSOC);

$tagline = $settings['setting_tagline'];

if($tagline==""){
    $tagline = "Please set your tagline from settings..";
}
//social links
$facebook = $settings['setting_facebook'];
$rss = $settings['setting_rss'];
$twitter = $settings['setting_twitter'];
$linkedin = $settings['setting_linkedin'];
$google = $settings['setting_google'];

// logo

$setting_logo = $settings['setting_logo'];
$setting_phone= $settings['setting_phone'];

$setting_copyright=$settings['setting_copyright'];
$setting_footertext=$settings['setting_footertext'];
$setting_googlemap=$settings['setting_googlemap'];

?>
 
<!-- Footer -->
<section id="footer">
    <div class="footerTop">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footerlogo">
                        <a href="#" title="php97">
                                    <img src="assets/images/logo-php97.png" alt="php97" />
                                </a>
                        <div class="footercontent">
                            <?php if($setting_footertext!=""){?> 
                            <p><?php echo $setting_footertext;?>"</p>
                             <?php } ?>
                             <?php if($setting_footertext!=""){?> 
                             <p><?php echo $setting_footertext;?>"</p>
                             <?php } ?>
                        </div>
                    </div>
                </div>
                
                 <div class="col-lg-4">
                     <div class="footercol">
                         <h3>Quick Links</h3>
                         <ul class="list-unstyled quick-links">
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Home</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>About</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>FAQ</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Get Started</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Videos</a></li>
					</ul>
                     </div>
                </div>
                 <div class="col-lg-4">
                    <div class="footercol">
                         <h3>Location</h3>
                         <div class="map">
                              <?php if($setting_googlemap!=""){?>
                             <iframe src="<?php echo $setting_googlemap;?>" width="330" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
                              <?php } ?>
                         </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footerBottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                     <?php if($setting_copyright!=""){?>
                    <p><?php echo $setting_copyright;?>"</p>
                    <?php } ?>
                </div>
                <div class="col-lg-6">
                    <ul class="social-network social-circle text-right">
                        <?php if($rss!=""){?>
                        <li><a href="<?php echo $rss;?>" class="icoRss" title="Rss"><i class="fa fa-rss"></i></a></li>
                        <?php } ?>
                        <?php if($facebook!=""){?>
                        <li><a href="<?php echo $facebook;?>" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <?php } ?>
                        <?php if($twitter!=""){?>
                        <li><a href="<?php echo $twitter;?>" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                        <?php } ?>
                        <?php if($linkedin!=""){?>
                        <li><a href="<?php echo $linkedin;?>" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                        <?php } ?>
                        <?php if($google!=""){?>
                        <li><a href="<?php echo $google;?>" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                        <?php } ?>
                    </ul>				
                </div>
            </div>
        </div>
    </div>
</section>
 <!-- Footer -->
        <script src="assets/js/bootstrap.min.js" type="text/javascript" ></script>
        <script src="assets/js/jquery.ticker.js" type="text/javascript" ></script>
        <script src="assets/js/wow.min.js" type="text/javascript" ></script>
        <script src="assets/js/jquery.prettyPhoto.js" type="text/javascript" ></script>
        <script src="assets/js/owl.carousel.min.js" type="text/javascript" ></script>
        
        <script src="assets/js/scripts.js" type="text/javascript" ></script>

    </body>
</html>