<?php  require_once('include/vendor_header.php'); 
require_once('include/database.php');
require_once('include/vendor.php');
require_once('include/customer.php');
require_once('include/order.php');
require_once('include/product.php');
require_once('include/sub_category.php');
require_once('include/category.php');
$database     = new Database();
$db           = $database->getConnection();
$vendor       = new Vendor($db);
$customer     = new Customer($db);
$order        = new Order($db);
$product      = new Product($db);
$sub_category = new  Sub_Category($db);
$category     = new Category($db);
$customer_num = $customer->countAll();
$vendor_num   = $vendor->countAll();
$order_num   = $order->countAll();
$product->vendor_id=$_SESSION['vendor_id'];
$product_num  = $product->countAll_vid();
$subcat_num = $sub_category->countAll();
$cat_num = $category->countAll();

?>

       
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row" style="display: inline-block;" >
          <div class="tile_count">
             <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Vendor</span>
              <div class="count"><?php echo $vendor_num;?></div>
            </div>
             <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Customer</span>
              <div class="count green"><?php echo $customer_num;?></div>
             
            </div>
           <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Orders</span>
              <div class="count"><?php echo $order_num; ?></div> 
            </div>
          <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Products</span>
              <div class="count"><?php echo $product_num;?></div>
            
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Category</span>
              <div class="count"><?php echo $cat_num;?></div>
             
            </div>
             <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Sub Category</span>
              <div class="count"><?php echo $subcat_num;?></div>
             
            </div>
          </div>
        </div>
</div>
<?php    require_once('include/vendor_footer.php'); ?>
