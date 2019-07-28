<?php
require_once("session.php");
require_once("./classes/class.slider.php");
$slider = new SLIDER();
	
$slide_id = $_GET['sid'];

$row = $slider->update($slide_id);
       
if(isset($_POST['update_slide']))
{

	$slide_title = strip_tags($_POST['slide_title']);
	$slide_custom_title = $_POST['slide_custom_title'];
        $slide_description = $_POST['slide_description'];
        $slide_button_text = $_POST['slide_button_text'];
        $slide_button_link = $_POST['slide_button_link'];
        $slide_new_window = $_POST['slide_new_window'];
        
	$slide_image = 	$_FILES['slide_image'];
        $slide_id = $_POST['sid'];
        
        
        if($slide_title==""){
            $error = "Please insert Slide Title";
        }else{
            if($slider->update_save($slide_title,$slide_custom_title,$slide_description,$slide_button_text,$slide_button_link,$slide_new_window,$slide_image,$slide_id)){
                $slider->redirect('slide_list.php');
                $success = "Updated Successfully";
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
            <h1 class="h3 mb-0 text-gray-800">Dashboard :: Update Slide</h1>
          </div>

<div class="card shadow">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Update Group <?php echo $row['slide_id'];?></h6>
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
                    
                    <div id="success">
                        <?php
                            if(isset($success))
                                        {
                          ?>
                                <div class="alert alert-success">
                                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $success; ?> !
                                </div>
                                <?php
                                        }
                                ?>
                        </div> 
                    
                <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" value="<?php echo $row['slide_title'];?>" name="slide_title" class="form-control form-control-user" placeholder="slide title">
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" value="<?php echo $row['slide_custom_title'];?>" name="slide_custom_title" class="form-control form-control-user" placeholder="Custom Title">
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" value="<?php echo $row['slide_description'];?>" name="slide_description" class="form-control form-control-user" placeholder="Description ">
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" value="<?php echo $row['slide_button_text'];?>" name="slide_button_text" class="form-control form-control-user" placeholder="Button Text ">
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" value="<?php echo $row['slide_button_link'];?>" name="slide_button_link" class="form-control form-control-user" placeholder="Button Link ">
                  </div>
                  
                </div>
                
                    <div class="form-group">
                    <select name="slide_new_window" class="form-control">
                        <option value="newwindow" <?php echo ($row['slide_new_window']=='newwindow')? " selected": ""?>>New Window</option>
                        <option value="selfwindow" <?php echo ($row['slide_new_window']=='selfwindow')? " selected": ""?>>Self Window</option>
                    </select>
                </div>
                    
                <div class="form-group row">
                    <label> Slide Image</label>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                      <img src="uploads/<?php echo $row['slide_image'];?>" />
                      <input type="file" name="slide_image" class="form-control form-control-user" >
                  </div>
                  
                </div>
                    <input type="hidden" value="<?php echo $row['slide_id'];?>" name="sid" />
                  <input type="submit" class="btn btn-primary btn-user btn-block" value="Update" name="update_slide">
                  
                <hr>
                
              </form>
            </div>
          </div>
          </div>

        
        </div>


   
<?php 
include './includes/footer.php';
?>