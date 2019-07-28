<?php

	require_once("session.php");
	
	require_once("./classes/class.doccat.php");
	$doccat = new DOCCAT();
	

        
if(isset($_POST['add_dc']))
{

	
	$dcat_name = strip_tags($_POST['dcat_name']);
	$dcat_desctiption = strip_tags($_POST['dcat_desctiption']);
	
        
        if($dcat_name==""){
            $error = "Please insert Category Name";
        }elseif($dcat_desctiption==""){
            $error = "Please insert Category Description";
        }else{
            if($doccat->adddoccat($dcat_name, $dcat_desctiption)){
                $doccat->redirect('dc_list.php');
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
            <h1 class="h3 mb-0 text-gray-800">Dashboard :: Add new Category</h1>
          </div>

<div class="card shadow">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Add New Category</h6>
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
                      <input type="text" name="dcat_name" class="form-control form-control-user" id="exampleFirstName" placeholder="Category Name">
                  </div>
                  
                </div>
                <div class="form-group">
                    <input type="text" name="dcat_desctiption" class="form-control form-control-user" id="exampleInputEmail" placeholder="Category Description">
                </div>
                
                  <input type="submit" class="btn btn-primary btn-user btn-block" value="Add New Category" name="add_dc">
                  
                <hr>
                
              </form>
            </div>
          </div>
          </div>

        
        </div>


   
<?php 
include './includes/footer.php';
?>