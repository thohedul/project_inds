<?php
require_once("session.php");
require_once("./classes/class.posts.php");
$postsobj = new POSTS();

$id = $_GET['pid'];


$delete = $postsobj->delete_post($id);
if($delete){
    $postsobj->redirect("post_list.php");
}



?>
