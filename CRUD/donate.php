<!-- Donate Start --> 
<section id="donate">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="donatePic  wow fadeInLeft" data-wow-delay="300">
                   
                    <img src="./admin/uploads/<?php echo $donate[0]['donate_image'];?>"  />
                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="donatecontent wow fadeInRight" data-wow-delay="300">
                        <h3><?php echo $donate[0]['donate_title']; ?></h3>
                        <p><?php
                            //echo $donate[0]['page_description'];
                            if (strlen($donate[0]['donate_description']) > 300) {
                                echo substr($donate[0]['donate_description'],0, 300) . "...";
                                
                            }
                            ?></p>

                        <button type="<?php echo $donate[0]['donate_button_link']; ?>" class="btn btn-warning btn-lg btn-oranged"><?php echo $donate[0]['donate_button_text']; ?></button>
                         
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Donate End -->
