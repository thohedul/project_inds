<?php
require_once("session.php");
require_once("./classes/class.gallery.php");
$gallerys = new GALLERYS();

$gallery_id = $_GET['gaid'];

$row = $gallerys->details($gallery_id);

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
              <h6 class="m-0 font-weight-bold text-primary">Gallery Details -- <?php echo $row['gallery_id']; ?> </h6>
            </div>
            <div class="card-body">
                <h4> Gallery us Title : <?php echo $row['gallery_title']; ?></h4>
                 <p>Gallery Custom title : <?php echo $row['gallery_custom_title']; ?></p>
                 <p>Gallery image : 
                     <img width="200px" src="uploads/<?php echo $row['gallery_image']; ?>" alt="<?php echo $row['gallery_name']; ?>" />
                 </p>
                 
                 <h4>Created Date : <?php 
                $date = $row['gallery_insert_date'];
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