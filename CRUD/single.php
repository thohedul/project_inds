<?php 

include("includes/header.php") ;

require_once("./classes/class.frontend.php");
$frontendobj = new FRONTEND();
$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$slug = $_GET['post'];

/**
 * select sliders
 */
$posts = $frontendobj->details($slug);

?>

        <section id="pagecontent">
            <div class="container">
                
                <div class="row">

                    <div class="col-lg-9">
                        <div class="col-lg-12">
                        <h2 class="pageTitle"><?php echo $posts['post_title']; ?> </h2>
                    </div>
                       <?php echo $posts['post_description']; ?>
                        
                    </div>
                    <div class="col-lg-3">
                        <div class="sidebar">
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php include('./includes/footer.php') ;?>