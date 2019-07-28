<?php
session_start();
require_once 'classes/class.user.php';
$session = new USER();
if(!$session->is_loggedin())
{
   $session->redirect('index.php');
}