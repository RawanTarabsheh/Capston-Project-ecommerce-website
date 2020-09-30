<?php  ob_start();
   require_once('include/header.php');
   require_once('admin/production/include/database.php');
   require_once('admin/production/include/product.php');

         // get database connection
$database     = new Database();
$db           = $database->getConnection();
$product      = new Product($db);
?>
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.php"><i class="fa fa-home"></i> Home</a>
                        <span>Shopping cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Size</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(isset($_SESSION['favorite_pro'] )){
                                foreach ($_SESSION['favorite_pro'] as $key => $value) {
                                   $product->id=$value;
                                   $product->read_product_id();


                        if($product->offer != 0)
                        {
                            $new_price=$product->offer;
                            $price='<td class="cart__price">'.$new_price.'</td>';
                        }
                        else
                        {
                            $price='<td class="cart__price">'. $product->price.'</td>';
                        }
                        
                        ?>
                                
                                <tr>
                                    <td class="cart__product__item">
                                        <img src="admin/production/images/product/<?php echo $product->image;?>" alt="" style="width: 90px;height: 90px;">
                                        <div class="cart__product__item__title">
                                            <h6><?php echo $product->name; ?></h6>
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                              <?php if($product->num_product != 0) $num=$product->num_product;
                                            else  $num="Out Of Stock";

                                            ?>
                                            <div>number of products :<?php echo $num; ?></div>
                                        </div>
                                    </td>
                                    <?php echo $price; ?>
                                    
                                    <td ><?php echo $product->size; ?></td>
                                    <td><a href="add_to_cart.php?id=<?php echo $product->id;?>" class="cart-btn btn"><span class="icon_bag_alt"></span> Add to cart</a></td>
                                    <td></td>
                                    <td class="cart__close"><a href="add_favorite.php?idd=<?php echo $product->id;?>"><span class="icon_close"></span></a></td>
                                </tr>
                            <?php }} ?>
                               
                             
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="index.php">Continue Shopping</a>
                    </div>
                </div>
              
            </div>
            
        </div>
    </section>
    <!-- Shop Cart Section End -->

  
<?php 
require_once('include/footer.php');
?>