<?php

	require_once("session.php");
	require_once("./classes/class.page.php");
	$pages = new PAGES();
	

        
if(isset($_POST['add_page']))
{

	
	$page_title = strip_tags($_POST['page_title']);
	$page_description = $_POST['page_description'];
        $page_category = $_POST['page_category'];
        $page_slug = $_POST['page_slug'];
       
        
	$page_image = 	$_FILES['page_image'];

        
        if($page_title==""){
            $error = "Please insert Title";
        }elseif($page_image==""){
            $error = "Please insert Image";
        }else{
            if($pages->addpage($page_title,$page_description,$page_category,$page_slug,$page_image)){
                $pages->redirect('page_list.php');
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
            <h1 class="h3 mb-0 text-gray-800">Dashboard :: Add new page</h1>
          </div>

<div class="card shadow">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Add New Page</h6>
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
                      <input type="text" name="page_title" class="form-control form-control-user" placeholder="page title">
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" name="page_description" class="form-control form-control-user" placeholder="page description">
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" name="page_category" class="form-control form-control-user" placeholder="page category ">
                  </div>
                  
                </div>
                    <div class="form-group row">
                  <div class="col-sm-12">
                      <input type="text" name="page_slug" class="form-control form-control-user" placeholder="page slug ">
                  </div>
                  
                </div>
                 
                <div class="form-group row">
                    <label> Page Image</label>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="file" name="page_image" class="form-control form-control-user" >
                  </div>
                  
                </div>
                  <input type="submit" class="btn btn-primary btn-user btn-block" value="Add New Page" name="add_page">
                  
                <hr>
                
              </form>
            </div>
          </div>
          </div>

        
        </div>


   
<?php 
include './includes/footer.php';
?>