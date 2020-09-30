  <?php  ob_start();
   require_once('admin/production/include/database.php');
   require_once('admin/production/include/product.php');

         // get database connection
$database     = new Database();
$db           = $database->getConnection();
$product      = new Product($db);
if(isset($_POST['s'])){
  $s=$_POST['s'];
$stmt1=$product->search($s);

$resultArr=array();
while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
      $resultArr[count($resultArr)]=$resultArr+$row1;
       # code...
      }
   // $resultArr = array_shift($resultArr);
     echo json_encode($resultArr);
}
?>