<?php

	require_once("session.php");
	
	require_once("./classes/class.posts.php");
	$postsobj = new POSTS();
	
	$stmt = $postsobj->runQuery("SELECT * FROM posts");
	$stmt->execute();
	$posts=$stmt->fetchAll(PDO::FETCH_ASSOC);


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
              <h6 class="m-0 font-weight-bold text-primary">Posts Table</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>ID</th>
                      <th>Image</th>
                      <th>Post Title</th>
                      <th>Post Category</th>
                      <th>Post Status</th>
                      <th>Publish Date</th>
                      <th style="width:160px">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Post Title</th>
                      <th>Post Category</th>
                      <th>Post Status</th>
                      <th>Publish Date</th>
                      <th style="width:160px">Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      
                    <?php 
                      foreach ($posts as $post){
                    ?>  
                    <tr>
                      <td><?=$post['post_id']; ?></td>
                      <td>
                          <img src="uploads/<?=$post['post_image']; ?>" width="100" />
                          
                      </td>
                      <td><?=$post['post_title']; ?></td>
                      <td><?php
                      $catname = $postsobj->selectcatname($post['postcat_id']);
                      echo $catname;
                      ?></td>
                      <td><?=$post['post_status']; ?></td>
                      <td><?=$post['post_insert_date']; ?></td>
                      <td>
                          <a href="post_details.php?pid=<?=$post['post_id']; ?>" class="btn btn-primary btn-circle "><i class="fas fa-info-circle" ></i></a>
                          <a href="post_update.php?pid=<?=$post['post_id']; ?>" class="btn btn-info btn-circle"><i class="fas fa-edit" ></i></a>
                          <a href="post_delete.php?pid=<?=$post['post_id']; ?>" class="btn btn-danger btn-circle"><i class="fas fa-trash" ></i></a>
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