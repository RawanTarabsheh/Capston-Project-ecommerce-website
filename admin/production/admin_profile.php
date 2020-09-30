<?php  require_once('include/admin_header.php'); 
require_once('include/database.php');
require_once('include/admin.php');
require_once('include/vendor.php');
require_once('include/customer.php');
require_once('include/order.php');
require_once('include/product.php');
require_once('include/sub_category.php');
require_once('include/category.php');
         // get database connection
$database     = new Database();
$db           = $database->getConnection();
$admin        = new Admin($db);
$vendor       = new Vendor($db);
$customer     = new Customer($db);
$order        = new Order($db);
$product      = new Product($db);
$sub_category = new  Sub_Category($db);
$category     = new Category($db);
$contact      = new Contact_us($db);
$admin_num    = $admin->countAll();
$vendor_num   = $vendor->countAll();
$customer_num = $customer->countAll();
$order_num   = $order->countAll();
$product_num  = $product->countAll_active();
$subcat_num = $sub_category->countAll();
$cat_num = $category->countAll();

       if(isset($_POST['submit'])) {
          if(!empty($_POST['state']))
            $contact->state=1;
          else
         $contact->state=0; 
        $contact->product_id      = $_POST['product_id'];
        $contact->title           = $_POST['title'];
        $contact->desc           = $_POST['desc'];
     
       if($contact->create_banner()){
          header("Location:admin_index.php");

          }//crete 
         }//add new banner

?>

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row" style="display: inline-block; " >
          <div class="tile_count">
        
            <div class="x_content">
                 
                  
                </div>
              </div>
        </div>
          <!-- /top tiles -->
<?php 
 $admin->id=$_SESSION['admin_id'];
  $admin->read_admin_id();
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
                          <img class="img-responsive avatar-view" src="images/admin/<?php echo $admin->image; ?>" alt="Avatar" title="Change the avatar" style="width: 250px;
    height: 253px;
    border-radius: 15%;">
                        </div>
                      </div>
                      <h3><?php echo $admin->name;?></h3>

                      <ul class="list-unstyled user_data">
                        

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> <?php echo $admin->email;?>
                        </li>

                      </ul>

                      <br />

                      

                    </div>
                  </div>
                  </div>
                </div>
              </div></div>

        <!-- /page content -->
<?php    require_once('include/admin_footer.php'); ?>
