<?php
 ob_start();
session_start();
   require_once('include/header.php');
   require_once('admin/production/include/database.php');
   require_once('admin/production/include/category.php');
   require_once('admin/production/include/sub_category.php');
   require_once('admin/production/include/product.php');
if(!isset($_SESSION['number']))
    $_SESSION['number']=1;
else
    $_SESSION['number']++;
         // get database connection
$database     = new Database();
$db           = $database->getConnection();
$category     = new Category($db);
$sub_category = new Sub_Category($db);
$product      = new Product($db);
$stmt     = $category->read_menu();
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cozy Fashion</title>
    <link rel="icon" href="img/logo.png" type="image/ico" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="stylesheet" href="css/custom.css" type="text/css">

    <style type="text/css">
        .header{height: 100px !important;}
        .logo {
  display: inline-block;
  margin: 0 0.5rem;

  animation: bounce; /* referring directly to the animation's @keyframe declaration */
  animation-duration: 2s; /* don't forget to set a duration! */
}
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
            <li><a href="#"><span class="icon_heart_alt"></span>
                <div class="tip">2</div>
            </a></li>
            <li><a href="#"><span class="icon_bag_alt"></span>
                <div class="tip">2</div>
            </a></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="./index.php"><img src="img/logo.png" alt="" class="logo"></a>
        </div>
        <?php
        if(isset($_SESSION['customer_id']))
{
   $out='<div style="margin-top:-9px !important;"> <a href="login/logout.php" class="btn btn-white btn-animate" style="margin-bottom:2px !important; border: solid 2px;">SingOut</a> </div>' ;
}
else
$out=' <div style="margin-top:-9px !important;"><a href="login/login.php"  class="btn btn-white btn-animate" style="margin-bottom:2px !important;border: solid 2px;">SingIn</a></div>' ;
        ?>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
           <?php echo $out;?>
            
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo" style="padding: 0px !important;">
                        <a href="./index.php" class="logo"><img src="img/logo.png" alt="" style="margin-top: -45px;" ></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index.php">Home</a></li>
                            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                       extract($row);
                    ?>
                            <li><a href="shop.php?cat_id=<?php echo $category_id;?>"><?php echo $category_name;?></a></li>
                       
                           <?php }?>
                          <!--  <li><a href="./blog.html">Blog</a></li>-->
                            <li><a href="./contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__right">
                        <div class="header__right__auth">
           <?php echo $out;?>
                           
                        </div>
                                      <?php
if(!empty($_SESSION["favorite_pro"])) 
$fav_count = count($_SESSION["favorite_pro"]);
else
$fav_count=0;

if(!empty($_SESSION["shopping_cart"])) {
   
$cart_count = count(array_keys($_SESSION["shopping_cart"]));}
else
$cart_count=0;

?>
                        <ul class="header__right__widget">
                            <!--<li><span class="icon_search search-switch"></span></li>-->
                           <li><a href="shop-favorite.php"><span class="icon_profile"></span>
                                <div class="tip"><?php echo( $_SESSION['number'] ); ?></div>
                            </a></li>
                            <li><a href="shop-favorite.php"><span class="icon_heart_alt"></span>
                                <div class="tip"><?php echo $fav_count; ?></div>
                            </a></li>
                            <li><a href="shop-cart.php"><span class="icon_bag_alt"></span>
                                <div class="tip"><?php echo $cart_count; ?></div>
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->