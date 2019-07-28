<?php
require_once("session.php");
require_once("./classes/class.page.php");
$pages = new PAGES();

$page_id = $_GET['pid'];

$row = $pages->details($page_id);

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
              <h6 class="m-0 font-weight-bold text-primary">Page Details -- <?php echo $row['page_id']; ?> </h6>
            </div>
            <div class="card-body">
                <h4> pages Title : <?php echo $row['page_title']; ?></h4>
                 <p>pages Description : <?php echo $row['page_description']; ?></p>
                 <p>pages image : 
                     <img width="200px" src="uploads/<?php echo $row['page_image']; ?>" alt="<?php echo $row['page_name']; ?>" />
                 </p>
                 
                 <h4>Created Date : <?php 
                $date = $row['page_insert_date'];
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