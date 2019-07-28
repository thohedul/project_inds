<?php
require_once("session.php");
require_once("./classes/class.page.php");
$pages = new PAGES();

$id = $_GET['pid'];


$delete = $pages->delete_page($id);
if($delete){
    $pages->redirect("page_list.php");
}



?>
