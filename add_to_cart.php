<?php ob_start();
session_start();
 if(isset($_GET['id']))
{
	//print_r( $_SESSION["cart_pro"] );
	//die();
    $pro_id   =$_GET['id'];
   $cartArray = array( $pro_id=>array('id'=>$pro_id,'quantity'=>1));
if(empty($_SESSION["shopping_cart"])) {
    $_SESSION["shopping_cart"] = $cartArray;
        header('Location: ' . $_SERVER['HTTP_REFERER']);

}else{
    $array_keys = array_keys($_SESSION["shopping_cart"]);
    if(in_array($pro_id,$array_keys)) {
 	$_SESSION['shopping_cart'][$pro_id]['quantity']=$_SESSION['shopping_cart'][$pro_id]['quantity']+1;
     header('Location: ' . $_SERVER['HTTP_REFERER']);

    } else {
    $_SESSION["shopping_cart"] =  $_SESSION["shopping_cart"]+$cartArray;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
 }
 
 }
}
 if(isset($_GET['ids']))
 {
    $pro_id=$_GET['ids'];
  $array_keys = array_keys($_SESSION["shopping_cart"]);
    if(in_array($pro_id,$array_keys)) {
    $_SESSION['shopping_cart'][$pro_id]['quantity']=$_SESSION['shopping_cart'][$pro_id]['quantity']-1;
     header('Location: ' . $_SERVER['HTTP_REFERER']); 

     if($_SESSION['shopping_cart'][$pro_id]['quantity']==0)
        unset($_SESSION["shopping_cart"][$pro_id]);
 } 
 }

if(isset($_GET['idd']))
{
    $id=$_GET['idd'];
    unset($_SESSION["shopping_cart"][$id]);
   // header("Location:index.php");
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

?>