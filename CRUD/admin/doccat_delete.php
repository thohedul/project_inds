<?php
require_once("session.php");

$doccat_id = $_POST['doccat_id'];
require_once("./classes/class.doccat.php");
$doccat = new DOCCAT();
$stmt = $doccat->runQuery("DELETE FROM doccategory WHERE dcat_id=$doccat_id");
$delete = $stmt->execute();	
if($delete){
    //$doccat->redirect('dc_list.php');
    return True;
}
?>
