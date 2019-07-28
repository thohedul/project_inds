<section id="slider">
            <div class="bd-example wow fadeInUp" data-wow-delay="1s">
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php
                        $i=0;
                        foreach ($sliders as $slider){
                        ?>
                        <li data-target="#carouselExampleCaptions" data-slide-to="<?php echo $i; ?>" class="<?php echo ($i==0)? "active" : "" ?>"></li>
                        <?php 
                        $i++;
                        } ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php
                        $i=0;
                        foreach ($sliders as $slider){
                        ?>
                        <div class="carousel-item <?php echo ($i==0)? "active" : "" ?>">
                            <img src="./admin/uploads/<?php echo $slider['slide_image']; ?>" class="d-block w-100" alt="<?php echo $slider['slide_custom_title'];?>">
                            <div class="carousel-caption d-none d-md-block">
                                <h2 class="sliderTitle"><?php echo $slider['slide_custom_title'];?></h2>
                                <p class="sliderDescription"><?php echo $slider['slide_description'];?></p>
                                <a href="<?php echo $slider['slide_button_link'];?>" target="<?php echo ($slider['slide_new_window']=="newwindow")? "_blank" : "_self"; ?>" class="btn btn-warning btn-lg btn-orange"><?php echo $slider['slide_button_text'];?></a>
                            </div>
                        </div>
                        <?php 
                        $i++;
                        
                        } ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </section>