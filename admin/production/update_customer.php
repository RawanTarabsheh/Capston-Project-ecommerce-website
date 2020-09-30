<?php  ob_start();
//require_once('include/admin_header.php'); 
require_once('include/database.php');
require_once('include/customer.php');
         // get database connection
$database = new Database();
$db       = $database->getConnection();
$customer    =new Customer($db);
if(isset($_POST['customer_id'])){
 $customer->id=$_POST['customer_id'];
 $row= $customer->read_customer_id();
//print_r($row);
 echo json_encode($row);
}