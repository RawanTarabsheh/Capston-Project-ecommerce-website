<?php ob_start();
require_once('include/database.php');
require_once('include/vendor.php');
//header("Content-Type: Application/json");
	if(isset($_POST['email'])){
		         // get database connection
$database        = new Database();
$db              = $database->getConnection();
$vendor           = new Vendor($db);
$vendor->email    = $_POST['email'];
if($vendor->check_email())
echo "done";
else
echo "no";
}
?>