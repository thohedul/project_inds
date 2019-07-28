<?php

	require_once("session.php");
	
	require_once("./classes/class.donate.php");
	$donate = new DONATE();
	

        
if(isset($_POST['add_donate']))
{

	
	$donate_title = strip_tags($_POST['donate_title']);
	$donate_description = $_POST['donate_description'];
        $donate_button_text = $_POST['donate_button_text'];
        $donate_button_link = $_POST['donate_button_link'];
        
        
	$donate_image = $_FILES['donate_image'];

        
        if($donate_title==""){
            $error = "Please insert Title";
        }elseif($donate_button_link==""){
            $error = "Please insert Button Link";
        }else{
            if($donate->adddonate($donate_title,$donate_description,$donate_button_text,$donate_button_link,$donate_image)){
                $donate->redirect('donate_list.php');
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
            <h1 class="h3 mb-0 text-gray-800">Dashboard :: Add new Donate</h1>
          </div>

<div class="card shadow">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Add New Donate</h6>
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
                      <input type="text" name="donate_title" class="form-control form-control-user" placeholder="donate title">
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" name="donate_description" class="form-control form-control-user" placeholder="Description">
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" name="donate_button_text" class="form-control form-control-user" placeholder="Button Text ">
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" name="donate_button_link" class="form-control form-control-user" placeholder="Button Link ">
                  </div>
                  
                </div>
                   
                <div class="form-group row">
                    <label> Donate Image</label>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="file" name="donate_image" class="form-control form-control-user" >
                  </div>
                  
                </div>
                  <input type="submit" class="btn btn-primary btn-user btn-block" value="Add New Donate" name="add_donate">
                  
                <hr>
                
              </form>
            </div>
          </div>
          </div>

        
        </div>


   
<?php 
include './includes/footer.php';
?>