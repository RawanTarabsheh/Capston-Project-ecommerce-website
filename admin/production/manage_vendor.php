
<?php  ob_start();
require_once('include/admin_header.php'); 
require_once('include/database.php');
require_once('include/vendor.php');
require_once('include/vendor_messag.php');

         // get database connection
$database       = new Database();
$db             = $database->getConnection();
$vendor         = new Vendor($db);
$vendor_message = new Vendor_message($db);

if(isset($_POST['send']))
{
  if($_POST['vendor_id'] =="" || $_POST['title']== "" || $_POST['message']=="" ){
    $error_send ="Please Fill All Filed Message Not Sent";
  }
else{
$vendor_message->vendor_id = $_POST['vendor_id'];
$vendor_message->title     = $_POST['title'];
$vendor_message->message   = $_POST['message'];
$vendor_message->date      = date("Y-m-d");
if($vendor_message->create())
  header("Location:manage_vendor.php");
}
}//send message to vendor
if(isset($_GET['idd']))
{
    $vendor->id=$_GET['idd'];
    $row= $vendor->read_vendor_id();
    $oldeimag=$row['vendor_image'];
    unlink('images/vendor/'.$oldeimag);
  if($vendor->delete())
    //must delete all products
    //delee from product where vender id
    header("Location:manage_vendor.php");
         }//delete vendor by id 

         if(isset($_POST['submit'])) {
          if(!empty($_POST['active']))
            $vendor->active=1;
          else
            $vendor->active=0;
     
        $allowed_image_extension = array("png","jpg","jpeg");
        $vendor->name     = $_POST['name'];
        $vendor->email    = $_POST['email'];
        $vendor->password = md5($_POST['password']);
        $vendor->address  = $_POST['address'];
        $vendor->phone    = $_POST['phone'];
        $vendor->image    = $_FILES['image']['name'];
        $tmp_name         = $_FILES['image']['tmp_name'];
        $path             = "images/vendor/";
        $target_file      = $path . basename($_FILES["image"]["name"]);
        $file_extension   = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $fileinfo         = @getimagesize($_FILES["image"]["tmp_name"]);
        $width            = $fileinfo[0];
        $height           = $fileinfo[1];
         
//validate iamge
        if($_FILES['image']['error'] != 0) {
        $error="Please Uploade Image ";}
        else if (! in_array($file_extension, $allowed_image_extension)) {
        $error =  "Upload valid images. Only PNG and JPEG are allowed.";}
        else if (($_FILES["image"]["size"] > 2000000)) {
        $error = "Image size exceeds 2MB"; }    // Validate image file dimension
        else if ($width > "1500" || $height > "2000") {
        $error ="Image dimension should be within 1500X2000";}
       else {
       if($vendor->create()){
       $id               =$db->lastInsertId();     
       $vendor->image      =$id.".".$file_extension;
       //$newimage=time().$oldeimag;//another soulition
       //move files to images folder
       move_uploaded_file($tmp_name, $path.$id.".".$file_extension);
       $vendor->id=$id;
       if($vendor->update())
       header("Location:manage_vendor.php");      
          }//crete 
         }//uploaded file
         }//add new vendor

         if(isset($_POST['submit1']))
{
        $vendor->id       = $_POST['vendorid'];
        $row              = $vendor->read_vendor_id();
        $vendor->name     = $_POST['name1'];
        $vendor->email    = $_POST['email1'];
        $vendor->address  = $_POST['address1'];
        $vendor->phone    = $_POST['phone1'];
        $vendor->password = md5($_POST['password11']);
        if(isset($_POST['active1']))
            $vendor->active=1;
          else
            $vendor->active=0;
       
//validate iamge
        if($_FILES['image1']['error'] == 0) {
            //c    = $_FILES['image1']['name'];
        $allowed_image_extension = array("png","jpg","jpeg");
        $tmp_name        = $_FILES['image1']['tmp_name'];
        $path            = "images/vendor/";
        $target_file     = $path . basename($_FILES["image1"]["name"]);
        $file_extension  = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $fileinfo        = @getimagesize($_FILES["image1"]["tmp_name"]);
        $width           = $fileinfo[0];
        $height          = $fileinfo[1];
         if (! in_array($file_extension, $allowed_image_extension)) {
        $error =  "Upload valid images. Only PNG and JPEG are allowed.";}
        else if (($_FILES["image"]["size"] > 2000000)) {
        $error = "Image size exceeds 2MB"; }    // Validate image file dimension
        else if ($width > "1500" || $height > "2000") {
        $error ="Image dimension should be within 1500X2000";}
       else {
        $oldeimag=$row['vendor_image'];
        unlink('images/vendor/'.$oldeimag);
        $vendor->image      =$_POST['vendorid'].".".$file_extension;
       //$newimage=time().$oldeimag;//another soulition
       //move files to images folder
       move_uploaded_file($tmp_name, $path.$_POST['vendorid'].".".$file_extension);
     }
        }//upload new file
      else
      {
        $error ="Please Insert Image ";
      }
       if($vendor->update())
       header("Location:manage_vendor.php");         
}
          ?>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).on("click", ".edit", function() {
      var vendor_id = this.getAttribute('data-vendor-id');
     // alert(vendor_id);
                    $.ajax(
                            {
                                type: "POST",
                                url: "update_vendor.php",
                                data :
                                {
                                    "vendor_id": vendor_id,
                                },
                                success: function(data)
                                {
                                  console.log(data);
                                    var data1 = JSON.parse(data);
                                    console.log(data1);
                                    var pass=data1.vendor_password;
                                    $('input[name=vendorid]').val(data1.vendor_id);
                                    $('input[name=name1]').val(data1.vendor_name);
                                    $('input[name=email1]').val(data1.vendor_email);
                                    $('input[name=password11]').val(pass);
                                    $('input[name=password22]').val(pass);
                                    $('input[name=phone1]').val(data1.vendor_phone);
                                    $('input[name=address1]').val(data1.vendor_address);
                                    if(data1.active==1)
                                    $("#status").prop("checked", true);
                                  else
                                    $("#status").prop("checked", false);

                                    $('img[name=vendorimage]').attr("src",'images/vendor/'+data1.vendor_image);
                                    
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
                  <h2>Manage vendor</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                  </ul>
                  <div class="clearfix"></div>
                </div>
 <?php
                              if(isset($error_send))
                              {
 echo '<div class="alert alert-danger">'.$error_send.'</div>';

                              }
                              ?>
                <div class="x_content">
                  <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target=".bs-example-modal-lg"> <i class="fa fa-plus"></i> New vendor </button>
                  <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target=".bs-example-modal-lg2"> <i class="fa fa-plus"></i> Send Message </button>
                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">New vendor</h4>
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
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Insert Image<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                     <input type="file" id="file-input" name="image" class="form-control-file" required="">
                                   </div>
                                 </div>
                                 <div class="checkbox">
                          <label>
                            <input type="checkbox" class="flat" checked="checked" name="active" > Active
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

  <!-- /model for send messag to vendor  -->
                <div class="modal fade bs-example-modal-lg2" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">New vendor</h4>
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
                              <?php
                              if(isset($error_send))
                              {
 echo '<div class="alert alert-danger">'.$error_send.'</div>';

                              }
                              ?>
                              <span class="section">Send Message</span>
                              <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Title<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                  <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="title" placeholder="Title" required="" />
                                </div>
                              </div>
                             
                                <?php  $stmtv=$vendor->read();?>
                                <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">Vendor Name<span class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                     <select class="form-control" name="vendor_id" required="">
                                       <option value="">Choose Vendor</option>
                                       <?php 
                                         while ($rowv = $stmtv->fetch(PDO::FETCH_ASSOC)){
                                        extract($rowv);
                                        ?>
                                        <option value="<?php echo $vendor_id; ?>"><?php echo $vendor_name; ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                  </div>
                                  <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Message<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                      <textarea required="required" name='message' style="width: 333px;height: 250px;" required=""></textarea></div>
                                    </div>

                               
                                 
                          
                                 <div class="ln_solid">
                                  <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success" name="send">Send </button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                  <!-- /model for send messag to vendor  -->

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
$stmt = $vendor->readAll($from_record_num, $records_per_page);
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
                         <th class="column-title">Status</th>
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
                            <div class="profile_pic"><img src="images/vendor/<?php echo $vendor_image; ?>" alt="<?php echo $vendor_name; ?>" class="img-circle profile_img" style="width: 75px;height: 75px;"></div> 
                          </td>
                          <td class=" "><?php echo $vendor_name; ?></td>
                          <td class="a-right a-right "><?php echo $vendor_email; ?> </td>
                          <td class="a-right a-right "><?php echo $vendor_phone; ?> </td>
                          <td class="a-right a-right "><?php echo $vendor_address; ?> </td>
                          <?php 
                          $value="";
                          if($active==0)
                          {
                            $value='<div class="fa-hover col-md-3 col-sm-4  "><a href="#/toggle-off"><i class="fa fa-toggle-off" style="color: #dc3545; font-size: 25px;"></i></a>
                          
                        </div>';
                      }
                          else{
                            $value='<div class="fa-hover col-md-3 col-sm-4  "><a href="#/toggle-on"><i class="fa fa-toggle-on" style="color:#26B99A; font-size: 25px;"></i> </a>
                          
                        </div>';}
                          ?>
                          <td class="a-right a-right "><?php echo $value; ?> </td>
                          <td class=" last">
                            <a href="#"><span  data-vendor-id="<?php echo $vendor_id; ?>" data-toggle="modal" data-target=".bs-example-modal-lg1" class="edit glyphicon glyphicon-edit " aria-hidden="true" style="color:#26B99A; font-size: 25px;"></span></a>
                            <a href="manage_vendor.php?idd=<?php echo $vendor_id;?>"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="color: #dc3545; font-size: 25px;"></span></a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <?php
                     // paging buttons will be here
    // the page where this paging is used
$page_url = "manage_vendor.php?";
  
// count all products in the database to calculate total pages
$total_rows = $vendor->countAll();
  
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
                          <h4 class="modal-title" id="myModalLabel">Update vendor</h4>
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
                          <input type="text" name="vendorid" value="" hidden>
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
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Insert Image<span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                         <input type="file" id="file-input1" name="image1" class="form-control-file">
                                         <img src="" style="width: 200px; height: 150px;" name="vendorimage">
                                       </div>

                                     </div>
                                     <div class="checkbox">
                                   
                                      <label>
                                        <input type="checkbox" class="flat" checked="" name="active1" id="status"> Active
                                      </label>
                                    </div>
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
