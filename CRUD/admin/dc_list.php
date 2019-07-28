<?php

	require_once("session.php");
	
	require_once("./classes/class.doccat.php");
	$doccat = new DOCCAT();
	
	$stmt = $doccat->runQuery("SELECT * FROM doccategory");
	$stmt->execute();
	$cats=$stmt->fetchAll(PDO::FETCH_ASSOC);


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
              <h6 class="m-0 font-weight-bold text-primary">User Table</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>ID</th>
                     
                      <th>Category Name</th>
                      <th>Category Description</th>
                    
                      <th style="width:160px">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      
                      <th>Category Name</th>
                      <th>Category Description</th>
                    
                      <th style="width:160px">Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      
                    <?php 
                      foreach ($cats as $cat){
                    ?>  
                    <tr>
                      <td><?=$cat['dcat_id']; ?></td>
                      
                      <td><?=$cat['dcat_name']; ?></td>
                      <td><?=$cat['dcat_desctiption']; ?></td>
                      <td>
                          <a href="details.php?detail_id=<?=$cat['dcat_id']; ?>" class="btn btn-primary btn-circle default"><i class="fas fa-info-circle" ></i></a>
                          <a href="./" class="btn btn-secondary btn-circle default"><i class="fas fa-exclamation-triangle" ></i></a>
                          <a href="./" class="btn btn-info btn-circle"><i class="fas fa-edit" ></i></a>
                          <a href="#" doc_id="<?=$cat['dcat_id']; ?>" class="btn btn-danger btn-circle delete"><i class="fas fa-trash" ></i></a>
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
                doccat_id = el.attr("doc_id");
                if(message){
                    //alert(doccat_id);
                    $.ajax({
                        url:"doccat_delete.php",
                        type:"post",
                        data : {id_x:doccat_id},
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