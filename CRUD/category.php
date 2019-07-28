<?php 
include('./includes/header.php') ;

require_once("./classes/class.frontend.php");
$frontendobj = new FRONTEND();

$postcat_id = $_GET['cat_id'];
/**
 * select sliders
 */
$post_stm = $frontendobj->runQuery("SELECT * FROM posts WHERE postcat_id=$postcat_id");
$post_stm->execute();
$posts=$post_stm->fetchAll(PDO::FETCH_ASSOC);

//echo "<pre>";
//
//print_r($posts);
?>

        <section id="pagecontent">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="pageTitle"><?php 
                        $catname = $frontendobj->selectcatname($postcat_id);
                        echo $catname;
                        ?></h2>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-9">
                       <?php 
foreach ($posts as $post){
                       ?>
                       <div class="row postitem">
                            <div class="col-lg-4">
                                <img src="admin/uploads/<?=$post['post_image']; ?>" width="400" />
                            </div>
                            <div class="col-lg-8">
                                <div class="aboutcontent wow fadeInRight" data-wow-delay="300">
                                    <h3><?=$post['post_title']; ?> </h3>
                            <?php 
                                       if(strlen($post['post_description']) > 200){
                              echo substr($post['post_description'], 0 ,200). "...";
                          } 
                                        
                                        ?>
                                    <br/>
                            <a href="single.php?post=<?php echo $post['post_slug'] ?>" class="btn btn-info btn-small">Read More</a>
                        
                        </div>
                            </div>
                        </div>
                        <hr/>
<?php } ?>
                        
                    </div>
                    <div class="col-lg-3">
                        <div class="sidebar">
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>


<?php include('./includes/footer.php') ;?>