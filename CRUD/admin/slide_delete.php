<?php
require_once("session.php");
require_once("./classes/class.slider.php");
$slider = new SLIDER();

$id = $_GET['sid'];


$delete = $slider->delete_slide($id);
if($delete){
    $slider->redirect("slide_list.php");
}



?>
