<?php
require_once("session.php");
require_once("./classes/class.usergroup.php");
$usergroup = new USERGROUP();

$group_id = $_GET['gid'];

$row = $usergroup->details($group_id);


//Array
//(
//    [group_id] => 4
//    [group_name] => group 1
//    [group_des] => Lorem ipsum dolor sit amet, consectetur adipiscing elit.
//    [group_image] => 44371554981131luis-suarez.JPG
//    [insert_date] => 2019-04-11 17:12:11
//    [update_date] => 0000-00-00 00:00:00
//)

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
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

<div class="card shadow">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Group Details -- <?php echo $row['group_id']; ?> </h6>
            </div>
            <div class="card-body">
                <h4> Group Name : <?php echo $row['group_name']; ?></h4>
                 <p>Group Description : <?php echo $row['group_des']; ?></p>
                 <p>Group image : 
                     <img width="200px" src="uploads/<?php echo $row['group_image']; ?>" alt="<?php echo $row['group_name']; ?>" />
                 </p>
                 
                 <h4>Created Date : <?php 
                $date = $row['insert_date'];
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