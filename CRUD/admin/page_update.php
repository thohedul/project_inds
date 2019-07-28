<?php
require_once("session.php");
require_once("./classes/class.page.php");
$pages = new PAGES();
	
$page_id = $_GET['pid'];

$row = $pages->update($page_id);
       
if(isset($_POST['update_page']))
{

	$page_title = strip_tags($_POST['page_title']);
	$page_description = $_POST['page_description'];
        $page_category = $_POST['page_category'];
        $page_slug = $_POST['page_slug'];       
	$page_image = 	$_FILES['page_image'];
        $page_id = $_POST['pid'];
        
        
        if($page_title==""){
            $error = "Please insert Page Title";
        }else{
            if($pages->update_save($page_title,$page_description,$page_category,$page_slug,$page_image,$page_id)){
                $pages->redirect('page_list.php');
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
            <h1 class="h3 mb-0 text-gray-800">Dashboard :: Update page</h1>
          </div>

<div class="card shadow">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Update page <?php echo $row['page_id'];?></h6>
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
                      <input type="text" value="<?php echo $row['page_title'];?>" name="page_title" class="form-control form-control-user" placeholder="page title">
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <textarea name="page_description" class="form-control" placeholder="page description">
                          <?php echo $row['page_description'];?>
                      </textarea>
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" value="<?php echo $row['page_category'];?>" name="page_category" class="form-control form-control-user" placeholder="page category ">
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" value="<?php echo $row['page_slug'];?>" name="page_slug" class="form-control form-control-user" placeholder="page slug ">
                  </div>
                  
                </div>
                   
                
                   
                    
                <div class="form-group row">
                    <label> Slide Image</label>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                      <img src="uploads/<?php echo $row['page_image'];?>" />
                      <input type="file" name="page_image"  width="100" class="form-control form-control-user" >
                  </div>
                  
                </div>
                    <input type="hidden" value="<?php echo $row['page_id'];?>" name="pid" />
                  <input type="submit" class="btn btn-primary btn-user btn-block" value="Update" name="update_page">
                  
                <hr>
                
              </form>
            </div>
          </div>
          </div>

        
        </div>


   
<?php 
include './includes/footer.php';
?>