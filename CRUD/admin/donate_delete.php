<?php
require_once("session.php");
require_once("./classes/class.donate.php");
$donate = new DONATE();

$id = $_GET['did'];


$delete = $donate->delete_donate($id);
if($delete){
    $donate->redirect("donate_list.php");
}



?>
