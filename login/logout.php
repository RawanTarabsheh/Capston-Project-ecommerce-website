<?php session_start();
if(isset($_SESSION['customer_id'])){
// delete certain session
unset($_SESSION['customer_id']);
// Jump to login page
header('Location:../index.php');
}


