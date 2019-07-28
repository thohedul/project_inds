<section id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="sectionTitle"><?php echo $aboutes[0]['aboutes_title']; ?></h2>
                        <div class="divider wow fadeInUp" data-wow-delay="600"></div>
                    </div>
                </div>
                <div class="row">
                   
                    <div class="col-lg-6">
                        <div class="aboutcontent wow fadeInRight" data-wow-delay="300">
                            
                            <p> <?php
                            //echo $donate[0]['page_description'];
                            if (strlen($aboutes[0]['aboutes_description']) > 300) {
                                echo substr($aboutes[0]['aboutes_description'],0, 300) . "...";
                                
                            }
                            ?></p>
                          
                            <button type="<?php echo $aboutes[0]['aboutes_button_link']; ?>" class="btn btn-warning btn-lg btn-oranged"><?php echo $aboutes[0]['aboutes_button_text']; ?></button>
                        </div>
                    </div>
                     <div class="col-lg-6">
                        <div class="donatePic  wow fadeInLeft" data-wow-delay="300">
                            <img src="./admin/uploads/<?php echo $aboutes[0]['aboutes_image'];?>"/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        