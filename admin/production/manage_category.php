<?php  ob_start();
require_once('include/admin_header.php'); 
require_once('include/database.php');
require_once('include/category.php');
require_once('include/sub_category.php');

         // get database connection
$database     = new Database();
$db           = $database->getConnection();
$category     = new Category($db);
$sub_category = new  Sub_Category($db);

if(isset($_GET['idd']))
{
    $category->id=$_GET['idd'];
    $row= $category->read_category_id();
    $oldeimag=$row['category_image'];
    unlink('images/category/'.$oldeimag);
  if($category->delete()){
    $sub_category->cat_id=$_GET['idd'];
    $sub_category->delete_all();
    header("Location:manage_category.php");}
         }//delete category by id 

         if(isset($_POST['submit'])) {
     
        $allowed_image_extension = array("png","jpg","jpeg");
        $category->name  = $_POST['name'];
        $category->image = $_FILES['image']['name'];
        $tmp_name        = $_FILES['image']['tmp_name'];
        $path            = "images/category/";
        $target_file     = $path . basename($_FILES["image"]["name"]);
        $file_extension  = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $fileinfo        = @getimagesize($_FILES["image"]["tmp_name"]);
        $width           = $fileinfo[0];
        $height          = $fileinfo[1];
  
         
//validate iamge
        if($_FILES['image']['error'] != 0) {
        $error="Please Uploade Image ";}
        else if (! in_array($file_extension, $allowed_image_extension)) {
        $error =  "Upload valid images. Only PNG and JPEG are allowed.";}
        else if (($_FILES["image"]["size"] > 3000000)) {
        $error = "Image size exceeds 2MB"; }    // Validate image file dimension
        else if ($width > "1500" || $height > "2000") {
        $error ="Image dimension should be within 1500X2000";}
       else {
       if($category->create()){
       $id               =$db->lastInsertId();     
       $category->image      =$id.".".$file_extension;
       //$newimage=time().$oldeimag;//another soulition
       //move files to images folder
       move_uploaded_file($tmp_name, $path.$id.".".$file_extension);
       $category->id=$id;
       if($category->update())
       header("Location:manage_category.php");      
          }//crete 
         }//uploaded file
         }//add new category

         if(isset($_POST['submit1'])){
        $category->id   = $_POST['categoryid'];
         $row           = $category->read_category_id();
        $category->name = $_POST['name1'];  
//validate iamge
        if($_FILES['image1']['error'] == 0) {
        //c    = $_FILES['image1']['name'];
        $allowed_image_extension = array("png","jpg","jpeg");
        $tmp_name                = $_FILES['image1']['tmp_name'];
        $path                    = "images/category/";
        $target_file             = $path . basename($_FILES["image1"]["name"]);
        $file_extension          = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $fileinfo                = @getimagesize($_FILES["image1"]["tmp_name"]);
        $width                   = $fileinfo[0];
        $height                  = $fileinfo[1];
         if (! in_array($file_extension, $allowed_image_extension)) {
        $error =  "Upload valid images. Only PNG and JPEG are allowed.";}
        else if (($_FILES["image"]["size"] > 2000000)) {
        $error = "Image size exceeds 2MB"; }    // Validate image file dimension
        else if ($width > "1500" || $height > "2000") {
     $error ="Image dimension should be within 1500X2000";}
       else {
         $oldeimag=$row['category_image'];
        unlink('images/category/'.$oldeimag);
        $category->image      =$_POST['categoryid'].".".$file_extension;
       //$newimage=time().$oldeimag;//another soulition
       //move files to images folder
       move_uploaded_file($tmp_name, $path.$_POST['categoryid'].".".$file_extension);
     }
        }//upload new file
       if($category->update())
       header("Location:manage_category.php");         
}//submit
          ?>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).on("click", ".edit", function() {
      var category_id = this.getAttribute('data-category-id');
                    $.ajax(
                            {
                                type: "POST",
                                url: "update_category.php",
                                data :
                                {
                                    "category_id": category_id,
                                },
                                success: function(data)
                                {
                                  console.log(data);
                                    var data1 = JSON.parse(data);
                                    $('input[name=categoryid]').val(data1.category_id);
                                    $('input[name=name1]').val(data1.category_name);
                                    $('img[name=categoryimage]').attr("src",'images/category/'+data1.category_image);
                                    
                                }
                            });
    });
</script>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <?php
                          if(isset($error))
                          {
                            echo '<div class="alert alert-danger">'.$error.'</div>';
                          }
                          ?>
           <div class="row" style="display: block;">      
            <div class="col-md-12 col-sm-12  ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Manage category</h2>

                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                  </ul>
                  <div class="clearfix"></div>
                </div>
                <?php
                          if(isset($error))
                          {
                            echo '<div class="alert alert-danger">'.$error.'</div>';
                          }
                          ?>
                <div class="x_content">
                  <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target=".bs-example-modal-lg"> <i class="fa fa-plus"></i> New category </button>
                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">New category</h4>
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
                                  <input class="form-control" data-validate-length-range="3" data-validate-words="1" name="name" placeholder="ex. Rawan H. Tarabsheh" required="required" />
                                </div>
                              </div>
                           
                                  <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Insert Image<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                     <input type="file" id="file-input" name="image" class="form-control-file" required="">
                                   </div>
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

                <div class="table-responsive">
                            <?php
                  // page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
  
// set number of records per page
$records_per_page =5;
  
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
  
  // query products
$stmt = $category->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();
if($num>0){
                  ?>
                  <table class="table table-striped jambo_table bulk_action">
                    <thead>
                      <tr class="headings">
                        <th>
                          <input type="checkbox" id="check-all" class="flat">
                        </th>
                        <th class="column-title"># </th>
                        <th class="column-title"> Image </th>
                        <th class="column-title">Name </th>
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
                            <div class="profile_pic"><img src="images/category/<?php echo $category_image; ?>" alt="<?php echo $category_name; ?>" class="img-circle profile_img img-thumbnail" style="width: 75px;height: 75px;"></div> 
                          </td>
                          <td class=" "><?php echo $category_name; ?></td>
                          <td class=" last">
                            <a href="#"><span  data-category-id="<?php echo $category_id; ?>" data-toggle="modal" data-target=".bs-example-modal-lg1" class="edit glyphicon glyphicon-edit " aria-hidden="true" style="color:#26B99A; font-size: 25px;"></span></a>
                            <a href="manage_category.php?idd=<?php echo $category_id;?>"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="color: #dc3545; font-size: 25px;"></span></a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                             <?php
                     // paging buttons will be here
    // the page where this paging is used
$page_url = "manage_category.php?";
  
// count all products in the database to calculate total pages
$total_rows = $category->countAll();
  
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
                          <h4 class="modal-title" id="myModalLabel">Update category</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                         <!-- page content -->
                         <div class="col-md-12 col-sm-12">
                          <div class="x_panel">

                            <div class="x_content">
                        
                              <form class="" action="" method="post" novalidate enctype="multipart/form-data">
                              </p>
                              <span class="section">Personal Info</span>
                              <input type="text" name="categoryid" value="" hidden>
                              <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                  <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="name1" placeholder="ex. Rawan H. Tarabsheh" required="required" />
                                </div>
                              </div>
                             
                                  <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Insert Image<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                     <input type="file" id="file-input1" name="image1" class="form-control-file">
                                     <img src="" style="width: 200px; height: 150px;" name="categoryimage">
                                   </div>
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
