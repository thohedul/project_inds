<?php
require_once("session.php");
require_once("./classes/class.slider.php");
$slider = new SLIDER();

$slide_id = $_GET['sid'];

$row = $slider->details($slide_id);

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
              <h6 class="m-0 font-weight-bold text-primary">Group Details -- <?php echo $row['slide_id']; ?> </h6>
            </div>
            <div class="card-body">
                <h4> Slider Title : <?php echo $row['slide_title']; ?></h4>
                 <p>Slider Description : <?php echo $row['slide_description']; ?></p>
                 <p>Slider image : 
                     <img width="200px" src="uploads/<?php echo $row['slide_image']; ?>" alt="<?php echo $row['slide_name']; ?>" />
                 </p>
                 
                 <h4>Created Date : <?php 
                $date = $row['slide_insert_date'];
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