<?php
require_once("session.php");

require_once("./classes/class.posts.php");
$posts = new POSTS();

if (isset($_POST['add_cat'])) {


    $postcat_title = strip_tags($_POST['postcat_title']);
    $postcat_desctiption = $_POST['postcat_desctiption'];
    $postcat_image = $_FILES['postcat_image'];

   //$postcat_title,$postcat_desctiption,$postcat_image

    if ($postcat_title == "") {
        $error = "Please insert Title";
    } else {
        if ($posts->addcat($postcat_title,$postcat_desctiption,$postcat_image)) {
            $posts->redirect('category_list.php?page_name=catelist');
        } else {
            $error = "something wrong";
        }
    }
}
?>
<?php
include './includes/header.php';
?>




<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard :: Add new Category</h1>
    </div>

    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Category</h6>
        </div>
        <div class="card-body">
            <form class="user" method="POST" enctype="multipart/form-data" >

                <div id="error">
<?php
if (isset($error)) {
    ?>
                        <div class="alert alert-danger">
                            <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                        </div>
                        <?php
                    }
                    ?>
                </div> 
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" name="postcat_title" class="form-control form-control-user" placeholder="Category Title">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <textarea name="postcat_desctiption" rows="10"  class="form-control" placeholder="Category Description"></textarea>
                    </div>
                </div>
                

                <div class="form-group row">
                    <label> Category Image</label>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="file" name="postcat_image" class="form-control form-control-user" >
                    </div>

                </div>
                <input type="submit" class="btn btn-primary btn-user btn-block" value="Add New Category" name="add_cat">

                <hr>

            </form>
        </div>
    </div>
</div>


</div>



<?php
include './includes/footer.php';
?>