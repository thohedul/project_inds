<?php

	require_once("session.php");
	
	require_once("./classes/class.usergroup.php");
	$usergroup = new USERGROUP();
	
	$stmt = $usergroup->runQuery("SELECT * FROM groups");
	$stmt->execute();
	$groups=$stmt->fetchAll(PDO::FETCH_ASSOC);
//        echo "<pre>";
//        print_r($groups);

?>
<?php 
include './includes/header.php';
?>

        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

<div class="card shadow">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">User Table</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>ID</th>
                      <th>Image</th>
                      <th>Group Name</th>
                      <th>Group Description</th>
                    
                      <th style="width:160px">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Group Name</th>
                      <th>Group Description</th>
                    
                      <th style="width:160px">Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      
                    <?php 
                      foreach ($groups as $group){
                    ?>  
                    <tr>
                      <td><?=$group['group_id']; ?></td>
                      <td>
                          <img src="uploads/<?=$group['group_image']; ?>" width="100" />
                          
                      </td>
                      <td><?=$group['group_name']; ?></td>
                      <td><?=$group['group_des']; ?></td>
                      <td>
                          <a href="group_details.php?gid=<?=$group['group_id']; ?>" class="btn btn-primary btn-circle "><i class="fas fa-info-circle" ></i></a>
                          <a href="group_update.php?gid=<?=$group['group_id']; ?>" class="btn btn-info btn-circle"><i class="fas fa-edit" ></i></a>
                          <a href="group_delete.php?gid=<?=$group['group_id']; ?>" class="btn btn-danger btn-circle"><i class="fas fa-trash" ></i></a>
                      </td>
                    </tr>
                      <?php } ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          </div>

        
        </div>


   
<?php 
include './includes/footer.php';
?>