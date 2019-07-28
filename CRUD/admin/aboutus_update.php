<?php
require_once("session.php");
require_once("./classes/class.aboutus.php");
$aboutes = new ABOUTES();
	
$aboutes_id = $_GET['aid'];

$row = $aboutes->update($aboutes_id);
       
if(isset($_POST['update_aboutes']))
{

	$aboutes_title = strip_tags($_POST['aboutes_title']);
	$aboutes_description = $_POST['aboutes_description'];
        $aboutes_button_text = $_POST['aboutes_button_text'];
        $aboutes_button_link = $_POST['aboutes_button_link'];
       
        
	$aboutes_image = $_FILES['aboutes_image'];
        $aboutes_id = $_POST['aid'];
        
        
        if($aboutes_title==""){
            $error = "Please insert About us Title";
        }else{
            if($aboutes->update_save($aboutes_title,$aboutes_description,$aboutes_button_text,$aboutes_button_link,$aboutes_image,$aboutes_id)){
                $aboutes->redirect('aboutus_list.php');
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
            <h1 class="h3 mb-0 text-gray-800">Dashboard :: Update About us</h1>
          </div>

<div class="card shadow">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Update About us <?php echo $row['aboutes_id'];?></h6>
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
                      <input type="text" value="<?php echo $row['aboutes_title'];?>" name="aboutes_title" class="form-control form-control-user" placeholder="about title">
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" value="<?php echo $row['aboutes_description'];?>" name="aboutes_description" class="form-control form-control-user" placeholder="Description">
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" value="<?php echo $row['aboutes_button_text'];?>" name="aboutes_button_text" class="form-control form-control-user" placeholder="Button Text ">
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" value="<?php echo $row['aboutes_button_link'];?>" name="aboutes_button_link" class="form-control form-control-user" placeholder="Button Link ">
                  </div>
                    </div>
                
                    
                <div class="form-group row">
                    <label> About us Image</label>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                      <img src="uploads/<?php echo $row['aboutes_image'];?>" />
                      <input type="file" name="aboutes_image" class="form-control form-control-user" >
                  </div>
                  
                </div>
                    <input type="hidden" value="<?php echo $row['aboutes_id'];?>" name="aid" />
                  <input type="submit" class="btn btn-primary btn-user btn-block" value="Update" name="update_aboutes">
                  
                <hr>
                
              </form>
            </div>
          </div>
          </div>

        
        </div>


   
<?php 
include './includes/footer.php';
?>