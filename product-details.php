 <?php  ob_start();
   require_once('include/header.php');
   require_once('admin/production/include/database.php');
   require_once('admin/production/include/category.php');
   require_once('admin/production/include/sub_category.php');
   require_once('admin/production/include/product.php');
   require_once('admin/production/include/vendor.php');

         // get database connection
$database     = new Database();
$db           = $database->getConnection();
$category     = new Category($db);
$sub_category = new Sub_Category($db);
$product      = new Product($db);
$vendor      = new Vendor($db);

if(isset($_GET['id']) && isset($_GET['cat_id']) )
{
     $sub_category->cat_id=$_GET['cat_id'] ;
       $stmt2  = $sub_category->read_category_id();
        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);  
         extract($row2);
         $product->id=$_GET['id'];
         $product->read_product_id();
         $name=$cat_name;


}
elseif(isset($_GET['id']) && isset($_GET['sub_cat']) )
{
        $sub_category->id=$_GET['sub_cat'] ;
        $stmt2       = $sub_category->read_sub_category_id();
        $name        = $sub_category->name;
        $product->id = $_GET['id'];
        $product->read_product_id();

}
?>

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.php"><i class="fa fa-home"></i> Home</a>
                        <a href="shop.php"><?php echo  $name; ?> </a>
                        <span><?php echo $product->name;?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__left product__thumb nice-scroll">
                            <?php
                         $images= explode(",", $product->other_image);
                    
                            ?>
                            <a class="pt active" href="#product-1">
                                <img src="admin/production/images/product/<?php echo $product->image;?>" alt="">
                            </a>
                            <?php    foreach ($images as $key => $value) {?>
                            <a class="pt" href="#product-2">
                                <img src="admin/production/images/product/<?php echo $product->id;?>/<?php echo $value; ?>" alt="">
                            </a>
                        <?php } ?>
                           
                        </div>
                        <div class="product__details__slider__content">
                            <div class="product__details__pic__slider owl-carousel">
                                <img data-hash="product-1" class="product__big__img" src="admin/production/images/product/<?php echo $product->image;?>" alt="">
                            <?php    foreach ($images as $key => $value) {?>
                                <img data-hash="product-2" class="product__big__img" src="admin/production/images/product/<?php echo $product->id;?>/<?php echo $value; ?>" alt="">
  <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                $vendor->id=$product->vendor_id;
                $vendor->read_vendor_id();
                ?>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <h3><?php echo $product->name;?> <span>Vendor Name: <?php echo $vendor->name;?></span></h3>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <span>( 138 reviews )</span>
                        </div>
                        <?php 
                        if($product->offer != 0)
                        {
                            $new_price=$product->offer;
                            $price='<div class="product__details__price">'.$new_price.' $ <span>'. $product->price.' $ٍ</span></div>';
                        }
                        else
                        {
                           $new_price= "";
                            $price='<div class="product__details__price">'. $product->price.'$ <span>'. $new_price.'</span></div>';
                        }
                        echo "The Price is : " .$price;
                        ?>
                        
                        <p><?php echo $product->desc;?></p>
                        <div class="product__details__button">
                           
                            <a href="add_to_cart.php?id=<?php echo $product->id;?>" class="cart-btn"><span class="icon_bag_alt"></span> Add to cart</a>
                            <ul>
                                <li><a href="add_favorite.php?id=<?php echo $product->id;?>"><span class="icon_heart_alt"></span></a></li>
                            </ul>
                        </div>
                        <div class="product__details__widget">
                            <ul>
                                <li>
                                       <?php 
                                    if($product->num_product != 0)
                                    {
                                        $stock="checked";
                                    }
                                    else
                                    {
                                       $stock="";   
                                    }
                                    ?>
                                 
                                    <span>Availability:</span>
                                    <div class="stock__checkbox">
                                        <label for="stockin">
                                            In Stock
                                            <input type="checkbox" id="stockin" <?php echo $stock;?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <span>Available color:</span>
                                    <div class="color__checkbox">
                                        <label for="red">
                                            <input type="radio" name="color__radio" id="" checked>
                                            <span class="checkmark" style="background: <?php echo $product->color; ?>"></span>
                                        </label>
                                       <!-- <label for="black">
                                            <input type="radio" name="color__radio" id="black">
                                            <span class="checkmark black-bg"></span>
                                        </label>
                                        <label for="grey">
                                            <input type="radio" name="color__radio" id="grey">
                                            <span class="checkmark grey-bg"></span>
                                        </label>-->
                                    </div>
                                </li>
                                <li>
                                    <span>Available size:</span>
                                    <div class="size__btn">
                                        <label for="xs-btn" class="active">
                                            <input type="radio" id="xs-btn">
                                           <?php echo $product->size;?>
                                        </label>
                                       <!-- <label for="s-btn">
                                            <input type="radio" id="s-btn">
                                            s
                                        </label>
                                        <label for="m-btn">
                                            <input type="radio" id="m-btn">
                                            m
                                        </label>
                                        <label for="l-btn">
                                            <input type="radio" id="l-btn">
                                            l
                                        </label>-->
                                    </div>
                                </li>
                                <li>
                                    <span>Promotions:</span>
                                    <p>Free shipping</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row mt-5 pt-5">
                <div class="col-lg-12 text-center">
                    <div class="related__title">
                        <h5>RELATED PRODUCTS</h5>
                    </div>
                </div>
                <?php    
                $i=5; 
                 $product->sub_cat_id=$product->sub_cat_id;
                         $stmt4= $product->readAll_subcat_id();
                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)){ 
                            $i--;
                            if($i == 0) break;
                         extract($row4);
                         if($num_of_products==0){
                             $label="out of stock";
                            $class="stockout";
                         }elseif($features == 1){
                            $label="NEW";
                            $class="new";
                         }elseif($features==2){
                            $label="SALE";
                            $class="sale";
                         }elseif($features==3){
                             $label="HOT";
                            $class="sale";
                         } ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="admin/production/images/product/<?php echo $product_image;?>">
                            <div class="label <?php echo $class;?>"><?php echo $label;?></div>
                             <ul class="product__hover">
                                        <li><a href="admin/production/images/product/<?php echo $product_image;?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                        <li><a href="add_favorite.php?id=<?php echo $product_id;?>"><span class="icon_heart_alt"></span></a></li>
                                        <li><a href="add_to_cart.php?id=<?php echo $product_id;?>"><span class="icon_bag_alt"></span></a></li>
                                    </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="product-details.php?id=<?php echo $product_id.'&sub_cat='.$sub_cat_id;?>"><?php echo $product_name;?></a></h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                              <?php 
                                    if($product_offer != 0)
                                       $price= '<div class="product__price">$'.$product_offer.' <span>'.$product_price.'</span></div>';
                                    else
                                        $price= '<div class="product__price"> $'.$product_price.'</div>';
                                    echo $price;
                                    ?>
                        </div>
                    </div>
                </div>


            <?php } ?>
               
               
             
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    

<?php 
require_once('include/footer.php');
?>