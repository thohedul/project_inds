<?php 

require_once("classes/class.frontend.php");
$frontendobj = new FRONTEND();

/**
 * select sliders
 */
$sliderstm = $frontendobj->runQuery("SELECT * FROM slider");
$sliderstm->execute();
$sliders=$sliderstm->fetchAll(PDO::FETCH_ASSOC);



/**
 * select donate page content
 */
$donatestm = $frontendobj->runQuery("SELECT * FROM donate");
$donatestm->execute();
$donate=$donatestm->fetchAll(PDO::FETCH_ASSOC);


/**
 * select about us content
 */
$aboutesstm = $frontendobj->runQuery("SELECT * FROM aboutes");
$aboutesstm->execute();
$aboutes=$aboutesstm->fetchAll(PDO::FETCH_ASSOC);


/**
 * select about us content
 */
$gallerysstm = $frontendobj->runQuery("SELECT * FROM gallerys");
$gallerysstm->execute();
$gallerys=$gallerysstm->fetchAll(PDO::FETCH_ASSOC);




//echo "<pre>";
//echo $donate[0]['page_title'];


/**
 * posts 
 */
$poststm = $frontendobj->runQuery("SELECT * FROM posts");
$poststm->execute();
$posts=$poststm->fetchAll(PDO::FETCH_ASSOC);


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


?>
<!DOCTYPE html>
<html>
    <head>
        <title>php 97</title>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css" />
        <link rel="stylesheet" href="assets/css/animate.min.css" type="text/css" />
        <link rel="stylesheet" href="assets/css/prettyPhoto.css" type="text/css" />
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css" type="text/css" />
        <link rel="stylesheet" href="assets/css/owl.theme.default.min.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700,800" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/ticker-style.css" type="text/css" />
        <link rel="stylesheet" href="assets/css/style.css" type="text/css" />
        <!-- Stylesheets -->
        <script src="assets/js/jquery.min9.js" type="text/javascript" ></script>
    </head>
    <body>
        <!-- Header Start -->
        <section id="header">
            <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <ul id="js-news">
                  <?php foreach ($posts as $post){ ?>      
                        <li class="news-item"><?php echo $post['post_title']; ?></li>
                  <?php } ?>
	</ul>
<!--                    <p><?php //echo $tagline; ?></p>-->
                </div>
                <div class="col-lg-3 mr0">
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
            <div class="headerTop">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="logo wow fadeInLeft" data-wow-delay="300">
                                <a href="#" title="php97">
                                    <?php if($setting_logo!=""){?>
                                    <img src="admin/uploads/<?php echo $setting_logo; ?>" alt="php97" />
                                    <?php }else{ ?>
                                    <img src="assets/images/logo-php97.png" alt="php97" />
                                    <?php } ?>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="phone text-right  wow fadeInRight" data-wow-delay="300">
                                <?php if($setting_phone!=""){?>
                                <img src="admin/uploads/<?php echo $setting_phone; ?>" alt="PHP97 Phone Number" />
                               <?php }else{ ?>
                                <img src="assets/images/phone.png" alt="PHP97 Phone Number" />
                                 <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navigation wow fadeInUp" data-wow-delay="600">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <nav class="navbar navbar-expand-lg navbar-dark bg-light navbg-php97">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                    <ul class="navbar-nav">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="category.php?cat_id=1">Sports<span class="sr-only">(current)</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Media</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Entertainment</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Technology</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">CONTACT US</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">ADOPTABLE ANIMALS</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Header End -->
       