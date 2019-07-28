<?php
require_once("session.php");
require_once("./classes/class.gallery.php");
$gallerys = new GALLERYS();

$id = $_GET['gaid'];


$delete = $gallerys->delete_gallerys($id);
if($delete){
    $gallerys->redirect("gallery_list.php");
}



?>
