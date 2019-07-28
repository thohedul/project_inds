<?php
require_once("session.php");

require_once("./classes/class.settings.php");
$settings = new SETTINGS();

$id = 1;
$row = $settings->update($id);

if (isset($_POST['add_settings'])) {


    $setting_tagline = strip_tags($_POST['setting_tagline']);
    $setting_logo = $_FILES['setting_logo'];
    $setting_phone = $_FILES['setting_phone'];
    $setting_facebook = strip_tags($_POST['setting_facebook']);
    $setting_rss = strip_tags($_POST['setting_rss']);
    $setting_twitter = strip_tags($_POST['setting_twitter']);
    $setting_linkedin = strip_tags($_POST['setting_linkedin']);
    $setting_google = strip_tags($_POST['setting_google']);
    $setting_copyright = strip_tags($_POST['setting_copyright']);
    $setting_googlemap = $_POST['setting_googlemap'];
    $setting_footertext = strip_tags($_POST['setting_footertext']);
    
    

   

    if ($setting_tagline == "") {
        $error = "Please insert Tagline";
    } elseif ($setting_facebook == "") {
        $error = "Please insert Facebook";
    } else {
        if ($settings->addsettings($setting_tagline,$setting_logo,$setting_phone,$setting_facebook,$setting_rss, 
                $setting_twitter,$setting_linkedin,$setting_google,$setting_copyright,
                    $setting_googlemap,$setting_footertext,$id)) {
            
            $success = "Successfully Updated";
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
        <h1 class="h3 mb-0 text-gray-800">Dashboard :: Settings</h1>
    </div>

    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Settings</h6>
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
                            if(isset($success))
                                        {
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
                        <input type="text" name="setting_tagline" value="<?php echo $row['setting_tagline'];?>" class="form-control form-control-user" placeholder="Tagline">
                    </div>
                </div>
                
                

                <div class="form-group row">
                    <div class="col-lg-6">
                        <label> Logo</label>
                        <img src="uploads/<?php echo $row['setting_logo'];?>" />
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="file" name="setting_logo" class="form-control form-control-user" >
                    </div>
                    </div>
<div class="col-lg-6">
                        <label> Phone</label>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <img src="uploads/<?php echo $row['setting_phone'];?>" />
                        <input type="file" name="setting_phone" class="form-control form-control-user" >
                    </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" name="setting_facebook"  value="<?php echo $row['setting_facebook'];?>"  class="form-control form-control-user" placeholder="Facebook">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" name="setting_rss"  value="<?php echo $row['setting_rss'];?>"  class="form-control form-control-user" placeholder="RSS">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" name="setting_twitter"  value="<?php echo $row['setting_twitter'];?>"  class="form-control form-control-user" placeholder="Twitter">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" name="setting_linkedin"  value="<?php echo $row['setting_linkedin'];?>"  class="form-control form-control-user" placeholder="Linkedin">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" name="setting_google"  value="<?php echo $row['setting_google'];?>"  class="form-control form-control-user" placeholder="Google">
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" name="setting_copyright"  value="<?php echo $row['setting_copyright'];?>"  class="form-control form-control-user" placeholder="CopyRight Text">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <?php echo $row['setting_googlemap'];?>
                        <input type="text" name="setting_googlemap"  class="form-control form-control-user" placeholder="Google Map">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" name="setting_footertext"  value="<?php echo $row['setting_footertext'];?>"  class="form-control form-control-user" placeholder="Footer Text">
                    </div>
                </div>
                
                <input type="submit" class="btn btn-primary btn-user btn-block" value="Add Settings" name="add_settings">

                <hr>

            </form>
        </div>
    </div>
</div>


</div>



<?php
include './includes/footer.php';
?>