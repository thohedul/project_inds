<?php
require_once("session.php");
require_once("./classes/class.aboutus.php");
$aboutes = new ABOUTES();

$id = $_GET['aid'];


$delete = $aboutes->delete_aboutes($id);
if($delete){
    $aboutes->redirect("aboutus_list.php");
}



?>
