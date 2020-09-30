  <?php  ob_start();
   require_once('include/header.php');
   require_once('admin/production/include/database.php');
   require_once('admin/production/include/category.php');
   require_once('admin/production/include/sub_category.php');
   require_once('admin/production/include/product.php');

         // get database connection
$database     = new Database();
$db           = $database->getConnection();
$category     = new Category($db);
$sub_category = new Sub_Category($db);
$product      = new Product($db);

?>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function()
            {
                $("#search").keyup(function(e)
                {
                  e.preventDefault();
                    //get selected parent option 
                    var s = $("#search").val().trim();
                    //alert(admin_id);
                    if(s){
                    $.ajax(
                            {
                                type: "POST",
                                url: "search.php",
                                data :
                                {
                                    "s": s,
                                },
                                success: function(data)
                                {
                                    console.log(data);
                                    var data1 = JSON.parse(data);
                                    console.log(data1);
                                    $(".old").hide();
                                    $(".new1").show();
                                    $(".new1").html('');
                                     if(data1.length == 0){
                    $('.new1').html('No Search Found');
                }else{
                                   // $('.new').append('<div class="col-lg-9 col-md-9 "><div class="row ">');
                                       $.each(data1, function( index, value ) {
                                           var pro_id=data1[index]['product_id'];
                                           var image=data1[index]['product_image'];
                                           var cat_id=data1[index]['sub_cat_id'];
                                           var name=data1[index]['product_name'];
                                           var price=data1[index]['product_price'];
                                         $(".new1").append('<div class="col-lg-4 col-md-6"><div class="product__item "><div class="product__item__pic set-bg" data-setbg="admin/production/images/product/'+image+'" style="background-image:url(admin/production/images/product/'+image+'); "><div class="label"></div><ul class="product__hover"><li><a href="admin/production/images/product/'+image+'" class="image-popup"><span class="arrow_expand"></span></a></li><li><a href="add_favorite.php?id='+pro_id+'"><span class="icon_heart_alt"></span></a></li><li><a href="add_to_cart.php?id='+pro_id+'"><span class="icon_bag_alt"></span></a></li></ul></div> <div class="product__item__text"><h6><a href="product-details.php?id='+pro_id+'&cat_id='+cat_id+'">'+name+'</a></h6><div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div><div class="product__price"> $'+price+'</div></div></div></div>');
                                    });
                                  // $(".new").append('</div></div>');
                 }
                  
                                }
                            });
                  }//end if
                  else
                  {
                       $(".old").show();
                      $(".new1").hide();
                  }

                });

            });
        </script>
<style type="text/css">
.topnav .search-container {
  float: right;
}
.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}
.topnav .search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .search-container button:hover {
  background: #ccc;
}

@media screen and (max-width: 200px) {
  .topnav .search-container {
    float: none;
  }
  .topnav a, .topnav input[type=text], .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;  
  }
</style>
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="breadcrumb__links">
                        <a href="./index.php"><i class="fa fa-home"></i> Home</a>
                        <span>Shop</span>
                    </div>
                </div>
                <div class="col-lg-4 topnav">
                      <div class="search-container">
    <form action="/action_page.php">
      <input type="text" placeholder="Search.." id="search" name="search" value="">
     <i class="fa fa-search"></i>
    </form>
  </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="shop__sidebar">
                        <div class="sidebar__categories">
                            <div class="section-title">
                                <h4>Categories</h4>
                            </div>
                            <div class="categories__accordion">
                                <div class="accordion" id="accordionExample">
                         <?php 
                         $stmt1       = $category->read();
                         while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
                          extract($row1);
                    ?>
                                    <div class="card">
                                        <div class="card-heading active">
                                            <a href="shop.php?cat_id=<?php echo $category_id;?>" data-toggle="collapse" data-target="#collapseOne"><?php echo $category_name;?></a>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <ul>
                                                    <?php 
                                                    $sub_category->cat_id=$category_id ;
                                                    $stmt2  = $sub_category->read_category_id();
                                                   while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){  
                                                    extract($row2);
                                                    $product->sub_cat_id= $sub_id;
                                                   $stmt3= $product->readAll_subcat_id_count();
                                                    $count  = $stmt3->fetch(PDO::FETCH_ASSOC);
                                                      extract($count);
                                                    ?>
                                                    <li><a href="shop.php?sub_cat=<?php echo $sub_id;?>"><?php echo $sub_name."(".$count.")";  ?></a></li>
                                                <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

<?php } ?>
                            
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 old">
                    <div class="row">
                       
                        <?php
                        if(isset($_GET['cat_id']))
                        {
                          ////

                  // page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
  
// set number of records per page
$records_per_page =6;
  
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
  
  // query products

                          /////
                       $sub_category->cat_id=$_GET['cat_id'];
               $stmt3= $sub_category->read_prodct_for_subcategoryall($from_record_num, $records_per_page);
                       $num = $stmt3->rowCount();

if($num>0){
                        while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){ 
                         extract($row3);
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
                         }
                         ?>
                        <div class="col-lg-4 col-md-6 old">
                            <div class="product__item ">
                                <div class="product__item__pic set-bg" data-setbg="admin/production/images/product/<?php echo $pro_image;?>">
                                        <div class="label <?php echo $class;?>"><?php echo $label;?></div>
                                    <ul class="product__hover">
                                        <li><a href="admin/production/images/product/<?php echo $pro_image;?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                        <li><a href="add_favorite.php?id=<?php echo $pro_id;?>"><span class="icon_heart_alt"></span></a></li>
                                        <li><a href="add_to_cart.php?id=<?php echo $pro_id;?>"><span class="icon_bag_alt"></span></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="product-details.php?id=<?php echo $pro_id.'&cat_id='.$cat_id;?>"><?php echo $pro_name;?></a></h6>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <?php 
                                    if($offer != 0)
                                       $price= '<div class="product__price">$'.$offer.' <span>'.$pro_price.'</span></div>';
                                    else
                                        $price= '<div class="product__price"> $'.$pro_price.'</div>';
                                    echo $price;
                                    ?>
                                   
                                </div>
                            </div>
                        </div>

                        <?php 
$page_url = "shop.php?cat_id=$cat_id&";

                      } } ?>
                                                   <?php
                     // paging buttons will be here
    // the page where this paging is used
  
// count all products in the database to calculate total pages
$total_rows = $sub_category->countAll_sub();
}  
// paging buttons here
?>


                        <?php 
                        if(isset($_GET['sub_cat']))
                        {
                            $product->sub_cat_id=$_GET['sub_cat'];
                         $stmt4= $product->readAll_subcat_id();
                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)){ 
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
                         }
                            
                        
                        ?>
                        <div class="col-lg-4 col-md-6 old">
                            <div class="product__item ">
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
                    <?php } }?>
                      <?php if(!isset($_GET['cat_id']) AND !isset($_GET['sub_cat']) AND !isset($_GET['id'])){
                      $product->feature=2;
                      $stmt5=$product->read_feature();
                      $label="SALE";
                       $class="sale";
                      while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)){ 
                         extract($row5);
                      

                      ?>
                      <div class="col-lg-4 col-md-6 old" >
                            <div class="product__item ">
                                <div class="product__item__pic set-bg" data-setbg="admin/production/images/product/<?php echo $product_image;?>">
                                     <div class="label <?php echo $class;?>"><?php echo $label;?></div>
                                    <ul class="product__hover">
                                        <li><a href="admin/production/images/product/<?php echo $product_image;?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                        <li><a href="add_favorite.php?id=<?php echo $product_id;?>"><span class="icon_heart_alt"></span></a></li>
                                        <li><a href="add_to_cart.php?id=<?php echo $product_id;?>"><span class="icon_bag_alt"></span></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="product-details.php?id=<?php echo $product_id.'&sub_cat='.$sub_cat_id;?>"><?php echo $product_name."dddd";?></a></h6>
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
                       <?php } } ?>
                      
          
                

                        <div class="col-lg-12 text-center">
                          
                  <?php
                  if(isset($_GET['page']) || isset($_GET['cat_id'] ))
include_once 'paging.php';

                  ?>
                        </div>
                    </div>
                </div>
<!-- -->
<div class="col-lg-9 col-md-9 ">
                    <div class="row new1">

                    </div>
                  </div>
    </section>
    <!-- Shop Section End -->


<?php 
require_once('include/footer.php');
?>