<?php

	require_once("session.php");
	
	require_once("./classes/class.page.php");
	$pages = new PAGES();
	
	$stmt = $pages->runQuery("SELECT * FROM pages");
	$stmt->execute();
	$pagers=$stmt->fetchAll(PDO::FETCH_ASSOC);
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
              <h6 class="m-0 font-weight-bold text-primary">Page Table</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>ID</th>
                      <th>Image</th>
                      <th>page Name</th>
                      <th>page Description</th>
                    
                      <th style="width:160px">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>page Name</th>
                      <th>page Description</th>
                    
                      <th style="width:160px">Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      
                    <?php 
                      foreach ($pagers as $page){
                    ?>  
                    <tr>
                      <td><?=$page['page_id']; ?></td>
                      <td>
                          <img src="uploads/<?=$page['page_image']; ?>" width="100" />
                          
                      </td>
                      <td><?=$page['page_title']; ?></td>
                      <td><?=$page['page_description']; ?></td>
                      <td>
                          <a href="page_details.php?pid=<?=$page['page_id']; ?>" class="btn btn-primary btn-circle "><i class="fas fa-info-circle" ></i></a>
                          <a href="page_update.php?pid=<?=$page['page_id']; ?>" class="btn btn-info btn-circle"><i class="fas fa-edit" ></i></a>
                          <a href="page_delete.php?pid=<?=$page['page_id']; ?>" class="btn btn-danger btn-circle"><i class="fas fa-trash" ></i></a>
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
<script>
        jQuery(document).ready(function(){
            jQuery(".delete").on('click',function(e){
                e.preventDefault();
                el = $(this);
                message = confirm("Are you sure?");
                pages_id = el.attr("page_id");
                if(message){
                    //alert(doccat_id);
                    $.ajax({
                        url:"page_delete.php",
                        type:"post",
                        data : {id_x:pages_id},
                        success : function(res){
                            el.closest('tr').css("background","red");
                            el.closest('tr').hide(1000);
                        }
                    });
                }else{
                    alert("I have changed my mind.");
                }
            });
            
//            jQuery('.default').on("click",function(e){
//                e.preventDefault();
//            });
            
            
        })
        </script>