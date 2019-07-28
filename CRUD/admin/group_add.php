<?php

	require_once("session.php");
	
	require_once("./classes/class.usergroup.php");
	$user_group = new USERGROUP();
	

        
if(isset($_POST['add_group']))
{

	$group_name = strip_tags($_POST['group_name']);
	$group_des = strip_tags($_POST['group_des']);
	$group_image = 	$_FILES['group_image'];

        
        if($group_name==""){
            $error = "Please insert Group Name";
        }elseif($group_des==""){
            $error = "Please insert Group Description";
        }else{
            if($user_group->addgroup($group_name,$group_des,$group_image)){
                $user_group->redirect('group_list.php');
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
            <h1 class="h3 mb-0 text-gray-800">Dashboard :: Add new Group</h1>
          </div>

<div class="card shadow">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Add New Group</h6>
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
                      <input type="text" name="group_name" class="form-control form-control-user" id="exampleFirstName" placeholder="Group Name">
                  </div>
                  
                </div>
                <div class="form-group">
                    <input type="text" name="group_des" class="form-control form-control-user" id="exampleInputEmail" placeholder="Group Description">
                </div>
                <div class="form-group row">
                    <label> Group Image</label>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="file" name="group_image" class="form-control form-control-user" >
                  </div>
                  
                </div>
                  <input type="submit" class="btn btn-primary btn-user btn-block" value="Add New Group" name="add_group">
                  
                <hr>
                
              </form>
            </div>
          </div>
          </div>

        
        </div>


   
<?php 
include './includes/footer.php';
?>