<?php
require_once("session.php");
require_once("./classes/class.usergroup.php");
$usergroup = new USERGROUP();

$id = $_GET['gid'];


$delete = $usergroup->delete_group($id);
if($delete){
    $usergroup->redirect("group_list.php");
}



?>
