<?php  ob_start();
require_once('include/vendor_header.php'); 
require_once('include/database.php');
require_once('include/product.php');
require_once('include/category.php');
require_once('include/sub_category.php');
require_once('include/vendor.php');


// get database connection
$database = new Database();
$db       = $database->getConnection();
$product    =new Product($db);
$product->id=$_GET['id'];
$product->read_product_id();
?>

<!-- page content -->

<div class="right_col" role="main">
	<div class="">
		<div class="row" style="display: block;">      
			<div class="col-md-12 col-sm-12  ">
				<div class="x_panel">
					<div class="x_title">
						<h2>Product Details</h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>

						</ul>
						<div class="clearfix"></div>
					</div>

					<div class="x_content">

						<!-- page content -->
						<div class="col-md-12 col-sm-12">
							<div class="x_panel">

								<div class="x_content">

									<form class="" action="" method="post" novalidate enctype="multipart/form-data">
									</p>
									<span class="section"><?php echo $product->name;?></span>
									<div class="field item form-group">
										<label class="col-form-label col-md-3 col-sm-3  text-center">Product Name<span class="required">:</span></label>
										<div class="col-md-6 col-sm-6">
											<label class="text-center" style="padding-top: 7px;"><?php echo $product->name; ?></label>
										</div>
									</div>
									 <?php
                          $sub_category =new Sub_Category($db);
                          $sub_category->id=$product->sub_cat_id;
                          $sub_category->read_sub_category_id();
                          ?>
									<div class="field item form-group">
										<label class="col-form-label col-md-3 col-sm-3  text-center">Category Name<span class="required">:</span></label>
										<div class="col-md-6 col-sm-6">
											<label class="text-center" style="padding-top: 7px;"><?php echo $sub_category->name; ?></label>
										</div>
									</div>
									 <?php
                          $vendor =new Vendor($db);
                          $vendor->id=$product->vendor_id;
                          $vendor->read_vendor_id();
                          ?>
									<div class="field item form-group">
										<label class="col-form-label col-md-3 col-sm-3  text-center">Vendor Name<span class="required">:</span></label>
										<div class="col-md-6 col-sm-6">
											<label class="text-center" style="padding-top: 7px;"><?php echo $vendor->name; ?></label>
										</div>
									</div>
									<div class="field item form-group">
										<label class="col-form-label col-md-3 col-sm-3  text-center">Product Color<span class="required">:</span></label>
										<div class="col-md-6 col-sm-6">
											<label class="text-center" style="padding-top: 7px;"><i class="fa fa-circle" style="font-size: 25px;color:<?php echo $product->color; ?>!important"></i></label>
										</div>
									</div>
									<div class="field item form-group">
										<label class="col-form-label col-md-3 col-sm-3  text-center">Product Size<span class="required">:</span></label>
										<div class="col-md-6 col-sm-6">
											<label class="text-center" style="padding-top: 7px;"><?php echo $product->size; ?></label>
										</div>
									</div>
									<div class="field item form-group">
										<label class="col-form-label col-md-3 col-sm-3  text-center">Product Price<span class="required">:</span></label>
										<div class="col-md-6 col-sm-6">
											<label class="text-center" style="padding-top: 7px;"><?php echo $product->price."$"; ?></label>
										</div>
									</div>
									<?php 
									if($product->feature == 0)
										$value="NONE";
									elseif($product->feature == 1)
										$value="NEW";
									elseif($product->feature == 2)
										$value="SALE";
									elseif($product->feature == 3)
										$value="HOT";


									?>
									<div class="field item form-group">
										<label class="col-form-label col-md-3 col-sm-3  text-center">Product Feature <span class="required">:</span></label>
										<div class="col-md-6 col-sm-6">
											<label class="text-center" style="padding-top: 7px;"><?php echo $value; ?></label>
										</div>
									</div>
									<?php if($product->feature == 2 && $product->offer !==0) {?>
									<div class="field item form-group">
										<label class="col-form-label col-md-3 col-sm-3  text-center">Special Offer<span class="required">:</span></label>
										<div class="col-md-6 col-sm-6">
											<label class="text-center" style="padding-top: 7px;"><?php echo $product->offer."$"; ?></label>
										</div>
									</div>
								<?php } ?>

										

										<div class="field item form-group">
										<label class="col-form-label col-md-3 col-sm-3  text-center"> Description <span class="required">:</span></label>
										<div class="col-md-6 col-sm-6">
											<label class="text-center" style="padding-top: 7px;"><?php echo $product->desc; ?></label>
										</div>
									</div>
									<div class="field item form-group">
										<label class="col-form-label col-md-3 col-sm-3  text-center"> Date<span class="required">:</span></label>
										<div class="col-md-6 col-sm-6">
											<label class="text-center" style="padding-top: 7px;"><?php echo $product->date; ?></label>
										</div>
									</div>
									<div class="field item form-group">
										<label class="col-form-label col-md-3 col-sm-3  text-center"> Image <span class="required">:</span></label>
										<div class="col-md-6 col-sm-6">
											<img src="images/product/<?php echo $product->image; ?>" alt="<?php echo $product->name; ?>"  style="width: 100px;height: 200px;">
										</div>
									</div>
								

												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /page content -->
						</div>
					</div>
				</div>


			<?php 
			require_once('include/vendor_footer.php'); 
			?>