<?php include('./includes/header.php'); ?>
<?php include('./slider.php'); ?>
<?php include ('./donate.php'); ?>
<?php include('./Aboutus.php'); ?>
<?php include('./gallery.php'); ?>
<?php include('./calltous.php'); ?>
<!-- Gallery Start -->
<section id="news">
    <div class="container ">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="sectionTitle">News and Events</h2>
                <div class="divider wow fadeInUp" data-wow-delay="600"></div>
            </div>
        </div>
        <div class="owl-carousel owl-theme">
            <?php
            foreach ($posts as $post) {
                ?>
                <div class="">
                    <a href="./admin/uploads/<?php echo $post['post_image'] ?>" rel="prettyPhoto[gallery1]">
                        <img class="img-thumbnail" src="./admin/uploads/<?php echo $post['post_image'] ?>" alt="<?php $post['post_title'] ?>" />
                    </a>
                    <div class="news">
                        <h4><?php echo $post['post_title'] ?></h4>
                        <p>Category Name : 
                            <?php
                            $catname = $frontendobj->selectcatname($post['postcat_id']);
                            ?>
                            <a href="category.php?cat_id=<?php echo $post['postcat_id']; ?>"><?php echo $catname; ?></a></p>
                        <div class="newsdes" style="margin-bottom: 10px">
                            <?php
                            if (strlen($post['post_description']) > 200) {
                                echo substr($post['post_description'], 0, 200) . "...";
                            }
                            ?>

                        </div>
                        <a class="btn btn-info btn-sm" href="post_details.php?pid=<?php echo $post['post_id']; ?>">Read More</a>
                    </div>
                </div>
<?php } ?>
        </div>

    </div>
</section>
<!-- Gallery end -->      
<?php include('./includes/footer.php'); ?>