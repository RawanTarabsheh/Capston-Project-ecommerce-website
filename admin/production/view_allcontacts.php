<?php  ob_start();
require_once('include/admin_header.php'); 
require_once('include/database.php');
require_once('include/admin.php');
require_once('include/contact_us.php');

         // get database connection
$database = new Database();
$db       = $database->getConnection();
$admin    = new Admin($db);
$contact    = new Contact_us($db);
if(isset($_SESSION['contact']))
unset($_SESSION['contact']);
$stmt= $contact->read(); 
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
                    <?php   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){  
                       extract($row);?>
                    <li>
                      <a>
                        <span class="image">
                          <img src="images/img.jpg" alt="img" />
                        </span>
                        <span>
                          <span><?php echo $contact_us_name;?></span>
                          <span class="time"><?php echo $date;?></span>
                        </span>
                        <span class="message">
                          <?php echo $contact_us_message;?>
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
