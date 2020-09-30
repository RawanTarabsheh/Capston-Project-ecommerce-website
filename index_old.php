  <?php  ob_start();
   require_once('include/header.php');
   require_once('admin/production/include/database.php');
   require_once('admin/production/include/category.php');
   require_once('admin/production/include/product.php');
   require_once('admin/production/include/sub_category.php');

         // get database connection
$database = new Database();
$db       = $database->getConnection();
$category = new Category($db);
$product = new Product($db);
$sub_category = new Sub_Category($db);
$stmt     = $category->read();
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
$first_categor=$stmt->fetch(PDO::FETCH_ORI_FIRST);
extract($first_categor);
 $category->id=$category_id;
    $num1= $category->count_items();


?>
<script type="text/javascript">
    $("document").ready(function(){
        $(".all").show();
        $(".women").hide();
        $(".men").hide();
        $(".kid").hide();
        $(".accessories").hide();
        $(".cosmetic").hide();
    $(".all_").click(function(){
        $(".all").show();
        $(".women").hide();
        $(".men").hide();
        $(".kid").hide();
        $(".accessories").hide();
        $(".cosmetic").hide();
        });

       $(".women_").click(function(){
        $(".all").hide();
        $(".women").show();
        $(".men").hide();
        $(".kid").hide();
        $(".accessories").hide();
        $(".cosmetic").hide();
        });

        $(".men_").click(function(){
        $(".all").hide();
        $(".women").hide();
        $(".men").show();
        $(".kid").hide();
        $(".accessories").hide();
        $(".cosmetic").hide();
        });
        $(".kid_").click(function(){
        $(".all").hide();
        $(".women").hide();
        $(".men").hide();
        $(".kid").show();
        $(".accessories").hide();
        $(".cosmetic").hide();
        });
        $(".accessories_").click(function(){
        $(".all").hide();
        $(".women").hide();
        $(".men").hide();
        $(".kid").hide();
        $(".accessories").show();
        $(".cosmetic").hide();
        });
         $(".cosmetic_").click(function(){
        $(".all").hide();
        $(".women").hide();
        $(".men").hide();
        $(".kid").hide();
        $(".accessories").hide();
        $(".cosmetic").show();
        });

    });

</script>
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="categories__item categories__large__item set-bg"
                    data-setbg="admin/production/images/category/<?php echo $category_image;?>">
                    <div class="categories__text">
                        <h1><?php echo $category_name;?></h1>
                        <p><?php echo $num1;?> items</p>
                        <a href="shop.php?cat_id=<?php  echo $category_id;?>">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <?php 

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                       $category->id=$category_id;
                       $num= $category->count_items();
                       extract($row);
                    ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="admin/production/images/category/<?php echo $category_image;?>">
                            <div class="categories__text">
                                <h4><?php echo $category_name;?></h4>
                                <p><?php echo $num;?> items</p>
                                <a href="shop.php?cat_id=<?php  echo $category_id;?>">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                  
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="section-title">
                    <h4>New product</h4>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <ul class="filter__controls">
                    <li class="active all_" >All</li>
                    <li class="women_">Women’s</li>
                    <li class="men_">Men’s</li>
                    <li class="kid_">Kid’s</li>
                    <li class="accessories_">Accessories</li>
                    <li class="cosmetic_">Cosmetics</li>
                </ul>
            </div>
        </div>

        <div class="row property__gallery">
             <?php 
                      $sub_category->cat_id=8;
                    $sub_category->feature=1;
                    $stmt=$sub_category->read_prodct_for_subcategory_f();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row)
                    ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mix women">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="admin/production/images/product/<?php echo $pro_image;?>">
                        <div class="label new">New</div>
                        <ul class="product__hover">
                            <li><a href="admin/production/images/product/<?php echo $pro_image;?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                            <li><a href="add_favorite.php?id=<?php echo $pro_id;?>"><span class="icon_heart_alt"></span></a></li>
                            <li><a href="add_to_cart.php?id=<?php echo $pro_id;?>"><span class="icon_bag_alt"></span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#"><?php echo $pro_name;?></a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price"><?php echo "$ ".$pro_price;?></div>
                    </div>
                </div>
            </div>
             <?php } ?>
             <?php 
                    $sub_category->cat_id=9;
                    $sub_category->feature=1;
                    $stmt=$sub_category->read_prodct_for_subcategory_f();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row)
                    ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mix men">
<div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="admin/production/images/product/<?php echo $pro_image;?>">
                        <div class="label new">New</div>
                        <ul class="product__hover">
                            <li><a href="admin/production/images/product/<?php echo $pro_image;?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                            <li><a href="add_favorite.php?id=<?php echo $pro_id;?>"><span class="icon_heart_alt"></span></a></li>
                            <li><a href="add_to_cart.php?id=<?php echo $pro_id;?>"><span class="icon_bag_alt"></span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#"><?php echo $pro_name;?></a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price"><?php echo "$ ".$pro_price;?></div>
                    </div>
                </div>
            </div>
 <?php } ?>
 <?php 
                    $sub_category->cat_id=12;
                    $sub_category->feature=1;
                    $stmt=$sub_category->read_prodct_for_subcategory_f();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                        extract($row)
                    ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mix accessories">
               <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="admin/production/images/product/<?php echo $pro_image;?>">
                        <div class="label new">New</div>
                        <ul class="product__hover">
                            <li><a href="admin/production/images/product/<?php echo $pro_image;?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                            <li><a href="add_favorite.php?id=<?php echo $pro_id;?>"><span class="icon_heart_alt"></span></a></li>
                            <li><a href="add_to_cart.php?id=<?php echo $pro_id;?>"><span class="icon_bag_alt"></span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#"><?php echo $pro_name;?></a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price"><?php echo "$ ".$pro_price;?></div>
                    </div>
                </div>
            </div>
        <?php } ?>
            <?php 
                    $sub_category->cat_id=11;
                    $sub_category->feature=1;
                    $stmt=$sub_category->read_prodct_for_subcategory_f();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row)
                    ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mix cosmetic">
              <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="admin/production/images/product/<?php echo $pro_image;?>">
                        <div class="label new">New</div>
                        <ul class="product__hover">
                            <li><a href="admin/production/images/product/<?php echo $pro_image;?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                            <li><a href="add_favorite.php?id=<?php echo $pro_id;?>"><span class="icon_heart_alt"></span></a></li>
                            <li><a href="add_to_cart.php?id=<?php echo $pro_id;?>"><span class="icon_bag_alt"></span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#"><?php echo $pro_name;?></a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price"><?php echo "$ ".$pro_price;?></div>
                    </div>
                </div>
            </div>
        <?php } ?>
 <?php 
                    $sub_category->cat_id=10;
                    $sub_category->feature=1;
                    $stmt=$sub_category->read_prodct_for_subcategory_f();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row)
                    ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mix kid">
              <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="admin/production/images/product/<?php echo $pro_image;?>">
                        <div class="label new">New</div>
                        <ul class="product__hover">
                            <li><a href="admin/production/images/product/<?php echo $pro_image;?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                            <li><a href="add_favorite.php?id=<?php echo $pro_id;?>"><span class="icon_heart_alt"></span></a></li>
                            <li><a href="add_to_cart.php?id=<?php echo $pro_id;?>"><span class="icon_bag_alt"></span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#"><?php echo $pro_name;?></a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price"><?php echo "$ ".$pro_price;?></div>
                    </div>
                </div>
            </div>
        <?php }?>
        <?php 
                    $product->feature=1;
                    $stmt=$product->read_feature();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row)

        ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mix all">
                <div class="product__item sale">
                    <div class="product__item__pic set-bg" data-setbg="admin/production/images/product/<?php echo $product_image;?>">
                        <div class="label sale">NEW</div>
                        <ul class="product__hover">
                            <li><a href="admin/production/images/product/<?php echo $product_image;?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                            <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#"><?php echo $product_name;?></a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price"><?php echo "$ ".$product_price;?></div>
                    </div>
                </div>
            </div>
        <?php } ?>
           <!--    <div class="col-lg-3 col-md-4 col-sm-6 mix women men kid accessories cosmetic">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-7.jpg">
                        <ul class="product__hover">
                            <li><a href="img/product/product-7.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                            <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">Contrasting sunglasses</a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price">$ 59.0</div>
                    </div>
                </div>
            </div>
         <div class="col-lg-3 col-md-4 col-sm-6 mix women men kid accessories cosmetic">
                <div class="product__item sale">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-8.jpg">
                        <div class="label">Sale</div>
                        <ul class="product__hover">
                            <li><a href="img/product/product-8.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                            <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">Water resistant backpack</a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price">$ 49.0 <span>$ 59.0</span></div>
                    </div>
                </div>
            </div>-->
        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Banner Section Begin -->
<section class="banner set-bg" data-setbg="img/banner/banner-1.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-8 m-auto">
                <div class="banner__slider owl-carousel">
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>The Chloe Collection</span>
                            <h1>The Project Jacket</h1>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>The Chloe Collection</span>
                            <h1>The Project Jacket</h1>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>The Chloe Collection</span>
                            <h1>The Project Jacket</h1>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Trend Section Begin -->
<section class="trend spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Hot Trend</h4>
                    </div>
                    <?php 
                    $product->feature=3;
                    $stmt=$product->read_feature();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                    ?>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="admin/production/images/product/<?php echo $product_image;?>" alt="<?php echo $product_name;?>" style="width: 90px;height: 90px;">
                        </div>
                        <div class="trend__item__text">
                            <h6><?php echo $product_name;?></h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price"><?php echo "$ ".$product_price;?></div>
                        </div>
                    </div>
                <?php } ?>
                  
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Best seller</h4>
                    </div>
                     <?php 
                    $product->feature=2;
                    $stmt=$product->read_feature();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                    ?>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="admin/production/images/product/<?php echo $product_image;?>" alt="<?php echo $product_name;?>" style="width: 90px;height: 90px;">
                        </div>
                        <div class="trend__item__text">
                            <h6><?php echo $product_name;?></h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price"><?php echo "$ ".$product_price;?></div>
                        </div>
                    </div>
                <?php }?>
                    
                 
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>New Arrive</h4>
                    </div>
                   
                         <?php 
                    $product->feature=1;
                    $stmt=$product->read_feature();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                    ?>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="admin/production/images/product/<?php echo $product_image;?>" alt="<?php echo $product_name;?>" style="width: 90px;height: 90px;">
                        </div>
                        <div class="trend__item__text">
                            <h6><?php echo $product_name;?></h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price"><?php echo "$ ".$product_price;?></div>
                        </div>
                    </div>
                <?php }?>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Trend Section End -->

<!-- Discount Section Begin -->
<section class="discount">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 p-0">
                <div class="discount__pic">
                    <img src="img/discount.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 p-0">
                <div class="discount__text">
                    <div class="discount__text__title">
                        <span>Discount</span>
                        <h2>Summer 2019</h2>
                        <h5><span>Sale</span> 50%</h5>
                    </div>
                    <div class="discount__countdown" id="countdown-time">
                        <div class="countdown__item">
                            <span>22</span>
                            <p>Days</p>
                        </div>
                        <div class="countdown__item">
                            <span>18</span>
                            <p>Hour</p>
                        </div>
                        <div class="countdown__item">
                            <span>46</span>
                            <p>Min</p>
                        </div>
                        <div class="countdown__item">
                            <span>05</span>
                            <p>Sec</p>
                        </div>
                    </div>
                    <a href="#">Shop now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Discount Section End -->

<!-- Services Section Begin -->
<section class="services spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-car"></i>
                    <h6>Free Shipping</h6>
                    <p>For all oder over $99</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-money"></i>
                    <h6>Money Back Guarantee</h6>
                    <p>If good have Problems</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-support"></i>
                    <h6>Online Support 24/7</h6>
                    <p>Dedicated support</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-headphones"></i>
                    <h6>Payment Secure</h6>
                    <p>100% secure payment</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section End -->

<?php 
require_once('include/footer.php');
?>