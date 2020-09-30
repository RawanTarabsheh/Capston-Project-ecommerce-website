<?php  ob_start();
   require_once('include/header.php');
   require_once('admin/production/include/database.php');
   require_once('admin/production/include/product.php');
   require_once('admin/production/include/customer.php');
   require_once('admin/production/include/order.php');
         // get database connection
$database   = new Database();
$db         = $database->getConnection();
$product    = new Product($db);
$customer   = new Customer($db);
$order      = new Order($db);
if(isset($_POST['place'])){
    if(isset($_POST['ok'])){
        $name                    =$_POST['fname']." ".$_POST['lname'];
        $addres                  =$_POST['address1']." - ".$_POST['address2']." - ".$_POST['address3'];
        $note                    =$_POST['note'];
        $allowed_image_extension = array("png","jpg","jpeg");
        $customer->name          = $_POST['fname']." ".$_POST['lname'];
        $customer->email         = $_POST['email'];
        $customer->password      = md5($_POST['password']);
        $customer->address       = $addres;
        $customer->last_login    = date("Y-m-d");
        $customer->phone         = $_POST['phone'];
        $customer->image         = $_FILES['image']['name'];
        $tmp_name                = $_FILES['image']['tmp_name'];
        $path                    = "admin/production/images/customer/";
        $target_file             = $path . basename($_FILES["image"]["name"]);
        $file_extension          = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $fileinfo                = @getimagesize($_FILES["image"]["tmp_name"]);
        $width                   = $fileinfo[0];
        $height                  = $fileinfo[1];
        $name                    =$_POST['fname']." ".$_POST['lname'];
        $addres                  =$_POST['address1']." - ".$_POST['address2']." - ".$_POST['address3'];
        $notes                   =$_POST['note'];

        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $error="Only letters and white space allowed";
        }elseif(!preg_match("/^[0-9\-\(\)\/\+\s]*$/", $_POST['phone'])){
           $error="Invalid Phone Number";
       }elseif(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $_POST['email'])) {
        $error="Invalid Email ";
    }elseif(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $_POST['password'])) {

        $error="Minimum eight characters, at least one letter, one number and one special character";
    }elseif($_FILES['image']['error'] != 0) {
        $error="Please Uploade Image ";}
        else if (! in_array($file_extension, $allowed_image_extension)) {
            $error =  "Upload valid images. Only PNG and JPEG are allowed.";}
            else if (($_FILES["image"]["size"] > 2000000)) {
        $error = "Image size exceeds 2MB"; }    // Validate image file dimension
        else if ($width > "400" || $height > "400") {
            $error ="Image dimension should be within 300X200";}
            else {
             if($customer->create()){
                 $id               =$db->lastInsertId();     
                 $customer->image      =$id.".".$file_extension;
                 move_uploaded_file($tmp_name, $path.$id.".".$file_extension);
                 $customer->id=$id;
                 if($customer->update())
                 {
                    $_SESSION['customer_id']=$id;
                    $product_ids=array();
                    $product_qty=array();
                    $total=0;
                     foreach ($_SESSION['shopping_cart'] as $key => $value) {
                         array_push($product_ids,$value['id']);
                         array_push($product_qty,$value['quantity']);
                          $product->id=$value['id'];
                          $product->read_product_id();
                         $qty=$value['quantity'];
                         $sub_total=$qty*$product->price;
                         $total+=$sub_total;
                     }
    $pro_ids      = implode(",", $product_ids);
    $pro_qtys     = implode(",", $product_qty);
    $ServerName   = "localhost";
    $UserNam      = "root";
    $PassWord     = "";
    $DatabaseName = "capstonedb";
    $conn         = mysqli_connect($ServerName,$UserNam,$PassWord,$DatabaseName);  
    $date         = date("Y-m-d"); 
    $que="INSERT INTO orders (order_date,customer_id,product_id, qty, payment_method, total,notes)
          VALUES 
          ('$date',{$_SESSION['customer_id']},'". $pro_ids ."','". $pro_qtys ."','cash',".$total.",'$notes')";
            if(  mysqli_query($conn,$que)){
             $id    =mysqli_insert_id($conn);
             $error= "Thank You order number is:". $id;
               foreach ($_SESSION['shopping_cart'] as $key => $value) {
                         array_push($product_ids,$value['id']);
                         array_push($product_qty,$value['quantity']);
                          $product->id=$value['id'];
                          $product->read_product_id();
                          $product->num_product=$product->num_product-$value['quantity'];
                          $product->update_qty();
                         
                     }
            unset($_SESSION['shopping_cart']);
           header( "refresh:5;url=index.php" );
                 }

               
          }//crete 
         }//uploaded file

}//else done
     }//ok
     else
     {
        $error="Please Check to create an account to complete your order";
    }
}//pace
if(isset($_POST['place_cus']))
{
    $notes        = $_POST['note'];
    $product_ids = array();
    $product_qty = array();
    $total       = 0;
  foreach ($_SESSION['shopping_cart'] as $key => $value) {
       array_push($product_ids,$value['id']);
       array_push($product_qty,$value['quantity']);
        $product->id=$value['id'];
           $product->read_product_id();
       $qty=$value['quantity'];
       $sub_total=$qty*$product->price;
       $total+=$sub_total; }
       $pro_ids      = implode(",", $product_ids);
       $pro_qtys     = implode(",", $product_qty);
       $ServerName   ="localhost";
       $UserNam      ="root";
       $PassWord     ="";
       $DatabaseName ="capstonedb";
       $conn=mysqli_connect($ServerName,$UserNam,$PassWord,$DatabaseName);  
       $date=date("Y-m-d"); 
    $que="INSERT INTO orders (order_date,customer_id,product_id, qty, payment_method, total,notes)
          VALUES 
          ('$date',{$_SESSION['customer_id']},'". $pro_ids ."','". $pro_qtys ."','cash', ".$total.",'$notes')";
        if(  mysqli_query($conn,$que)){
            $id    =mysqli_insert_id($conn);
             $error= " order number is:". $id;
                foreach ($_SESSION['shopping_cart'] as $key => $value) {
                         array_push($product_ids,$value['id']);
                         array_push($product_qty,$value['quantity']);
                          $product->id=$value['id'];
                          $product->read_product_id();
                          $product->num_product=$product->num_product-$value['quantity'];
                          $product->update_qty();
                         
                     }
            unset($_SESSION['shopping_cart']); 
            header( "refresh:20;url=index.php" );
          }

}//if custmer have account
if(isset($_SESSION['customer_id'])){
   $customer->id=$_SESSION['customer_id'];
  $customer->read_customer_id();
$value=' disabled="" style="display:none;"';}
else
$value='required=""';
?>

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container" >
            <div class="row" >
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="shop-cart.php"><i class="fa fa-home"></i> SHOP CART</a>
                        <span>Place Your Order</span>
                    </div>
                    <?php if(isset($error)) {?>
                    <div class="alert alert-success my-5" role="alert" >
  <h4 class="alert-heading">Well done!</h4>
  <p>Aww yeah, you successfully place your order ,  <?php echo $error;?> this important alert message. This number must you save it to receive your product . </p>
  <hr>
  <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
</div>
                    <?php }?>

                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Checkout Section Begin -->
    <?php   if(isset($_SESSION['shopping_cart'] )){?>
    <section class="checkout spad">
        <div class="container">
            <div class="row" >
                <div class="col-lg-12">
                  <?php if(!isset($_SESSION['customer_id'])){?>
<h6 class="coupon__link"><span class="icon_tag_alt"></span>  If you are a new customer please register to complete your order and  If you already have an account please <a href="login/login.php" style="color: blue;text-decoration: underline;">login</a> to complete your order</h6>              
<?php } ?>
  </div>
            </div>
             
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="checkout__form" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-8">
                        <h5>Billing detail</h5>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                     <?php if(isset($_SESSION['customer_id'])){ ?>
                                      <p class="font-weight-bold">Your Name <span>:</span></p>
                                      <p><?php   echo $customer->name;?></p>
                                      <p class="font-weight-bold">Your Address <span>:</span></p>
                                      <p><?php   echo $customer->address;?></p>
                                      <p class="font-weight-bold">Your Email <span>:</span></p>
                                      <p><?php   echo $customer->email;?></p>
                                       <p class="font-weight-bold">Your Phone <span>:</span></p>
                                      <p><?php   echo $customer->phone;?></p>
                                    <?php } else { ?>
                                    <p>First Name <span>*</span></p>
                                    <input type="text" name="fname"  <?php echo $value; ?>>
                                  <?php } ?>
                                </div>
                               

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                  <?php if(isset($_SESSION['customer_id'])){ ?>
                                  <p class="font-weight-bold">Your Image: <span>:</span></p>
                                  <p><img src="admin/production/images/customer/<?php echo $customer->image;?>"></p>
                                  <?php } else { ?>
                                    <p>Last Name <span>*</span></p>
                                    <input type="text" name="lname" <?php echo $value; ?>>
                                      <?php } ?>
                                </div>
                            </div>
                         <div class="col-lg-12">
                                <div class="checkout__form__input">
                                   <?php if(!isset($_SESSION['customer_id'])){ ?>
                                    <p>Country <span>*</span></p>
                                    <input type="text" name="address1" <?php echo $value; ?>>
                                  <?php } ?>
                                </div>
                                <div class="checkout__form__input">
                                  <?php if(!isset($_SESSION['customer_id'])){ ?>
                                    <p>Address <span>*</span></p>
                                    <input type="text" placeholder="Street Address" name="address2" <?php echo $value; ?>>
                                      <?php } ?>
                                </div>
                                <div class="checkout__form__input">
                                  <?php if(!isset($_SESSION['customer_id'])){ ?>
                                    <p>Town/City <span>*</span></p>
                                    <input type="text" name="address3" <?php echo $value; ?>>
                                    <?php } ?>
                                </div>
                               
                                <div class="checkout__form__input">
                                   <?php if(!isset($_SESSION['customer_id'])){ ?>
                                    <p>Your Image<span>*</span></p>
                                    <input type="file" name="image" style="border: 0px;" <?php echo $value; ?>>
                                     <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                     <?php if(!isset($_SESSION['customer_id'])){ ?>
                                    <p>Phone <span>*</span></p>
                                    <input type="number" name="phone" <?php echo $value; ?> min="0">
                                     <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                     <?php if(!isset($_SESSION['customer_id'])){ ?>
                                    <p>Email <span>*</span></p>
                                    <input type="email" name="email" <?php echo $value; ?>>
                                     <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__form__checkbox">
                                    <label for="acc">
                                      <?php if(!isset($_SESSION['customer_id'])){ ?>
                                        Create an acount?
                                        <input type="checkbox" id="acc" name="ok">
                                        <span class="checkmark"></span>
                                    </label>
                                    <p>Create am acount by entering the information below. If you are a returing
                                        customer login at the <br />top of the page</p>
                                          <?php } ?>
                                    </div>
                                    <div class="checkout__form__input">
                                      <?php if(!isset($_SESSION['customer_id'])){ ?>
                                        <p>Account Password <span>*</span></p>
                                        <input type="password" name="password" <?php echo $value; ?>>
                                         <?php } ?>
                                    </div>
                                  
                                    <div class="checkout__form__input">
                                        <p>Oder notes <span>*</span></p>
                                        <input type="text" name="note"
                                        placeholder="Note about your order, e.g, special noe for delivery" required="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                               <?php
                                    $total=0;                                
                                ?>
                            <div class="checkout__order">
                                <h5>Your order</h5>
                                <div class="checkout__order__product">
                                    <ul>
                                        <li>
                                            <span class="top__text">Product(qty)  </span>
                                            <span class="top__text" style="margin-left: 30px;">price</span>
                                            <span class="top__text__right">Sub Total</span>
                                        </li>
                                        <?php  
                                           foreach ($_SESSION['shopping_cart'] as $key => $value) {
                                           $product->id=$value['id'];
                                           $qty=$value['quantity'];
                                           $product->read_product_id();
                                           $sub_total=$qty*$product->price;
                                           $total+=$sub_total;
                                           ?>
                                        <li><?php echo $product->name ."(".$qty.")"; ?><span style="float: none;
    margin-left: 30px;"><?php echo "$ ".$product->price; ?></span><span><?php echo "$ ".$sub_total; ?></span></li>
                                    <?php }?>
                                        
                                    </ul>
                                </div>
                                <div class="checkout__order__total">
                                    <ul>
                                      <?php $shipping=$total+5?>
                                        <li>Subtotal <span><?php echo "$ " .$total;?></span></li>
                                        <li>Total <span><?php echo "$ " . $shipping;?></span></li>
                                    </ul>
                                </div>
                                <div class="checkout__order__widget">
                                   <!-- <label for="o-acc">
                                        Create an acount?
                                        <input type="checkbox" id="o-acc">
                                        <span class="checkmark"></span>
                                    </label>
                                    <p>Create am acount by entering the information below. If you are a returing customer
                                    login at the top of the page.</p>
                                    <label for="check-payment">
                                        Cheque payment
                                        <input type="checkbox" id="check-payment">
                                        <span class="checkmark"></span>
                                    </label>-->
                                    <label for="paypal">
                                        cash  on delivery
                                        <input type="checkbox" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                 <?php if(isset($_SESSION['customer_id'])){?>
                                  <button type="submit" class="site-btn" name="place_cus">Place oder</button>
                                <?php } else {?>
                                <button type="submit" class="site-btn" name="place">Place oder</button>
                              <?php  } ?>

                            </div>
                        </div>
                    </div>
                </form>
                   <?php }
                         
                          ?>    
            </div>
        </section>
    <?php  ?>
        <!-- Checkout Section End -->
<?php 
require_once('include/footer.php');
?>