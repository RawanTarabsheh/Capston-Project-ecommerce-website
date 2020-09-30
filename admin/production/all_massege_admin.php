<?php  ob_start();
require_once('include/vendor_header.php'); 
require_once('include/database.php');
require_once('include/vendor.php');
require_once('include/vendor_messag.php');
         // get database connection
$database       = new Database();
$db             = $database->getConnection();
$vendor         = new Vendor($db);
$vendor_message = new Vendor_message($db);
$vendor_message->vendor_id=$_SESSION['vendor_id'];
$stmt2=$vendor_message->read();
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
           
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Messages Page</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                             <div class="col-md-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Contact Us <small>Messages</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                   
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <ul class="list-unstyled msg_list">
                      <?php 
                    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                       extract($row2); 
                       $vendor->id=$_SESSION['vendor_id'];
                       $vendor->read_vendor_id();
                    ?>
                    <li>
                      <a>
                        <span class="image">
                          <img src="images/vendor/<?php echo $vendor->image; ?>" alt="img" style="width: 90px;height: 90px;" />
                        </span>
                        <span>
                          <span><?php echo $title;?><span>
                          <span class="time"><?php echo $date;?></span>
                        </span>
                        <span class="message">
                          <?php echo $message;?>
                        </span>
                      </a>
                    </li>
 <?php } ?>
        
                  </ul>
                </div>
              </div>
            </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

    <?php    require_once('include/admin_footer.php'); ?>
