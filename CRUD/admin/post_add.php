<?php
require_once("session.php");

require_once("./classes/class.posts.php");
$posts = new POSTS();

$allcat = $posts->selectAllCat();

if (isset($_POST['add_post'])) {


    $post_title = strip_tags($_POST['post_title']);
    $post_description = $_POST['post_description'];
    $postcat_id = $_POST['postcat_id'];
    $post_image = $_FILES['post_image'];

   

    if ($post_title == "") {
        $error = "Please insert Title";
    } elseif ($postcat_id == "") {
        $error = "Please insert Category";
    } else {
        if ($posts->addpost($post_title,$post_description,$postcat_id,$post_image)) {
            $posts->redirect('post_list.php');
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
        <h1 class="h3 mb-0 text-gray-800">Dashboard :: Add new Post</h1>
    </div>

    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Post</h6>
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
                        <input type="text" name="post_title" class="form-control form-control-user" placeholder="post_title">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <textarea name="post_description" rows="10"  class="form-control" placeholder="Post Description"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label>Post Category</label>
                        <br/>
                        <select name="postcat_id" class="form-control">
                            <option selected> --- Select Post Category --- </option>
                            <?php foreach($allcat as $cat){?>
                            <option value="<?php echo $cat['postcat_id']; ?>"><?php echo $cat['postcat_title']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label> Featured Image</label>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="file" name="post_image" class="form-control form-control-user" >
                    </div>

                </div>
                <input type="submit" class="btn btn-primary btn-user btn-block" value="Add New Post" name="add_post">

                <hr>

            </form>
        </div>
    </div>
</div>


</div>



<?php
include './includes/footer.php';
?>