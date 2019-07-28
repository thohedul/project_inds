<?php
$active = "catlist";
	require_once("session.php");
	
	require_once("./classes/class.posts.php");
	$postsobj = new POSTS();
	
	$stmt = $postsobj->runQuery("SELECT * FROM postcategory");
	$stmt->execute();
	$cats=$stmt->fetchAll(PDO::FETCH_ASSOC);




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
              <h6 class="m-0 font-weight-bold text-primary">Category Table</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>ID</th>
                      <th>Image</th>
                      <th>Category Title</th>
                      <th style="width:160px">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <tr>
                        <th>ID</th>
                      <th>Image</th>
                      <th>Category Title</th>
                      <th style="width:160px">Action</th>
                    </tr>
                    </tr>
                  </tfoot>
                  <tbody>
                      
                    <?php 
                      foreach ($cats as $cat){
                    ?>  
                    <tr>
                      <td><?=$cat['postcat_id']; ?></td>
                      <td>
                          <img src="uploads/<?=$cat['postcat_image']; ?>" width="100" />
                          
                      </td>
                      <td><?=$cat['postcat_title']; ?></td>
                      
                      <td>
                          <a href="post_details.php?pid=<?=$cat['postcat_id']; ?>" class="btn btn-primary btn-circle "><i class="fas fa-info-circle" ></i></a>
                          <a href="post_update.php?pid=<?=$cat['postcat_id']; ?>" class="btn btn-info btn-circle"><i class="fas fa-edit" ></i></a>
                          <a href="post_delete.php?pid=<?=$cat['postcat_id']; ?>" class="btn btn-danger btn-circle"><i class="fas fa-trash" ></i></a>
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