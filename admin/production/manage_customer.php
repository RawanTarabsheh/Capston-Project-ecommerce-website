
<?php  ob_start();
require_once('include/admin_header.php'); 
require_once('include/database.php');
require_once('include/customer.php');
         // get database connection
$database = new Database();
$db       = $database->getConnection();
$customer    =new Customer($db);
if(isset($_GET['idd']))
{
    $customer->id=$_GET['idd'];
    $row= $customer->read_customer_id();
    $oldeimag=$row['customer_image'];
    unlink('images/customer/'.$oldeimag);
  if($customer->delete())
    //must delete all products
    //delee from product where vender id
    header("Location:manage_customer.php");
         }//delete customer by id 

         if(isset($_POST['submit'])) {
        /*  if(!empty($_POST['active']))
            $customer->active=1;
          else
            $customer->active=0;*/
     
        $allowed_image_extension = array("png","jpg","jpeg");
        $customer->name        = $_POST['name'];
        $customer->email       = $_POST['email'];
        $customer->password    = md5($_POST['password']);
        $customer->address     = $_POST['address'];
        $customer->last_login  = $_POST['last_login'];
        $customer->phone       = $_POST['phone'];
        $customer->image       = $_FILES['image']['name'];
        $tmp_name              = $_FILES['image']['tmp_name'];
        $path                  = "images/customer/";
        $target_file           = $path . basename($_FILES["image"]["name"]);
        $file_extension        = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $fileinfo              = @getimagesize($_FILES["image"]["tmp_name"]);
        $width                 = $fileinfo[0];
        $height                = $fileinfo[1];
         
//validate iamge
        if($_FILES['image']['error'] != 0) {
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
       //$newimage=time().$oldeimag;//another soulition
       //move files to images folder
       move_uploaded_file($tmp_name, $path.$id.".".$file_extension);
       $customer->id=$id;
       if($customer->update())
       header("Location:manage_customer.php");      
          }//crete 
         }//uploaded file
         }//add new customer

         if(isset($_POST['submit1']))
{
        $customer->id          = $_POST['customerid'];
        $row                   = $customer->read_customer_id();
        $customer->name        = $_POST['name1'];
        $customer->email       = $_POST['email1'];
        $customer->address     = $_POST['address1'];
        $customer->phone       = $_POST['phone1'];
        $customer->last_login   = $_POST['last_login1'];
        $customer->password    = md5($_POST['password11']);
       /* if(isset($_POST['active1']))
            $customer->active=1;
          else
            $customer->active=0;
       */
//validate iamge
        if($_FILES['image1']['error'] == 0) {
            //c    = $_FILES['image1']['name'];
        $allowed_image_extension = array("png","jpg","jpeg");
        $tmp_name        = $_FILES['image1']['tmp_name'];
        $path            = "images/customer/";
        $target_file     = $path . basename($_FILES["image1"]["name"]);
        $file_extension  = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $fileinfo        = @getimagesize($_FILES["image1"]["tmp_name"]);
        $width           = $fileinfo[0];
        $height          = $fileinfo[1];
         if (! in_array($file_extension, $allowed_image_extension)) {
        $error =  "Upload valid images. Only PNG and JPEG are allowed.";}
        else if (($_FILES["image"]["size"] > 2000000)) {
        $error = "Image size exceeds 2MB"; }    // Validate image file dimension
        else if ($width > "400" || $height > "400") {
        $error ="Image dimension should be within 300X200";}
       else {
        $oldeimag=$row['customer_image'];
        unlink('images/customer/'.$oldeimag);
        $customer->image      =$_POST['customerid'].".".$file_extension;
       //$newimage=time().$oldeimag;//another soulition
       //move files to images folder
       move_uploaded_file($tmp_name, $path.$_POST['customerid'].".".$file_extension);
     }
        }//upload new file
      
       if($customer->update())
       header("Location:manage_customer.php");         
}
          ?>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).on("click", ".edit", function() {
      var customer_id = this.getAttribute('data-customer-id');
     // alert(customer_id);
                    $.ajax(
                            {
                                type: "POST",
                                url: "update_customer.php",
                                data :
                                {
                                    "customer_id": customer_id,
                                },
                                success: function(data)
                                {
                                  console.log(data);
                                    var data1 = JSON.parse(data);
                                    console.log(data1);
                                    var pass=data1.customer_password;
                                    $('input[name=customerid]').val(data1.customer_id);
                                    $('input[name=name1]').val(data1.customer_name);
                                    $('input[name=email1]').val(data1.customer_email);
                                    $('input[name=password11]').val(pass);
                                    $('input[name=password22]').val(pass);
                                    $('input[name=phone1]').val(data1.customer_phone);
                                    $('input[name=address1]').val(data1.customer_address);
                                    $('input[name=last_login1]').val(data1.last_login);

                                   /* if(data1.active==1)
                                    $("#status").prop("checked", true);
                                  else
                                    $("#status").prop("checked", false);
*/
                                    $('img[name=customerimage]').attr("src",'images/customer/'+data1.customer_image);
                                    
                                }
                            });
    });
</script>
        <!-- page content -->
  
        <div class="right_col" role="main">
          <div class="">
           <div class="row" style="display: block;">      
            <div class="col-md-12 col-sm-12  ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Manage customer</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                  </ul>
                  <div class="clearfix"></div>
                </div>

                <div class="x_content">
                  <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target=".bs-example-modal-lg"> <i class="fa fa-plus"></i> New customer </button>
                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">New customer</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                         <!-- page content -->
                         <div class="col-md-12 col-sm-12">
                          <div class="x_panel">

                            <div class="x_content">
                              <?php
                          if(isset($error))
                          {
                            echo '<div class="alert alert-danger">'.$error.'</div>';
                          }
                          ?>
                              <form class="" action="" method="post" novalidate enctype="multipart/form-data">
                              </p>
                              <span class="section">Personal Info</span>
                              <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                  <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="ex. Rawan H. Tarabsheh" required="required" />
                                </div>
                              </div>
                              <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">email<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                  <input class="form-control" name="email" class='email' required="required" type="email" /></div>
                                </div>
                                <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">Password<span class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="password" id="password1" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}" title="Minimum 8 Characters Including An Upper And Lower Case Letter, A Number And A Unique Character" required />

                                    <span style="position: absolute;right:15px;top:7px;" onclick="hideshow()" >
                                      <i id="slash" class="fa fa-eye-slash"></i>
                                      <i id="eye" class="fa fa-eye"></i>
                                    </span>
                                  </div>
                                </div>

                                <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">Repeat password<span class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="password" name="password2" data-validate-linked='password' required='required' /></div>
                                  </div>
                                  <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Telephone<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" type="tel" class='tel' name="phone" required='required' data-validate-length-range="8,20" /></div>
                                    </div>
                                    <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Address<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" class='optional' name="address" data-validate-length-range="5,15" type="text" required="" /></div>
                                        </div>
                                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Last Login<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                  <input class="form-control" class='date' type="date" name="last_login" required='required'></div>
                                </div>
                                  <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Insert Image<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                     <input type="file" id="file-input" name="image" class="form-control-file" required="">
                                   </div>
                                 </div>
                              <!--   <div class="checkbox">
                          <label>
                            <input type="checkbox" class="flat" checked="checked" name="active" > Active
                          </label>
                        </div>-->
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

          
                 <div class="table-responsive">
                  <?php
                  // page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
  
// set number of records per page
$records_per_page =5;
  
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
  
  // query products
$stmt = $customer->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();
if($num>0){
                  ?>
                  <table class="table table-striped jambo_table bulk_action">
                    <thead>
                      <tr class="headings">
                        <th>
                          <input type="checkbox" id="check-all" class="flat">
                        </th>
                        <th class="column-title">#</th>
                        <th class="column-title">Image</th>
                        <th class="column-title">Name</th>
                        <th class="column-title">Email</th>
                        <th class="column-title">Phone</th>
                        <th class="column-title">Address</th>
                        <th class="column-title">Last Login</th>
                        <th class="column-title no-link last"><span class="nobr">Action</span>
                        </th>
                        <th class="bulk-actions" colspan="7">
                          <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                        </th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      $number=0;
                       while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                       extract($row);
                        $number+=1;
                            //print_r($categoryrow);
                        ?>
                        <tr class="even pointer" style="line-height: 100px;">
                          <td class="a-center ">
                            <input type="checkbox" class="flat" name="table_records">
                          </td>
                          <td class=" "><?php echo $number;?></td>
                          <td class=" ">
                            <div class="profile_pic"><img src="images/customer/<?php echo $customer_image; ?>" alt="<?php echo $customer_name; ?>" class="img-circle profile_img" style="width: 75px;height: 75px;"></div> 
                          </td>
                          <td class=" "><?php echo $customer_name; ?></td>
                          <td class="a-right a-right "><?php echo $customer_email; ?> </td>
                          <td class="a-right a-right "><?php echo $customer_phone; ?> </td>
                          <td class="a-right a-right "><?php echo $customer_address; ?> </td>
                          <td class="a-right a-right "><?php echo $last_login; ?> </td>
                          
                          <?php 
                        /*  $value="";
                          if($active==0)
                          {
                            $value='<div class="fa-hover col-md-3 col-sm-4  "><a href="#/toggle-off"><i class="fa fa-toggle-off" style="color: #dc3545; font-size: 25px;"></i></a>
                          
                        </div>';
                      }
                          else{
                            $value='<div class="fa-hover col-md-3 col-sm-4  "><a href="#/toggle-on"><i class="fa fa-toggle-on" style="color:#26B99A; font-size: 25px;"></i> </a>
                          
                        </div>';}*/
                          ?>
                        <!--  <td class="a-right a-right "><?php echo $value; ?> </td>-->
                          <td class=" last">
                            <a href="#"><span  data-customer-id="<?php echo $customer_id; ?>" data-toggle="modal" data-target=".bs-example-modal-lg1" class="edit glyphicon glyphicon-edit " aria-hidden="true" style="color:#26B99A; font-size: 25px;"></span></a>
                            <a href="manage_customer.php?idd=<?php echo $customer_id;?>"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="color: #dc3545; font-size: 25px;"></span></a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <?php
                     // paging buttons will be here
    // the page where this paging is used
$page_url = "manage_customer.php?";
  
// count all products in the database to calculate total pages
$total_rows = $customer->countAll();
  
// paging buttons here
?>
<div class="dataTables_paginate paging_simple_numbers" id="datatable-responsive_paginate">
<?php
include_once 'paging.php';
}
                  ?>
                </div>
                </div>
                      
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
                      <div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-hidden="true">

     <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Update customer</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                         <!-- page content -->
                         <div class="col-md-12 col-sm-12">
                          <div class="x_panel">

                            <div class="x_content">
                              <?php
                          if(isset($error))
                          {
                            echo '<div class="alert alert-danger">'.$error.'</div>';
                          }
                          ?>
                          <form class="" action="" method="post" novalidate enctype="multipart/form-data">
                          </p>
                          <span class="section">Personal Info</span>
                          <input type="text" name="customerid" value="" hidden>
                          <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                              <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="name1" placeholder="ex. Rawan H. Tarabsheh" required="required" />
                            </div>
                          </div>
                          <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">email<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                              <input class="form-control" name="email1" class='email' required="required" type="email" /></div>
                            </div>
                                <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">Password<span class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="password" id="password11" name="password11" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}" title="Minimum 8 Characters Including An Upper And Lower Case Letter, A Number And A Unique Character" required />

                                    <span style="position: absolute;right:15px;top:7px;" onclick="hideshow()" >
                                      <i id="slash1" class="fa fa-eye-slash"></i>
                                      <i id="eye1" class="fa fa-eye"></i>
                                    </span>
                                  </div>
                                </div>

                                <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">Repeat password<span class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="password" name="password22" data-validate-linked='password' required='required' /></div>
                                  </div>
                                  <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Telephone<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                      <input class="form-control" type="tel" class='tel' name="phone1" required='required' data-validate-length-range="8,20" /></div>
                                    </div>
                                     <div class="field item form-group">
                                      <label class="col-form-label col-md-3 col-sm-3  label-align">Address<span class="required">*</span></label>
                                      <div class="col-md-6 col-sm-6">
                                        <input class="form-control" class='optional' name="address1" data-validate-length-range="5,15" type="text" /></div>
                                      </div>
                                      <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Last Login<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                  <input class="form-control" class='date' type="date" name="last_login1" required='required'></div>
                                </div>
                                      <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Insert Image<span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                         <input type="file" id="file-input1" name="image1" class="form-control-file">
                                         <img src="" style="width: 200px; height: 150px;" name="customerimage">
                                       </div>

                                     </div>
                                   <!--  <div class="checkbox">
                                   
                                      <label>
                                        <input type="checkbox" class="flat" checked="" name="active1" id="status"> Active
                                      </label>
                                    </div>-->
                                    <div class="ln_solid">
                                      <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success" name="submit1">Update </button>
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
    <?php    require_once('include/admin_footer.php'); ?>
