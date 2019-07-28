<!-- Gallery Start -->
  <section id="gallery">
            <div class="container ">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="sectionTitle"><?php echo $gallerys[0]['gallery_title'];?></h2>
                        <div class="divider wow fadeInUp" data-wow-delay="600"></div>
                    </div>
                </div>
                
                <div class="row">
                     <?php
                        $i=0;
                        foreach ($gallerys as $gallerys){
                        ?>
                    <div class="col-lg-3">
                         <div class="donatePic  wow fadeInLeft" data-wow-delay="300">
                        <a href="./admin/uploads/<?php echo $gallerys['gallery_image']; ?>" rel="prettyPhoto[gallery1]">
                            <img class="img-thumbnail" src="./admin/uploads/<?php echo $gallerys['gallery_image']; ?>" alt="<?php echo $gallerys['gallery_custom_title'];?>" />
                        </a>
                    </div>
                    </div>
                
                    <?php 
                        $i++;
                        
                        } ?>
                  
              
                </div>
               
            </div>
        </section>
  <!-- Gallery end -->
        