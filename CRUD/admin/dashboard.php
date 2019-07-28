<?php

	require_once("session.php");
	
	require_once("./classes/class.user.php");
	$auth_user = new USER();
	
	
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

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
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Age</th>
                      <th>Register Date</th>
                      <th style="width:160px">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Age</th>
                      <th>Register Date</th>
                      <th  style="width:160px">Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>
                      <td>Tiger Nixon</td>
                      <td>email@e.com</td>
                      <td>7894566546</td>
                      <td>61</td>
                      <td>2011/04/25</td>
                      <td>
                          <a href="./" class="btn btn-primary btn-circle "><i class="fas fa-info-circle" ></i></a>
                          <a href="./" class="btn btn-secondary btn-circle"><i class="fas fa-exclamation-triangle" ></i></a>
                          <a href="./" class="btn btn-info btn-circle"><i class="fas fa-edit" ></i></a>
                          <a href="./" class="btn btn-danger btn-circle"><i class="fas fa-trash" ></i></a>
                      </td>
                    </tr><tr>
                      <td>Tiger Nixon</td>
                      <td>email@e.com</td>
                      <td>7894566546</td>
                      <td>61</td>
                      <td>2011/04/25</td>
                      <td>
                          <a href="./" class="btn btn-primary btn-circle "><i class="fas fa-info-circle" ></i></a>
                          <a href="./" class="btn btn-secondary btn-circle"><i class="fas fa-exclamation-triangle" ></i></a>
                          <a href="./" class="btn btn-primary btn-circle"><i class="fas fa-info-circle" ></i></a>
                          <a href="./" class="btn btn-danger btn-circle"><i class="fas fa-trash" ></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>Tiger Nixon</td>
                      <td>email@e.com</td>
                      <td>7894566546</td>
                      <td>61</td>
                      <td>2011/04/25</td>
                      <td>
                          <a href="./" class="btn btn-primary btn-circle "><i class="fas fa-info-circle" ></i></a>
                          <a href="./" class="btn btn-secondary btn-circle"><i class="fas fa-exclamation-triangle" ></i></a>
                          <a href="./" class="btn btn-primary btn-circle"><i class="fas fa-info-circle" ></i></a>
                          <a href="./" class="btn btn-danger btn-circle"><i class="fas fa-trash" ></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>Tiger Nixon</td>
                      <td>email@e.com</td>
                      <td>7894566546</td>
                      <td>61</td>
                      <td>2011/04/25</td>
                      <td>
                          <a href="./" class="btn btn-primary btn-circle "><i class="fas fa-info-circle" ></i></a>
                          <a href="./" class="btn btn-secondary btn-circle"><i class="fas fa-exclamation-triangle" ></i></a>
                          <a href="./" class="btn btn-primary btn-circle"><i class="fas fa-info-circle" ></i></a>
                          <a href="./" class="btn btn-danger btn-circle"><i class="fas fa-trash" ></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>Tiger Nixon</td>
                      <td>email@e.com</td>
                      <td>7894566546</td>
                      <td>61</td>
                      <td>2011/04/25</td>
                      <td>
                          <a href="./" class="btn btn-primary btn-circle "><i class="fas fa-info-circle" ></i></a>
                          <a href="./" class="btn btn-secondary btn-circle"><i class="fas fa-exclamation-triangle" ></i></a>
                          <a href="./" class="btn btn-primary btn-circle"><i class="fas fa-info-circle" ></i></a>
                          <a href="./" class="btn btn-danger btn-circle"><i class="fas fa-trash" ></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>Tiger Nixon</td>
                      <td>email@e.com</td>
                      <td>7894566546</td>
                      <td>61</td>
                      <td>2011/04/25</td>
                      <td>
                          <a href="./" class="btn btn-primary btn-circle "><i class="fas fa-info-circle" ></i></a>
                          <a href="./" class="btn btn-secondary btn-circle"><i class="fas fa-exclamation-triangle" ></i></a>
                          <a href="./" class="btn btn-primary btn-circle"><i class="fas fa-info-circle" ></i></a>
                          <a href="./" class="btn btn-danger btn-circle"><i class="fas fa-trash" ></i></a>
                      </td>
                    </tr>
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