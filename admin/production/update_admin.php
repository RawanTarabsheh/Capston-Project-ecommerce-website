<?php  ob_start();
//require_once('include/admin_header.php'); 
require_once('include/database.php');
require_once('include/admin.php');
         // get database connection
$database = new Database();
$db       = $database->getConnection();
$admin    =new admin($db);
if(isset($_POST['admin_id'])){
 $admin->id=$_POST['admin_id'];
 $row= $admin->read_admin_id();
//print_r($row);
 echo json_encode($row);
}