<?php

	require_once("session.php");
	
	require_once("./classes/class.donate.php");
	$donate = new DONATE();
	
	$stmt = $donate->runQuery("SELECT * FROM donate");
	$stmt->execute();
	$donates=$stmt->fetchAll(PDO::FETCH_ASSOC);
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
              <h6 class="m-0 font-weight-bold text-primary">Donate Table</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>ID</th>
                      <th>Image</th>
                      <th>Donate Name</th>
                      <th>Donate Description</th>
                    
                      <th style="width:160px">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Donate Name</th>
                      <th>Donate Description</th>
                    
                      <th style="width:160px">Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      
                    <?php 
                      foreach ($donates as $donate){
                    ?>  
                    <tr>
                      <td><?=$donate['donate_id']; ?></td>
                      <td>
                          <img src="uploads/<?=$donate['donate_image']; ?>" width="100" />
                          
                      </td>
                      <td><?=$donate['donate_title']; ?></td>
                      <td><?=$donate['donate_description']; ?></td>
                      <td>
                          <a href="donate_details.php?did=<?=$donate['donate_id']; ?>" class="btn btn-primary btn-circle "><i class="fas fa-info-circle" ></i></a>
                          <a href="donate_update.php?did=<?=$donate['donate_id']; ?>" class="btn btn-info btn-circle"><i class="fas fa-edit" ></i></a>
                          <a href="donate_delete.php?did=<?=$donate['donate_id']; ?>" class="btn btn-danger btn-circle"><i class="fas fa-trash" ></i></a>
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