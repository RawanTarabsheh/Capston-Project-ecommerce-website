<?php ob_start();
session_start();
require_once('include/database.php');
require_once('include/admin.php');
require_once('include/vendor.php');
         // get database connection
$database = new Database();
$db       = $database->getConnection();
$admin    = new Admin($db);
$vendor   = new Vendor($db);

if(isset($_GET['i']))
{
  if($_GET['i']==0){
if(isset($_SESSION['vendor_id'])) {
  $vendor->id=$_SESSION['vendor_id'];
  $vendor->read_vendor_id();
  $_SESSION['name'] =$vendor->name;
  $_SESSION['email']=$vendor->email;
  $_SESSION['image']="images/vendor/".$vendor->image;
  }
  else
     header("Location:vendor_login.php");
  }//end vendor
  else
  {
if(isset($_SESSION['admin_id'])){
  $admin->id=$_SESSION['admin_id'];
  $admin->read_admin_id();
  $_SESSION['name'] =$admin->name;
  $_SESSION['email']=$admin->email;
  $_SESSION['image']="images/admin/".$admin->image;
  }
  else
     header("Location:admin_login.php");

  }//admin
}
/*if(!isset($_SESSION['admin_id']))
{
 header("Location:admin_login.php");
}
if(!isset($_SESSION['vendor_id']))
{
 header("Location:vendor_login.php");
}
  if(isset($_SESSION['admin_id'])){
  $admin->id=$_SESSION['admin_id'];
  $admin->read_admin_id();
  $name=$admin->name;
  $email=$admin->email;
  $image=$admin->image;
  }
  elseif(isset($_SESSION['vendor_id'])) {
  $vendor->id=$_SESSION['vendor_id'];
  $vendor->read_vendor_id();
  $name=$vendor->name;
  $email=$vendor->email;
  $image=$vendor->image;
  }*/

  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="description" content="Discover the latest  fashion and modest women’s dresses online , men , kids,  at Brescia.com, with great prices and a return guarantee.">

    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Cozy Fashion | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
           <!-- <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title" style="color: red; font-size: 43px;" ><i class="fa fa-cogs " style="color: red; font-size: 43px;    margin-right: 6px;"></i>Breshcia</a>
            </div>-->
             <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Cozy Fashion</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo  $_SESSION['image']; ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $_SESSION['name']; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if(isset($_SESSION['admin_id'])){
                        echo ' <li><a href="index.php?i=1">Home</a></li>
                      <li><a href="manage_admin.php">Manage Admin</a></li>
                      <li><a href="manage_vendor.php">Manage Vendor</a></li>
                      <li><a href="manage_category.php">Manage Category</a></li>
                      <li><a href="manage_subcategory.php">Manage Sub Category</a></li>
                      <li><a href="manage_product.php">Manage Product</a></li>
                      <li><a href="manage_customer.php">Manage Customer</a></li>';
                      }
                      elseif(isset($_SESSION['vendor_id'])){
                        echo ' <li><a href="index.php?i=0">Home</a></li>
                        <li><a href="manage_product.php">Manage Product</a></li>';
                      }

                      ?>
              
                    </ul>
                  </li>

                </ul>
              </div>


            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="admin_logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo  $_SESSION['image'];?>" alt=""><?php echo $_SESSION['name'];?>
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="javascript:;"> Profile</a>
                    <a class="dropdown-item"  href="javascript:;">
                      <span class="badge bg-red pull-right">50%</span>
                      <span>Settings</span>
                    </a>
                    <a class="dropdown-item"  href="javascript:;">Help</a>
                    <a class="dropdown-item"  href="admin_logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">
                  <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <div class="text-center">
                        <a class="dropdown-item">
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->