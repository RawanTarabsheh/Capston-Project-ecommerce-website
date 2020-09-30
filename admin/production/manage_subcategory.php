<?php  ob_start();
require_once('include/admin_header.php'); 
require_once('include/database.php');
require_once('include/sub_category.php');
require_once('include/category.php');
         // get database connection
$database     = new Database();
$db           = $database->getConnection();
$sub_category = new  Sub_Category($db);
$category     = new Category($db);
if(isset($_GET['idd'])){
    $sub_category->id=$_GET['idd'];  
  if($sub_category->delete()){
    
    header("Location:manage_subcategory.php");}
   }//delete sub_category by id 

         if(isset($_POST['submit'])) {
        $sub_category->name     = $_POST['name'];
        $sub_category->cat_id   = $_POST['cat_id'];
       if($sub_category->create()){
       header("Location:manage_subcategory.php");      
       }
         }//add new sub_category

         if(isset($_POST['submit1'])){
        $sub_category->id     = $_POST['sub_categoryid'];
        $row                  = $sub_category->read_sub_category_id();
        $sub_category->id     = $sub_category->id; 
        $sub_category->name   = $_POST['name1'];  
        $sub_category->cat_id = $_POST['cat_id1'];
       if($sub_category->update())
       header("Location:manage_subcategory.php");}//update sub category
  ?>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).on("click", ".edit", function() {
      var sub_cat_id = this.getAttribute('data-sub_category-id');
                    $.ajax(
                            {
                                type: "POST",
                                url: "update_subcategory.php",
                                data :
                                {
                                    "sub_cat_id": sub_cat_id,
                                },
                                success: function(data)
                                {
                                  console.log(data);
                                    var data1 = JSON.parse(data);
                                    $('input[name=sub_categoryid]').val(data1.sub_cat_id);
                                    $('input[name=name1]').val(data1.sub_cat_name);
                                    $('select[name=cat_id1]').val(data1.category_id);
                                    
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
                  <h2>Manage Sub Category</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                  </ul>
                  <div class="clearfix"></div>
                </div>

                <div class="x_content">
                  <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target=".bs-example-modal-lg"> <i class="fa fa-plus"></i> New Sub Category </button>
                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel"> New Sub Category</h4>
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
                              <span class="section">Sub Category Info</span>
                              <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                  <input class="form-control" data-validate-length-range="3" data-validate-words="1" name="name" placeholder="ex. Rawan H. Tarabsheh" required="required" />
                                </div>
                              </div>
                            <?php  $stmtc=$category->read();?>
                                  <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Category Name<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                     <select class="form-control" name="cat_id" required="">
                                       <option value="">Choose Category</option>
                                       <?php 
                                         while ($rowc = $stmtc->fetch(PDO::FETCH_ASSOC)){
                                        extract($rowc);
                                        ?>
                                        <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                                      <?php } ?>
                                    </select>
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
  
  <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
               
                  <div class="x_content">

                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="women-tab" data-toggle="tab" href="#women" role="tab" aria-controls="women" aria-selected="false">Women's</a>
                      </li>
                    
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                              <div class="table-responsive">
                            <?php
                  // page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
  
// set number of records per page
$records_per_page =5;
  
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
  
  // query products
$stmt = $sub_category->readAll($from_record_num, $records_per_page);
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
                        <th class="column-title"> Name </th>
                        <th class="column-title">Category Name </th>
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
                            //print_r($sub_categoryrow);
                        ?>
                        <tr class="even pointer" style="line-height: 100px;">
                          <td class="a-center ">
                            <input type="checkbox" class="flat" name="table_records">
                          </td>
                          <td class=" "><?php echo $number;?></td>
                          <td class=" "><?php echo $sub_cat_name; ?></td>
                           <?php
                          $category =new Category($db);
                          $category->id=$category_id;
                          $category->read_category_id();
                          ?>
                          <td class=" "><?php echo $category->name; ?></td>
                          <td class=" last">
                            <a href="#"><span  data-sub_category-id="<?php echo $sub_cat_id; ?>" data-toggle="modal" data-target=".bs-example-modal-lg1" class="edit glyphicon glyphicon-edit " aria-hidden="true" style="color:#26B99A; font-size: 25px;"></span></a>
                            <a href="manage_subcategory.php?idd=<?php echo $sub_cat_id;?>"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="color: #dc3545; font-size: 25px;"></span></a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                             <?php
                     // paging buttons will be here
    // the page where this paging is used
$page_url = "manage_subcategory.php?";
  
// count all products in the database to calculate total pages
$total_rows = $sub_category->countAll();
  
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
                      <div class="tab-pane fade" id="women" role="tabpanel" aria-labelledby="women-tab">
                        <div class="table-responsive">
                            <?php
                  // page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
  
// set number of records per page
$records_per_page =10;
  
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
  $sub_category->cat_id=8;
  // query products
$stmt = $sub_category->readAll_cat($from_record_num, $records_per_page);
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
                        <th class="column-title"> Name </th>
                        <th class="column-title">Category Name </th>
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
                            //print_r($sub_categoryrow);
                        ?>
                        <tr class="even pointer" style="line-height: 100px;">
                          <td class="a-center ">
                            <input type="checkbox" class="flat" name="table_records">
                          </td>
                          <td class=" "><?php echo $number;?></td>
                          <td class=" "><?php echo $sub_cat_name; ?></td>
                           <?php
                          $category =new Category($db);
                          $category->id=$category_id;
                          $category->read_category_id();
                          ?>
                          <td class=" "><?php echo $category->name; ?></td>
                          <td class=" last">
                            <a href="#"><span  data-sub_category-id="<?php echo $sub_cat_id; ?>" data-toggle="modal" data-target=".bs-example-modal-lg1" class="edit glyphicon glyphicon-edit " aria-hidden="true" style="color:#26B99A; font-size: 25px;"></span></a>
                            <a href="manage_subcategory.php?idd=<?php echo $sub_cat_id;?>"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="color: #dc3545; font-size: 25px;"></span></a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                             <?php
                     // paging buttons will be here
    // the page where this paging is used
$page_url = "manage_subcategory.php?";
  
// count all products in the database to calculate total pages
$total_rows = $sub_category->countAll();
  
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
                      <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                            booth letterpress, commodo enim craft beer mlkshk 
                      </div>
                    </div>
                  </div>
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
                          <h4 class="modal-title" id="myModalLabel">Update Sub Category</h4>
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
                              <span class="section">Sub Category Info</span>
                              <input type="text" name="sub_categoryid" value="" hidden>
                              <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                  <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="name1" placeholder="ex. Rawan H. Tarabsheh" required="required" />
                                </div>
                              </div>
                                <?php  $stmtc=$category->read();?>
                                  <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Category Name<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                     <select class="form-control" name="cat_id1" required="">
                                       <option value="">Choose Category</option>
                                        <?php 
                                         while ($rowc = $stmtc->fetch(PDO::FETCH_ASSOC)){
                                        extract($rowc);
                                        ?>
                                        <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                                      <?php } ?>
                                    </select>
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
