<?php
require_once("session.php");
require_once("./classes/class.gallery.php");
$gallerys = new GALLERYS();

$gallery_id = $_GET['gaid'];

$row = $gallerys->update($gallery_id);

if (isset($_POST['update_gallery'])) {

    $gallery_title = strip_tags($_POST['gallery_title']);
    $gallery_custom_title = $_POST['gallery_custom_title'];
    $gallery_new_window = $_POST['gallery_new_window'];



    $gallery_image = $_FILES['gallery_image'];
    $gallery_id = $_POST['gaid'];


    if ($gallery_title == "") {
        $error = "Please insert Gallery Title";
    } else {
        if ($gallerys->update_save($gallery_title, $gallery_custom_title, $gallery_image, $gallery_new_window, $gallery_id)) {
            $gallerys->redirect('gallery_list.php');
            $success = "Updated Successfully";
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
        <h1 class="h3 mb-0 text-gray-800">Dashboard :: Update Gallery</h1>
    </div>

    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update About us <?php echo $row['gallery_id']; ?></h6>
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

                <div id="success">
                    <?php
                    if (isset($success)) {
                        ?>
                        <div class="alert alert-success">
                            <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $success; ?> !
                        </div>
                        <?php
                    }
                    ?>
                </div> 

                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" value="<?php echo $row['gallery_title']; ?>" name="gallery_title" class="form-control form-control-user" placeholder="gallery title">
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" value="<?php echo $row['gallery_custom_title']; ?>" name="gallery_custom_title" class="form-control form-control-user" placeholder="custom title">
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" value="<?php echo $row['gallery_new_window']; ?>" name="gallery_new_window" class="form-control form-control-user" placeholder="New window">
                    </div>

                </div>



                <div class="form-group row">
                    <label> Gallery Image</label>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <img src="uploads/<?php echo $row['gallery_image']; ?>" />
                        <input type="file" name="gallery_image" class="form-control form-control-user" >
                    </div>

                </div>
                <input type="hidden" value="<?php echo $row['gallery_id']; ?>" name="gaid" />
                <input type="submit" class="btn btn-primary btn-user btn-block" value="Update" name="update_gallery">

                <hr>

            </form>
        </div>
    </div>
</div>


</div>



<?php
include './includes/footer.php';
?>