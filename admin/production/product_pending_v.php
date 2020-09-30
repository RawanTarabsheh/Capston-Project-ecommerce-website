<?php  ob_start();
require_once('include/vendor_header.php'); 
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
?>
        <!-- page content -->
  
        <div class="right_col" role="main">
          <div class="">
           <div class="row" style="display: block;">      
            <div class="col-md-12 col-sm-12  col-12 col-xl-12 col-lg-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Manage product</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                  </ul>
                  <div class="clearfix"></div>
                </div>

                <div class="x_content"></div>
            
          
                 <div class="table-responsive">
                  <?php
                  // page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
  
// set number of records per page
$records_per_page =5;
  
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
  
  // query products
    if(isset($_SESSION['vendor_id'])) {
      $product->vendor_id = $_SESSION['vendor_id'];
      $stmt               = $product->readAll_vid_prnding($from_record_num, $records_per_page);
       $num               = $stmt->rowCount();
     }

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
                            $value='<div class="fa-hover col-md-3 col-sm-4  "><a ><i class="fa fa-toggle-off" style="color: #dc3545; font-size: 25px;"></i></a>
                          
                        </div>';
                      }
                          else{
                            $value='<div class="fa-hover col-md-3 col-sm-4  "><a ><i class="fa fa-toggle-on" style="color:#26B99A; font-size: 25px;"></i> </a>
                          
                        </div>';}
                          ?>
                          <td class="a-right a-right "><?php echo $value; ?> </td>
                          <?php if(isset($_SESSION['vendor_id']) && $state==0){
                            echo'<td><i class="fa fa-unlock-alt" style="font-size:25px;color:red;"></i></td>';
                          }else
                          {
                            ?>
                         
                          <td class=" last">
                            <a href="#"><span  data-product-id="<?php echo $product_id; ?>" data-toggle="modal" data-target=".bs-example-modal-lg1" class="edit glyphicon glyphicon-edit " aria-hidden="true" style="color:#26B99A; font-size: 25px;"></span></a>
                            <a href="product_pending_v.php?idd=<?php echo $product_id;?>"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="color: #dc3545; font-size: 25px;"></span></a>
                            <a href="product_detalils_v.php?id=<?php echo $product_id;?>"><i class="fa fa-ellipsis-h" style="color:#26B99A; font-size: 25px;"></i></a>
                           
                          </td>
                        <?php }?>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <?php
                     // paging buttons will be here
    // the page where this paging is used
$page_url = "product_pending_v.php?";
  
// count all products in the database to calculate total pages
$total_rows = $product->countAll_p();
  
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
                      

    <?php    require_once('include/vendor_footer.php'); ?>
