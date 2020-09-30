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
$order_num    = $order->countAll();
$product_num  = $product->countAll_active();
$subcat_num   = $sub_category->countAll();
$cat_num      = $category->countAll();

       if(isset($_POST['submit'])) {
          if(!empty($_POST['state']))
        $contact->state           = 1;
          else
        $contact->state           = 0; 

        $contact->product_id      = $_POST['product_id'];
        $contact->title           = $_POST['title'];
        $contact->desc            = $_POST['desc'];
     
       if($contact->create_banner()){
          header("Location:admin_index.php");
          }//crete 
         }//add new banner
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row" style="display: inline-block; margin-bottom: 350px;" >
          <div class="tile_count">
            <!--<div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Admin</span>
              <div class="count"><?php echo $admin_num; ?></div>
            </div>-->
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
             <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target=".bs-example-modal-lg"> <i class="fa fa-plus"></i> New Banner </button>
          </div>
            <div class="x_content">
                 
                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">New Banner</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        
                        <div class="modal-body">
                         <!-- page content -->
                         <div class="col-md-12 col-sm-12">
                          <div class="x_panel">

                            <div class="x_content">
                      
                          <form class="" action="" method="post" novalidate enctype="multipart/form-data">
                          </p>
                          <span class="section">Banner Info</span>
                          <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Title<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                              <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="title" placeholder="" required="required" />
                            </div>
                          </div>
                         
                                 <?php  $stmt=$product->read_banner();?>
                                <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">Product Name<span class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                     <select class="form-control" name="product_id" required="">
                                       <option value="">Choose Product</option>
                                       <?php 
                                         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                        extract($row);
                                        ?>
                                        <option value="<?php echo $product_id; ?>"><?php echo $product_name; ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                  </div>
                                  <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Description<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                      <textarea required="required" name='desc' style="width: 330px;height: 200px;"></textarea></div>
                                    </div>
                                   
                                     
                                   <div class="checkbox">
                                    <label>
                                      <input type="checkbox" class="flat" checked="checked" name="state" > state
                                    </label>
                                  </div>
                                  <div class="ln_solid">
                                    <div class="form-group">
                                      <div class="col-md-6 offset-md-3">
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-success" name="submit">Save </button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          <!-- /page content -->
                        </div>
                      </div>
                    </div>
                </div>
              </div>
        </div>
          <!-- /top tiles -->


        <!-- /page content -->
<?php    require_once('include/admin_footer.php'); ?>
