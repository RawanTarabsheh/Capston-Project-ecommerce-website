<?php  ob_start();
//require_once('include/admin_header.php'); 
require_once('include/database.php');
require_once('include/product.php');
         // get database connection
$database    = new Database();
$db          = $database->getConnection();
$product    = new Product($db);
if(isset($_POST['product_id'])){
 $product->id=$_POST['product_id'];
 $row= $product->read_product_id();
//print_r($row);
 echo json_encode($row);
}