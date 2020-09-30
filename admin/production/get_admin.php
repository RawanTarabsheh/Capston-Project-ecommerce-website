<?php ob_start();
require_once('include/database.php');
require_once('include/admin.php');
//header("Content-Type: Application/json");
	if(isset($_POST['email'])){
		         // get database connection
$database        = new Database();
$db              = $database->getConnection();
$admin           = new Admin($db);
$admin->email    = $_POST['email'];
if($admin->check_email())
echo "done";
else
echo "no";
}
?>