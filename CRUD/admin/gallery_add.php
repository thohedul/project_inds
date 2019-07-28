<?php

	require_once("session.php");
	
	require_once("./classes/class.gallery.php");
	$gallerys = new GALLERYS();
	

        
if(isset($_POST['add_gallery']))
{

	
	$gallery_title = strip_tags($_POST['gallery_title']);
	$gallery_custom_title = $_POST['gallery_custom_title'];
        $gallery_new_window = $_POST['gallery_new_window'];
       
        
        
	$gallery_image = $_FILES['gallery_image'];

        
        if($gallery_title==""){
            $error = "Please insert Title";
        }elseif($gallery_custom_title==""){
            $error = "Please insert custom title";
        }else{
            if($gallerys->addgallerys($gallery_title,$gallery_custom_title,$gallery_new_window,$gallery_image)){
                $gallerys->redirect('gallery_list.php');
            }else{
                $error = "something wrong";
            }
        }
        
        	
}   
        
        
        
?>
<?php 
include './includes/header.php';
?>




        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard :: Add new Gallery</h1>
          </div>

<div class="card shadow">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Add New Gallery</h6>
            </div>
            <div class="card-body">
                <form class="user" method="POST" enctype="multipart/form-data" >
                    
                   <div id="error">
                        <?php
                            if(isset($error))
                                        {
                          ?>
                                <div class="alert alert-danger">
                                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                                </div>
                                <?php
                                        }
                                ?>
                        </div> 
                    
                    
                    
                <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" name="gallery_title" class="form-control form-control-user" placeholder="title">
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" name="gallery_custom_title" class="form-control form-control-user" placeholder="custom title">
                  </div>
                  
                </div>
                     <div class="form-group">
                    <select name="gallery_new_window" class="form-control">
                        <option value="newwindow">New Window</option>
                        <option value="selfwindow" selected>Self Window</option>
                    </select>
                </div
                   
                <div class="form-group row">
                    <label>Gallery Image</label>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="file" name="gallery_image" class="form-control form-control-user" >
                  </div>
                  
                </div>
                  <input type="submit" class="btn btn-primary btn-user btn-block" value="Add New Gallery" name="add_gallery">
                  
                <hr>
                
              </form>
            </div>
          </div>
          </div>

        
        </div>


   
<?php 
include './includes/footer.php';
?>