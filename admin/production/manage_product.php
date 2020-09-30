<?php  ob_start();
require_once('include/admin_header.php'); 
require_once('include/database.php');
require_once('include/product.php');
require_once('include/category.php');
require_once('include/sub_category.php');
require_once('include/vendor.php');
         // get database connection
$database   = new Database();
$db         = $database->getConnection();
$product    = new Product($db);
$category   = new Category($db);
$category   = new Sub_Category($db);
$vendor     = new Vendor($db);

if(isset($_GET['idd']))
{
  function delete_files($target) {
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

        foreach( $files as $file ){
            delete_files( $file );      
        }

        rmdir( $target );
    } elseif(is_file($target)) {
        unlink( $target );  
    }
}
    $product->id=$_GET['idd'];
    $id=$_GET['idd'];
    $row= $product->read_product_id();
    $oldeimag=$row['product_image'];
    unlink('images/product/'.$oldeimag);
    $path="images/product/".$id."/";
    delete_files($path);
   // is_file($path) ? @unlink($path) : array_map(__FUNCTION__, glob($path.'/*')) == @rmdir($path);
  if($product->delete())
    //must delete all products
    //delee from product where vender id
    header("Location:manage_product.php");
         }//delete product by id 

         if(isset($_POST['submit'])) {
          if(!empty($_POST['state']))
            $product->state=1;
          else
            $product->state=0;
     
        $allowed_image_extension = array("png","jpg","jpeg");
        $product->vendor_id      = $_POST['vendor_id'];
        $product->name           = $_POST['name'];
        $product->price          = $_POST['price'];
        $product->offer          = $_POST['special_price'];
        $product->date           = $_POST['date'];
        $product->color          = $_POST['color'];
        $product->size           = $_POST['size'];
        $product->desc           = $_POST['desc'];
        $product->sub_cat_id     = $_POST['sub_cat_id'];
        $product->feature        = $_POST['feature'];
        $product->num_product    = $_POST['number_product'];
        $product->image          = $_FILES['image']['name'];
        $tmp_name                = $_FILES['image']['tmp_name'];
        $path                    = "images/product/";
        $target_file             = $path . basename($_FILES["image"]["name"]);
        $file_extension          = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $fileinfo                = @getimagesize($_FILES["image"]["tmp_name"]);
        $width                   = $fileinfo[0];
        $height                  = $fileinfo[1];
//validate iamge
        if($_FILES['image']['error'] != 0) {
        $error="Please Uploade Image ";}
        else if (! in_array($file_extension, $allowed_image_extension)) {
        $error =  "Upload valid images. Only PNG and JPEG are allowed.";}
        else if (($_FILES["image"]["size"] > 2000000)) {
        $error = "Image size exceeds 2MB"; }    // Validate image file dimension
       // else if ($width > "200" || $height > "200") {
       // $error ="Image dimension should be within 300X200";}
       else {
        $product->vendor_id ;
       if($product->create()){
       $id               =$db->lastInsertId(); 
        mkdir("images/product/".$id, 0700);    
       $product->image   =$id.".".$file_extension;
        $coverimage   =$id.".".$file_extension;
       $other_images=array();
       $path2  = "images/product/".$id."/";


       //$newimage=time().$oldeimag;//another soulition
       //move files to images folder
       $i=1;
       move_uploaded_file($tmp_name, $path.$id.".".$file_extension);
       if(count($_FILES['files']['tmp_name']) == 3){
           foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {
        $tmp_name2       = $_FILES['files']['tmp_name'][$key];
        $target_file2     = $path2 . basename($_FILES["files"]["name"][$key]);
        $file_extension2  = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
        array_push($other_images,$i.".".$file_extension2);
        move_uploaded_file($tmp_name2, $path2.$i.".".$file_extension2);    
        $i++;
    }//multiple images
 
    $images     = implode(",", $other_images);
    $ServerName   = "localhost";
    $UserNam      = "root";
    $PassWord     = "";
    $DatabaseName = "capstonedb";
    $conn         = mysqli_connect($ServerName,$UserNam,$PassWord,$DatabaseName);  
    $query="UPDATE products SET product_image='$coverimage' ,
                              other_images= '$images' 
                              WHERE product_id=$id";
       if(mysqli_query($conn,$query))
       header("Location:manage_product.php"); 
          }
          else{
            $error="only 3 images please";
          } 
          }//crete 
         }//uploaded file
         }//add new product

         if(isset($_POST['submit1']))
{

        $id                      = $_POST['productid'];
        $product->id             = $_POST['productid'];
        $row                     = $product->read_product_id();
        $coverimage              = $product->image;
        $product->name           = $_POST['name1'];
        $product->price          = $_POST['price1'];
        $product->offer          = $_POST['special_price1'];
        $product->date           = $_POST['date1'];
        $product->color          = $_POST['color1'];
        $product->size           = $_POST['size1'];
        $product->desc           = $_POST['desc1'];
        $product->sub_cat_id     = $_POST['sub_cat_id1'];
        $product->vendor_id      = $_POST['vendor_id1'];
        $product->feature        = $_POST['feature1'];
        $product->num_product    = $_POST['number_product1'];
        if(isset($_POST['state1']))
            $product->state=1;
          else
            $product->state=0;

       $product->update();
//validate iamge
        if($_FILES['image1']['error'] == 0) {
            //c    = $_FILES['image1']['name'];
        $allowed_image_extension = array("png","jpg","jpeg");
        $tmp_name        = $_FILES['image1']['tmp_name'];
        $path            = "images/product/";
        $target_file     = $path . basename($_FILES["image1"]["name"]);
        $file_extension  = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $fileinfo        = @getimagesize($_FILES["image1"]["tmp_name"]);
        $width           = $fileinfo[0];
        $height          = $fileinfo[1];
         if (! in_array($file_extension, $allowed_image_extension)) {
        $error =  "Upload valid images. Only PNG and JPEG are allowed.";}
        else if (($_FILES["image1"]["size"] > 2000000)) {
        $error = "Image size exceeds 2MB"; }    // Validate image file dimension
       // else if ($width > "400" || $height > "400") {
      //  $error ="Image dimension should be within 300X200";}
       else {
        $oldeimag=$row['product_image'];
        unlink('images/product/'.$oldeimag);
        $product->image      =$_POST['productid'].".".$file_extension;

        $product->update();
       //$newimage=time().$oldeimag;//another soulition
       //move files to images folder
       move_uploaded_file($tmp_name, $path.$_POST['productid'].".".$file_extension);
       $coverimage   =$id.".".$file_extension;
     }


        }//upload new file

        //other 3 images
if($_FILES['files1']['error'][0] == 0  AND count($_FILES['files1']['tmp_name']) == 3) {

       
       $other_images=array();
       // mkdir("images/product/".$id, 0700); 
       $path2  = "images/product/".$id."/";
        $i=1;
        foreach($_FILES["files1"]["tmp_name"] as $key=>$tmp_name) {
        $tmp_name2       = $_FILES['files1']['tmp_name'][$key];
        $target_file2     = $path2 . basename($_FILES["files1"]["name"][$key]);
        $file_extension2  = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
        array_push($other_images,$i.".".$file_extension2);
        move_uploaded_file($tmp_name2, $path2.$i.".".$file_extension2);    
        $i++;
    }//multiple images
 
    $images     = implode(",", $other_images);
    $ServerName   = "localhost";
    $UserNam      = "root";
    $PassWord     = "";
    $DatabaseName = "capstonedb";
    $conn         = mysqli_connect($ServerName,$UserNam,$PassWord,$DatabaseName);  
    $query="UPDATE products SET product_image='$coverimage' ,
                              other_images= '$images' 
                              WHERE product_id=$id";
       if(mysqli_query($conn,$query))
       header("Location:manage_product.php");

}
        
}
          ?>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).on("click", ".edit", function() {
      var product_id = this.getAttribute('data-product-id');
     // alert(product_id);
                    $.ajax(
                            {
                                type: "POST",
                                url: "update_product.php",
                                data :
                                {
                                    "product_id": product_id,
                                },
                                success: function(data)
                                {
                                  console.log(data);
                                    var data1 = JSON.parse(data);
                                    console.log(data1);
                                    $('input[name=productid]').val(data1.product_id);
                                    $('input[name=name1]').val(data1.product_name);
                                    $('input[name=price1]').val(data1.product_price);
                                    $('input[name=special_price1]').val(data1.product_offer);
                                    $('input[name=date1]').val(data1.date);
                                    $('input[name=color1]').val(data1.product_color);
                                    $('input[name=desc1], textarea').val(data1.product_desc);
                                    $('select[name=size1]').val(data1.product_size);
                                    $('select[name=sub_cat_id1]').val(data1.sub_cat_id);
                                    $('select[name=vendor_id1]').val(data1.vendor_id);
                                    $('select[name=feature1]').val(data1.features);
                                    $('input[name=number_product1]').val(data1.num_of_products);
                                    if(data1.state==1)
                                    $("#status").prop("checked", true);
                                  else
                                    $("#status").prop("checked", false);

                                    $('img[name=productimage]').attr("src",'images/product/'+data1.product_image);
                                    
                                }
                            });
    });
</script>
        <!-- page content -->
  
        <div class="right_col" role="main">
          <div class="">
           <div class="row" style="display: block;">      
            <div class="col-md-12 col-sm-12  col-12 col-xl-12 col-lg-12">
              <div class="x_panel">
                <div class="x_title">
                          <?php
                          if(isset($error))
                          {
                            echo '<div class="alert alert-danger">'.$error.'</div>';
                          }
                          ?>
                  <h2>Manage product</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                  </ul>
                  <div class="clearfix"></div>
                </div>

                <div class="x_content">
                  <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target=".bs-example-modal-lg"> <i class="fa fa-plus"></i> New product </button>
                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">New product</h4>
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
                          <span class="section">Product Info</span>
                          <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                              <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="" required="required" />
                            </div>
                          </div>
                          <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Price <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                              <input class="form-control" type="number" class='number' name="price" data-validate-minmax="5,100" required='required'></div>
                            </div>
                            <div class="field item form-group">
                              <label class="col-form-label col-md-3 col-sm-3  label-align">Special Price <span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="number" class='number' name="special_price" data-validate-minmax="0,100" required='required'></div>
                              </div>
                              <div class="field item form-group">
                                 <label class="col-form-label col-md-3 col-sm-3  label-align">number of products<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="number" class='number' name="number_product" data-validate-minmax="5,100" required='required'></div>
                              </div>

                              <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Date<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                  <input class="form-control" class='date' type="date" name="date" required='required'></div>
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
                                  <?php  $stmtc=$product->read_category_sub();?>
                                  <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Category Name<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                     <select class="form-control" name="sub_cat_id" required="">
                                       <option value="">Choose Category</option>
                                       <?php 
                                         while ($rowc = $stmtc->fetch(PDO::FETCH_ASSOC)){
                                        extract($rowc);
                                        ?>
                                        <option value="<?php echo $sub_cat_id; ?>"><?php echo $category_name."/".$sub_cat_name; ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">Product Size<span class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                    <select class="form-control" name="size" required="">
                                      <option value="">Choose Size</option>
                                      <option value="XS">XS</option>
                                      <option value="S">S</option>
                                      <option value="L">L</option>
                                      <option value="XL">XL</option>
                                      <option value="Free Size">Free Size</option>
                                      <option value="XS,S,L,XL">XS,S,L,XL</option>
                                    </select>
                                  </div>
                                </div>
                                  <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">Product Features<span class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                    <select class="form-control" name="feature" required="">
                                      <option value="">Choose Feature</option>
                                      <option value="0">none</option>
                                      <option value="1">New</option>
                                      <option value="2">Sale</option>
                                      <option value="3">Hot</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">color <span class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                    <input class="" type="color" class='' name="color"  required='required'></div>
                                  </div>

                                  <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Description<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                      <textarea required="required" name='desc' style="width: 500px;height: 300px;"></textarea></div>
                                    </div>
                                    <div class="field item form-group">
                                      <label class="col-form-label col-md-3 col-sm-3  label-align"> Cover Image<span class="required">*</span></label>

                                      <div class="col-md-6 col-sm-6">
                                       <input type="file" id="file-input1" name="image" class="form-control-file" required="">
                                     </div>
                                   </div>
                                       <div class="field item form-group">
                                      <label class="col-form-label col-md-3 col-sm-3  label-align"> Other  3 Images<span class="required">*</span></label>

                                      <div class="col-md-6 col-sm-6">
                                      
                                       <input type="file" name="files[]" multiple required="" />
                                     </div>
                                   </div>
                                   <div class="checkbox">
                                    <label>
                                      <input type="checkbox" class="flat" checked="checked" name="state" > state
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

          
                 <div class="table-responsive">
                  <?php
                  // page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
  
// set number of records per page
$records_per_page =5;
  
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
  
  // query products
 
      $stmt = $product->readAll($from_record_num, $records_per_page);
      $num  = $stmt->rowCount(); 

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
                        <th class="column-title">Sub Category Name</th>
                        <th class="column-title">Vendor Name</th>
                        <th class="column-title">Feature</th>
                        <th class="column-title">State</th>
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
                            <div class="profile_pic"><img src="images/product/<?php echo $product_image; ?>" alt="<?php echo $product_name; ?>" class="img-circle profile_img" style="width: 75px;height: 75px;"></div> 
                          </td>
                          <td class=" "><?php echo $product_name; ?></td>
                          <?php
                          $sub_category =new Sub_Category($db);
                          $sub_category->id=$sub_cat_id;
                          $sub_category->read_sub_category_id();
                          ?>
                          <td class="a-right a-right "><?php echo $sub_category->name; ?> </td>
                           <?php
                          $vendor    =new Vendor($db);
                          $vendor->id=$vendor_id;
                          $vendor->read_vendor_id();      
                          ?>
                          <td class="a-right a-right "><?php echo $vendor->name; ?> </td>
                           <?php 
                          
                          if($features == 0)
                          $feature="NONE";
                          elseif($features == 1)
                           $feature="NEW";
                          elseif($features == 2)
                           $feature="SALE";
                          elseif($features == 3)
                          $feature="HOT";
                        elseif($num_of_products==0)
                          $feature="Out Of Stock";
                          ?>
                             <td class="a-right a-right "><?php echo $feature; ?> </td>
                          <?php 
                          $value="";
                          if($state==0)
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
                            <a href="#"><span  data-product-id="<?php echo $product_id; ?>" data-toggle="modal" data-target=".bs-example-modal-lg1" class="edit glyphicon glyphicon-edit " aria-hidden="true" style="color:#26B99A; font-size: 25px;"></span></a>
                            <a href="manage_product.php?idd=<?php echo $product_id;?>"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="color: #dc3545; font-size: 25px;"></span></a>
                            <a href="product_detalils.php?id=<?php echo $product_id;?>"><i class="fa fa-ellipsis-h" style="color:#26B99A; font-size: 25px;"></i></a>
                           
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <?php
                     // paging buttons will be here
    // the page where this paging is used
$page_url = "manage_product.php?";
  
// count all products in the database to calculate total pages
$total_rows = $product->countAll();
  
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
                          <h4 class="modal-title" id="myModalLabel">Update product</h4>
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
                          <input type="text" name="productid" value="" hidden>
                          <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                              <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="name1" placeholder="ex. Rawan H. Tarabsheh" required="required" />
                            </div>
                          </div>
                          <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Price <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                              <input class="form-control" type="number" class='number' name="price1" data-validate-minmax="5,100" required='required'></div>
                            </div>
                            <div class="field item form-group">
                              <label class="col-form-label col-md-3 col-sm-3  label-align">Special Price <span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="number" class='number' name="special_price1" data-validate-minmax="0,100" required='required'></div>
                              </div>
                                
                               <div class="field item form-group">
                              <label class="col-form-label col-md-3 col-sm-3  label-align">number of products<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="number" class='number' name="number_product1" data-validate-minmax="5,100" required='required'></div>
                              </div>
                              <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Date<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                  <input class="form-control" class='date' type="date" name="date1" required='required'></div>
                                </div>

                                 <?php  $stmtv=$vendor->read();?>
                                <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">Vendor Name<span class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                     <select class="form-control" name="vendor_id1">
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
                                      <?php  $stmtc=$product->read_category_sub();?>
                                  <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Category Name<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                     <select class="form-control" name="sub_cat_id1">
                                       <option value="">Choose Category</option>
                                       <?php 
                                         while ($rowc = $stmtc->fetch(PDO::FETCH_ASSOC)){
                                        extract($rowc);
                                        ?>
                                        <option value="<?php echo $sub_cat_id; ?>"><?php echo $category_name."/".$sub_cat_name; ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">Product Size<span class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                    <select class="form-control" name="size1">
                                      <option value="">Choose Size</option>
                                      <option value="XS">XS</option>
                                      <option value="S">S</option>
                                      <option value="L">L</option>
                                      <option value="XL">XL</option>
                                      <option value="Free Size">Free Size</option>
                                      <option value="XS,S,L,XL">XS,S,L,XL</option>
                                    </select>
                                  </div>
                                </div>
                                    <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">Product Features<span class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                    <select class="form-control" name="feature1">
                                      <option value="">Choose Feature</option>
                                      <option value="0">none</option>
                                      <option value="1">New</option>
                                      <option value="2">Sale</option>
                                      <option value="3">Hot</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">color <span class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                    <input class="" type="color" class='' name="color1"  required='required'></div>
                                  </div>
                                  <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Description<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                      <textarea required="required" name='desc1' style="width: 500px;height: 300px;"></textarea></div>
                                    </div>
                                      <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Cover Image<span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                         <input type="file" id="file-input" name="image1" class="form-control-file">
                                         <img src="" style="width: 200px; height: 150px;" name="productimage">
                                       </div>

                                     </div>
                                       <div class="field item form-group">
                                      <label class="col-form-label col-md-3 col-sm-3  label-align"> Other  3 Images<span class="required">*</span></label>

                                      <div class="col-md-6 col-sm-6">
                                      
                                       <input type="file" name="files1[]" multiple/>
                                     </div>
                                   </div>
                                     <div class="checkbox">
                                   
                                      <label>
                                        <input type="checkbox" class="flat" checked="" name="state1" id="status"> state
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
