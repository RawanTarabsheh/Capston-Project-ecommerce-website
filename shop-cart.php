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
                        <a href="shop.php"><i class="fa fa-home"></i> SHOP</a>
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
                                    <th>Quantity</th>
                                    <th>Sub Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                  $total=0;
                                if(isset($_SESSION['shopping_cart'] )){
                                  
                                foreach ($_SESSION['shopping_cart'] as $key => $value) {
                                   $product->id=$value['id'];
                                   $qty=$value['quantity'];
                                   $product->read_product_id();
                                   $sub_total=$qty*$product->price;
                                   $total+=$sub_total;

                                
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
                                    <td class="cart__price"><?php echo "$ " . $product->price; ?></td>
                                    <td class="cart__quantity">
                                      <!--  <div class="pro-qty">
                                            <input type="text" value="<?php // echo $qty; ?>">

                                        </div>-->
                                            <div style="display: flex;" >
                                                <span ><a href="add_to_cart.php?ids=<?php echo $product->id;?>">-</a></span>
                                            <input type="text" value="<?php  echo $qty; ?>" style="border: 0px;width: 100px; text-align: center;">
                                        <span ><a href="add_to_cart.php?id=<?php echo $product->id;?>">+</a></span>
                                    </div>
                                    </td>
                                    <td class="cart__total"><?php echo "$ " . $sub_total; ?></td>
                                    <td class="cart__close"><a href="add_to_cart.php?idd=<?php echo $product->id;?>"><span class="icon_close"></span></a></td>
                                </tr>
                            <?php } }?>
                              
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
            <div class="row">
                <div class="col-lg-2">  </div>
                <div class="col-lg-4 offset-lg-2">
                    <div class="cart__total__procced">
                        <h6>Cart total</h6>
                        <ul>
                            <?php $shipping=$total+5?>
                            <li>Subtotal <span><?php echo "$ " . $total;?></span></li>
                            <li>Total <span><?php echo "$ " .$shipping;?></span></li>
                        </ul>
                        <a href="checkout.php" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
                     <div class="col-lg-6">  </div>

            </div>
        </div>
    </section>
    <!-- Shop Cart Section End -->


<?php 
require_once('include/footer.php');
?>