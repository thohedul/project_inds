<?php

	require_once("session.php");
	
	require_once("./classes/class.aboutus.php");
	$aboutes = new ABOUTES();
	

        
if(isset($_POST['add_aboutes']))
{

	
	$aboutes_title = strip_tags($_POST['aboutes_title']);
	$aboutes_description = $_POST['aboutes_description'];
        $aboutes_button_text = $_POST['aboutes_button_text'];
        $aboutes_button_link = $_POST['aboutes_button_link'];
        
        
	$aboutes_image = $_FILES['aboutes_image'];

        
        if($aboutes_title==""){
            $error = "Please insert Title";
        }elseif($aboutes_button_link==""){
            $error = "Please insert Button Link";
        }else{
            if($aboutes->addaboutes($aboutes_title,$aboutes_description,$aboutes_button_text,$aboutes_button_link,$aboutes_image)){
                $aboutes->redirect('aboutus_list.php');
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
            <h1 class="h3 mb-0 text-gray-800">Dashboard :: Add new About us</h1>
          </div>

<div class="card shadow">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Add New About us</h6>
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
                      <input type="text" name="aboutes_title" class="form-control form-control-user" placeholder="about title">
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" name="aboutes_description" class="form-control form-control-user" placeholder="Description">
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" name="aboutes_button_text" class="form-control form-control-user" placeholder="Button Text ">
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" name="aboutes_button_link" class="form-control form-control-user" placeholder="Button Link ">
                  </div>
                  
                </div>
                   
                <div class="form-group row">
                    <label> About Image</label>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="file" name="aboutes_image" class="form-control form-control-user" >
                  </div>
                  
                </div>
                  <input type="submit" class="btn btn-primary btn-user btn-block" value="Add New About us" name="add_aboutes">
                  
                <hr>
                
              </form>
            </div>
          </div>
          </div>

        
        </div>


   
<?php 
include './includes/footer.php';
?>