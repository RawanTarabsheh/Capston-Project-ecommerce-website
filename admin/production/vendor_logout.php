<?php session_start();
// delete certain session
unset($_SESSION['vendor_id']);
// Jump to login page
header('Location:vendor_login.php');
