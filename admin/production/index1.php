<?php  
 ob_start();
 session_start();
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
  <title>Cozy fashion | </title>
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
          <form method="post" action="">
            <h1 style="color: #26B99A; font-size: 34px;">Welcome Page</h1>
            <div style="display: -webkit-box;"></div>
            <div>
              <a href="admin_login.php" class="btn btn-success btn-lg" style="text-decoration: none;    width: 200px;    margin-left: 22px;">I'M A ADMIN</a>
            </div>
            <div>
              <a href="vendor_login.php" class="btn btn-success btn-lg" style="text-decoration: none;    width: 200px;    margin-left: 22px;">I'M A VENDOR</a>
            </div>
            <div class="clearfix"></div>
            <div class="separator">
              <div class="clearfix ml-5"><a href="register/sing_up.php" style="color: #26B99A; font-size: 24px;text-decoration: none;">Register  New Vendor</a></div>
              <br />
              <div class="mt-5 pt-5">
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
