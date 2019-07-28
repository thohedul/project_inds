<?php
require_once("session.php");
require_once("./classes/class.donate.php");
$donate = new DONATE();
	
$donate_id = $_GET['did'];

$row = $donate->update($donate_id);
       
if(isset($_POST['update_donate']))
{

	$donate_title = strip_tags($_POST['donate_title']);
	$donate_description = $_POST['donate_description'];
        $donate_button_text = $_POST['donate_button_text'];
        $donate_button_link = $_POST['donate_button_link'];
       
        
	$donate_image = $_FILES['donate_image'];
        $donate_id = $_POST['did'];
        
        
        if($donate_title==""){
            $error = "Please insert Donate Title";
        }else{
            if($donate->update_save($donate_title,$donate_description,$donate_button_text,$donate_button_link,$donate_image,$donate_id)){
                $donate->redirect('donate_list.php');
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
            <h1 class="h3 mb-0 text-gray-800">Dashboard :: Update Donate</h1>
          </div>

<div class="card shadow">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Update Donate <?php echo $row['donate_id'];?></h6>
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
                      <input type="text" value="<?php echo $row['donate_title'];?>" name="donate_title" class="form-control form-control-user" placeholder="donate title">
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" value="<?php echo $row['donate_description'];?>" name="donate_description" class="form-control form-control-user" placeholder="Description">
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" value="<?php echo $row['donate_button_text'];?>" name="donate_button_text" class="form-control form-control-user" placeholder="Button Text ">
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" value="<?php echo $row['donate_button_link'];?>" name="donate_button_link" class="form-control form-control-user" placeholder="Button Link ">
                  </div>
                    </div>
                
                    
                <div class="form-group row">
                    <label> Donate Image</label>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                      <img src="uploads/<?php echo $row['donate_image'];?>" />
                      <input type="file" name="donate_image" class="form-control form-control-user" >
                  </div>
                  
                </div>
                    <input type="hidden" value="<?php echo $row['donate_id'];?>" name="did" />
                  <input type="submit" class="btn btn-primary btn-user btn-block" value="Update" name="update_donate">
                  
                <hr>
                
              </form>
            </div>
          </div>
          </div>

        
        </div>


   
<?php 
include './includes/footer.php';
?>