<?php  ob_start();
//require_once('include/admin_header.php'); 
require_once('include/database.php');
require_once('include/vendor.php');
         // get database connection
$database = new Database();
$db       = $database->getConnection();
$vendor    =new Vendor($db);
if(isset($_POST['vendor_id'])){
 $vendor->id=$_POST['vendor_id'];
 $row= $vendor->read_vendor_id();
//print_r($row);
 echo json_encode($row);
}