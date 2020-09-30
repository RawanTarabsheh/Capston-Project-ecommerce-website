<?php  ob_start();
//require_once('include/admin_header.php'); 
require_once('include/database.php');
require_once('include/category.php');
         // get database connection
$database    = new Database();
$db          = $database->getConnection();
$category    = new Category($db);
if(isset($_POST['category_id'])){
 $category->id=$_POST['category_id'];
 $row= $category->read_category_id();
//print_r($row);
 echo json_encode($row);
}