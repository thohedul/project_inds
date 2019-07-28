<?php
require_once("session.php");
require_once("./classes/class.donate.php");
$donate = new DONATE();

$slide_id = $_GET['did'];

$row = $donate->details($donate_id);

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
              <h6 class="m-0 font-weight-bold text-primary">Group Details -- <?php echo $row['donate_id']; ?> </h6>
            </div>
            <div class="card-body">
                <h4> Donate Title : <?php echo $row['donate_title']; ?></h4>
                 <p>Donate Description : <?php echo $row['donate_description']; ?></p>
                 <p>Slider image : 
                     <img width="200px" src="uploads/<?php echo $row['donate_image']; ?>" alt="<?php echo $row['donate_name']; ?>" />
                 </p>
                 
                 <h4>Created Date : <?php 
                $date = $row['donate_insert_date'];
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