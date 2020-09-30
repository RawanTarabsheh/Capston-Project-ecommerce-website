<?php   ob_start();
session_start();
//session_destroy();
require_once('include/database.php');
require_once('include/admin.php');?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#ok").hide();
                 $("#no").hide();
                $("#admin_email").blur(function(){
                    var email=$("#admin_email").val();
                    //alert(email);
                   $.ajax(
                            {
                                type: "POST",
                                url: "get_admin.php",
                                data :
                                {
                                    "email": email,
                                },  
                                success: function(response)
                                {
                              
                                if(response=="done"){
                                  $("#ok").show();
                                  $("#no").hide();  
                                }else{
                                 $("#ok").hide();
                                 $("#no").show();
                            }
                                }
                            });
                });
            });

        </script>
<?php
         // get database connection
$database        = new Database();
$db              = $database->getConnection();
$admin           = new Admin($db);

if(isset($_POST['login'])){
  $admin->email    = $_POST['email'];
  $admin->password = md5($_POST['password']);
  $admin->login();
  if(isset($admin->id))
  {
         if(isset($_POST['remember'])) {
              $_SESSION['remmeber_id']=$admin->id;
        }
   $_SESSION['admin_id']=$admin->id;
   header("Location:admin_index.php");
  }
  else{
   $error="User Not Found";
 }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Cozy Fashion  | </title>

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
  <div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
          <?php
          if(isset($error))
          {
            echo '<div class="alert alert-danger">'.$error.'</div>';
          }
          ?>
          <form method="post" action="">
            <h1 style="color: #26B99A;">Admin Login Page</h1>
            <div style="    display: -webkit-box;">
              <?php
              if(isset($_SESSION['remmeber_id']))
              {
                $admin->id=$_SESSION['remmeber_id'];
                $admin->read_admin_id();
                $email=$admin->email;
                $password=md5($admin->password);
              }
              else
              {
               $email="";
               $password="";
             }
             ?>
              <input type="email" class="form-control" placeholder="Email " required="" name="email" value="<?php echo $email;?>" id="admin_email"/>
              <i  style="font-size: 20px;color: green;" id="ok">✅</i>
              <i  style="font-size: 20px;color: red;" id="no">❎</i>
            </div>
            <div>
              <input type="password" class="form-control" placeholder="Password" required="" name="password" value="<?php echo $password;?>" />
            </div>
            <div>
              <label style="margin-right: 160px; color: #26B99A;">
               <input type="checkbox" name="remember"  >Remember Me
             </label>
             <button class="btn btn-success" type="submit" name="login">sign in</button>                
           </div>
           <div class="clearfix"></div>
           <div class="separator">
            <div class="clearfix"></div>
            <br />
            <div>
              <h1><a href="index1.php" style="text-decoration: none;font-size: 25px;"><i class="fa fa-paw"></i> Cozy Fashion</a></h1>
              <p>©2020 All Rights Reserved.  Cozy Fashion . Privacy and Terms</p>
            </div>
          </div>
        </form>
      </section>
    </div>
    </div>
  </body>
  </html>
