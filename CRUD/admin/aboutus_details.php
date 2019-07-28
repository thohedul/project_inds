<?php
require_once("session.php");
require_once("./classes/class.aboutus.php");
$aboutes = new ABOUTES();

$aboutes_id = $_GET['aid'];

$row = $aboutes->details($aboutes_id);

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
              <h6 class="m-0 font-weight-bold text-primary">About us Details -- <?php echo $row['aboutes_id']; ?> </h6>
            </div>
            <div class="card-body">
                <h4> About us Title : <?php echo $row['aboutes_title']; ?></h4>
                 <p>About us Description : <?php echo $row['aboutes_description']; ?></p>
                 <p>About us image : 
                     <img width="200px" src="uploads/<?php echo $row['aboutes_image']; ?>" alt="<?php echo $row['aboutes_name']; ?>" />
                 </p>
                 
                 <h4>Created Date : <?php 
                $date = $row['aboutes_insert_date'];
                echo date('F j, Y',strtotime($date));
                ?></h4>
                 </p>
            </div>
          </div>
          </div>

        
        </div>


   
<?php 
include './includes/footer.php';
?>