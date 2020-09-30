<?php ob_start();
session_start();
 if(isset($_GET['id']))
{
	//print_r( $_SESSION["favorite_pro"] );
	//die();
    $pro_id   =$_GET['id'];
 if(empty($_SESSION["favorite_pro"])) {
    $_SESSION["favorite_pro"] = array();
    array_push($_SESSION['favorite_pro'],$pro_id); 
header('Location: ' . $_SERVER['HTTP_REFERER']);
} 
elseif(in_array($pro_id, $_SESSION["favorite_pro"])){
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else
{
array_push($_SESSION['favorite_pro'],$pro_id); 
header('Location: ' . $_SERVER['HTTP_REFERER']);	
}

//header("Location:index.php");

}//get is set

if(isset($_GET['idd']))
{
    $id=$_GET['idd'];
    $key = array_search ($id, $_SESSION['favorite_pro']);
    unset($_SESSION["favorite_pro"][$key]);
   // header("Location:index.php");
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

?>