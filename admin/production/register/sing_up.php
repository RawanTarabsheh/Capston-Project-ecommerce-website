<?php  ob_start();
require_once('../include/database.php');
require_once('../include/vendor.php');
require_once('../include/vendor_messag.php');
 // get database connection
$database       = new Database();
$db             = $database->getConnection();
$vendor         = new Vendor($db);
$vendor_message = new Vendor_message($db);
   if(isset($_POST['submit'])) {
    if(isset($_POST['check'])){
        $vendor->active=0;
        $allowed_image_extension = array("png","jpg","jpeg");
        $vendor->name     = $_POST['name'];
        $vendor->email    = $_POST['email'];
        $vendor->password = md5($_POST['password']);
        $vendor->address  = $_POST['address'];
        $vendor->phone    = $_POST['phone'];
        $vendor->image    = $_FILES['image']['name'];
        $tmp_name         = $_FILES['image']['tmp_name'];
        $path             = "../images/vendor/";
        $target_file      = $path . basename($_FILES["image"]["name"]);
        $file_extension   = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $fileinfo         = @getimagesize($_FILES["image"]["tmp_name"]);
        $width            = $fileinfo[0];
        $height           = $fileinfo[1];
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  $erroremail = "Invalid email format";
}
elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST['name'])) {
  $errorname = "Only letters and white space allowed";
}
        elseif(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $_POST['password'])) {
          $errorpass= 'the password does not meet the requirements!';
}elseif( $_POST['password'] !==  $_POST['password2']){
    $errorpass= 'the password does not match !';
}
elseif(!preg_match('/^[0-9]{10}$/', $_POST['phone']))
    {
      $errornum = 'Invalid Number!';
    }
    elseif(!preg_match('/[A-Za-z0-9\-\\,.]*+/', $_POST['address']))
    {
      $erroraddress = 'Invalid Address!';
    }
//validate iamge
      elseif($_FILES['image']['error'] != 0) {
        $errorimage="Please Uploade Image ";}
        else if (! in_array($file_extension, $allowed_image_extension)) {
        $errorimage =  "Upload valid images. Only PNG and JPEG are allowed.";}
        else if (($_FILES["image"]["size"] > 3000000)) {
        $errorimage = "Image size exceeds 2MB"; }    // Validate image file dimension
        else if ($width > "1500" || $height > "2000") {
        $errorimage ="Image dimension should be within 1500X2000";}
       else {
       if($vendor->create()){
       $id               =$db->lastInsertId();     
       $vendor->image      =$id.".".$file_extension;
       //$newimage=time().$oldeimag;//another soulition
       //move files to images folder
       move_uploaded_file($tmp_name, $path.$id.".".$file_extension);
       $vendor->id=$id;
       if($vendor->update()){
         $note= "<div class='alert alert-success' role='alert' style='margin-top: 200px;'>
                   <h4 class='alert-heading'>Well done!</h4>
                   <p>
                  Aww yeah, you successfully register as a vendor ,and we will contact you shortly by the responsible authority in order to activate your account
                  Thank you.</p>
                   <hr>
                  </div>";
       }
          }//crete 
          else
          {
            $error="Try again ";
          }
         }//uploaded file
       }//chek privecy
       else
       {
        $errorc="Please Chek I agree to the Terms of User";
         }//add new vendor
       }
     
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sing Up</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #999999;">
  
  <div class="limiter">
    <div class="container-login100">
      <div class="login100-more" style="background-image: url('images/bg-01.jpg');">
        <?php 
        if(isset($note))
          echo $note;
        ?>
      </div>

      <div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
       <?php
       if(isset($error)){
        echo '<div class="alert alert-danger">'.$error.'</div>';
      }
      ?>
        <form class="login100-form validate-form" action="" method="post" enctype="multipart/form-data"> 
          <span class="login100-form-title p-b-59">
            Sign Up
          </span>

          <div class="wrap-input100 validate-input" data-validate="Name is required">
            <span class="label-input100">Full Name</span>
            <input class="input100" type="text" name="name" placeholder="Name..." required="" data-validate-length-range="6" data-validate-words="2">
            <span class="focus-input100"></span>
              <?php if(isset($errorname)){
                echo '<div class="alert alert-danger">'.$errorname.'</div>';

              } ?>
          </div>

          <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
            <span class="label-input100">Email</span>
            <input class="input100" type="email" name="email" placeholder="Email addess..." required="">
            <span class="focus-input100"></span>
            <?php if(isset($erroremail)){
                echo '<div class="alert alert-danger">'.$erroremail.'</div>';
              } ?>
          </div>
          <div class="wrap-input100 validate-input" data-validate = "Password is required">
            <span class="label-input100">Password</span>
            <input class="input100" type="password" name="password" placeholder="*************" required="">
            <span class="focus-input100"></span>
            <?php if(isset($errorpass)){
                echo '<div class="alert alert-danger">'.$errorpass.'</div>';
              } ?>
          </div>

          <div class="wrap-input100 validate-input" data-validate = "Repeat Password is required">
            <span class="label-input100">Repeat Password</span>
            <input class="input100" type="password" name="password2" placeholder="*************" required="">
            <span class="focus-input100"></span>
          </div>
          <div class="wrap-input100 validate-input" data-validate="Phone is required">
            <span class="label-input100">phone</span>
            <input class="input100" type="number" name="phone" placeholder="phone..." required="">
            <span class="focus-input100"></span>
               <?php if(isset($errornum)){
                echo '<div class="alert alert-danger">'.$errornum.'</div>';
              } ?>
          </div>
           <div class="wrap-input100 validate-input" data-validate="Address is required">
            <span class="label-input100">Address</span>
            <input class="input100" type="text" name="address" placeholder="address..." required="">
            <span class="focus-input100"></span>
               <?php if(isset($erroraddress)){
                echo '<div class="alert alert-danger">'.$erroraddress.'</div>';
              } ?>
          </div>
            <div class="wrap-input100 validate-input" data-validate="Image is required">
            <span class="label-input100">Image</span>
            <input class="input100" type="file" name="image" placeholder="image..." required="">
            <span class="focus-input100"></span>
              <?php if(isset($errorimage)){
                echo '<div class="alert alert-danger">'.$errorimage.'</div>';
              } ?>
          </div>
          <div class="flex-m w-full p-b-33">
            <div class="contact100-form-checkbox">
              <input class="input-checkbox100" id="ckb1" type="checkbox" name="check">
              <label class="label-checkbox100" for="ckb1">
                <span class="txt1">
                  I agree to the
                  <a href="#" class="txt2 hov1">
                    Terms of User
                  </a>
                </span>
              </label>
              <?php if(isset($errorc)){
                echo '<div class="alert alert-danger">'.$errorc.'</div>';
              } ?>
            </div>  
          </div>
          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button class="login100-form-btn" type="submit" name="submit">
                Sign Up
              </button>
            </div>
            <a href="../vendor_login.php" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
              Sign in
              <i class="fa fa-long-arrow-right m-l-5"></i>
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
  
<!--===============================================================================================-->
  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/bootstrap/js/popper.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/daterangepicker/moment.min.js"></script>
  <script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
  <script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script src="js/main.js"></script>

</body>
</html>