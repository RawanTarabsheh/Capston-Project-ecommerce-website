<?php session_start();
if(isset($_SESSION['admin_id'])){
// delete certain session
unset($_SESSION['admin_id']);
// Jump to login page
header('Location:admin_login.php');}

if (isset($_SESSION['vendor_id'])) {
	// delete certain session
unset($_SESSION['vendor_id']);
// Jump to login page
header('Location:vendor_login.php');

}
?>
