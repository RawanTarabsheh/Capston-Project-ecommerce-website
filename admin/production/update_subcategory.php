<?php  ob_start();
//require_once('include/admin_header.php'); 
require_once('include/database.php');
require_once('include/sub_category.php');
         // get database connection
$database    = new Database();
$db          = $database->getConnection();
$sub_category    = new Sub_Category($db);
if(isset($_POST['sub_cat_id'])){
 $sub_category->id=$_POST['sub_cat_id'];
 $row= $sub_category->read_sub_category_id();
//print_r($row);
 echo json_encode($row);
}