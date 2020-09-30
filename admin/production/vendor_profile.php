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
$order_num    = $order->countAll();
$product->vendor_id=$_SESSION['vendor_id'];
$product_num  = $product->countAll_vid();
$subcat_num   = $sub_category->countAll();
$cat_num      = $category->countAll();

?>

       
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row" style="display: inline-block;" >
          <div class="tile_count">
            
          </div>
        </div>
<?php 
 $vendor->id=$_SESSION['vendor_id'];
  $vendor->read_vendor_id();
?>
          <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Your Profile </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3  profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="images/vendor/<?php echo $vendor->image; ?>" alt="Avatar" title="Change the avatar" style=" width: 250px; height: 253px;border-radius: 15%;
}">
                        </div>
                      </div>
                      <h3><?php echo $vendor->name;?></h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $vendor->address;?>
                        </li>

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> <?php echo $vendor->email;?>
                        </li>

                        <li class="m-top-xs">
                          <i class="fa fa-external-link user-profile-icon"></i><?php echo $vendor->phone;?>
                        </li>
                      </ul>

                      <br />

                      

                    </div>
                  </div>
                  </div>
                </div>
              </div></div>

        <!-- /page content -->
<?php    require_once('include/vendor_footer.php'); ?>
