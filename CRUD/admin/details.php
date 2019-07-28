<?php
require_once("session.php");
require_once("./classes/class.doccat.php");
$doccat = new DOCCAT();

$id = $_GET['detail_id'];

$row = $doccat->details($id);
//echo "<pre>";
//print_r($row);
//echo "</pre>";        
  
        
?>
<?php 
include './includes/header.php';
?>




        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard :: <?php echo $row['dcat_name']?></h1>
          </div>

<div class="card shadow">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Details for <?php echo $row['dcat_name']?></h6>
            </div>
            <div class="card-body">
                <h4>Category Name : <?php echo $row['dcat_name'] ?></h4>
                <h4>Category Description : <?php echo $row['dcat_desctiption']?></h4>
                <h4>Created Date : <?php 
                $date = $row['insert_date'];
                echo date('F j, Y',strtotime($date));
                ?></h4>
            </div>
          </div>
          </div>

        
        </div>


   
<?php 
include './includes/footer.php';
?>